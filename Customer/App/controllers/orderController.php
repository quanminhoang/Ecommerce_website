<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Import PHPMailer bằng Composer (nếu cần)
require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';
class OrderController extends BaseController
{
    private $productModel;
    private $categoryModel;
    private $orderModel;
    private $orderDetailModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('categoryModel');
        $this->productModel = $this->model('productModel');
        $this->orderModel = $this->model('orderModel');
        $this->orderDetailModel = $this->model('orderDetailModel');
    }

    public function sayHi()
    {
        $categories = $this->categoryModel->getCategories();
        $orders = $this->orderModel->getOrders($_SESSION['customer']['ID']);
        $this->view(
            'main-layout',
            [
                'pageName' => 'Lịch sử mua hàng',
                'page' => 'orders/index',
                'categories' => $categories,
                'orders' => $orders
            ]
        );
    }

    public function cart()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view(
            'main-layout',
            [
                'pageName' => 'Giỏ hàng',
                'page' => 'orders/cart',
                'categories' => $categories
            ]
        );
    }

    public function addToCart($id)
    {
        if (isset($_SESSION['customer'])) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $name = $_POST['name'];
            $promotionPrice = $_POST['promotionPrice'];
            $size = $_POST['size'];
            $img = $_POST['img'];
            $quantity = $_POST['quantity'];
            $flag = 0;

            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['ID'] == $id && $_SESSION['cart'][$i]['Size'] == $size) {
                    $flag = 1;
                    $quantityNew = $quantity + $_SESSION['cart'][$i]['Quantity'];
                    $_SESSION['cart'][$i]['Quantity'] = $quantityNew;
                    break;
                }
            }

            if ($flag == 0) {
                $product = [
                    'ID' => $id,
                    'Name' => $name,
                    'PromotionPrice' => $promotionPrice,
                    'Size' => $size,
                    'Img' => $img,
                    'Quantity' => $quantity
                ];
                $_SESSION['cart'][] = $product;
            }

            header("location:../../product/show/${id}");
        } else {
            header("location:../auth");
        }
    }

    public function deleteCart($id)
    {

        unset($_SESSION['cart'][$id]);
        header('Location: ../cart');
    }

    public function pay()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view(
            'main-layout',
            [
                'pageName' => 'Thanh toán',
                'page' => 'orders/pay',
                'categories' => $categories
            ]
        );
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function checkOut()
    {
        $categories = $this->categoryModel->getCategories();

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $this->view('main-layout', [
                'page' => 'orders/pay',
                'categories' => $categories,
                'error' => "Giỏ hàng trống!"
            ]);
            return;
        }

        $total = 0;
        foreach ($_SESSION['cart'] as $value) {
            $total += $value['PromotionPrice'] * $value['Quantity'];
        }

        $nameReceive   = $_POST['nameReceive'] ?? '';
        $phoneReceive  = $_POST['phoneReceive'] ?? '';
        $addressReceive = $_POST['addressReceive'] ?? '';
        $note          = $_POST['note'] ?? '';
        $customerID    = $_SESSION['customer']['ID'] ?? 0;
        $payment       = $_POST['payment'] ?? 'COD';

        if (!$nameReceive || !$phoneReceive || !$addressReceive || !$payment) {
            $this->view('main-layout', [
                'page' => 'orders/pay',
                'categories' => $categories,
                'error' => "Vui lòng điền đầy đủ thông tin thanh toán!"
            ]);
            return;
        }

        // --- Tạo Order ---
        $data = [
            'NameReceive'   => $nameReceive,
            'PhoneReceive'  => $phoneReceive,
            'AddressReceive' => $addressReceive,
            'Note'          => $note,
            'Total'         => $total,
            'CustomerID'    => $customerID,
            'payment'       => ($payment == 'COD') ? 0 : 1
        ];
        $order_id = $this->orderModel->createOrder($data);

        // --- Insert chi tiết giỏ hàng ---
        $insertValues = [];
        foreach ($_SESSION['cart'] as $value) {
            $qty   = intval($value['Quantity']);
            $price = floatval($value['PromotionPrice']);
            $size  = addslashes($value['Size']);
            $prodId = intval($value['ID']);
            $insertValues[] = "($qty, $price, '$size', $prodId, $order_id)";
        }
        $sql = "INSERT INTO orderDetails(Quantity, Price, Size, ProductID, OrderID) 
            VALUES " . implode(',', $insertValues);
        $this->orderDetailModel->createOrderDetail($sql);

        unset($_SESSION['cart']); // clear cart

        // --- Nếu COD ---
        if ($payment == 'COD') {
            header("Location: ../order/thank");
            exit;
        }

        // --- Nếu MoMo ---
        $endpoint   = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey  = "klm05TvNBzhg7h7j";
        $secretKey  = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";

        $orderInfo  = "Thanh toán qua MoMo";
        $amount     = $total;
        $orderId    = time() . "";
        $redirectUrl = "http://localhost/figure_store/customer/order/thank";
        $ipnUrl     = "http://localhost/figure_store/customer/order/ipn";
        $requestId  = time() . "";
        $requestType = "captureWallet";
        $extraData  = "";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId'     => "MomoTestStore",
            'requestId'   => $requestId,
            'amount'      => $amount,
            'orderId'     => $orderId,
            'orderInfo'   => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl'      => $ipnUrl,
            'lang'        => 'vi',
            'extraData'   => $extraData,
            'requestType' => $requestType,
            'signature'   => $signature
        ];

        $result     = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            header("Location: " . $jsonResult['payUrl']);
            exit;
        } else {
            $this->view('main-layout', [
                'page' => 'orders/pay',
                'categories' => $categories,
                'error' => "Lỗi tạo thanh toán MoMo: " . json_encode($jsonResult)
            ]);
            return;
        }
    }


    public function ipn()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if ($data && isset($data['orderId'])) {
            $orderId = intval($data['orderId']);
            if ($data['resultCode'] == 0) {
                // Thành công
                $this->orderModel->updatePaymentStatus($orderId, 1); // 1 = đã thanh toán
            } else {
                // Thất bại
                $this->orderModel->updatePaymentStatus($orderId, -1); // -1 = thất bại
            }
        }

        echo json_encode(['message' => 'received']);
    }

    public function thank()
    {
        $categories = $this->categoryModel->getCategories();

        $resultCode = $_GET['resultCode'] ?? -1;
        $orderId    = $_GET['orderId'] ?? 0;

        // Luôn gửi cho COD (-1) và MoMo thành công (0)
        if (isset($_SESSION['customer']) && ($resultCode == 0 || $resultCode == -1)) {
            try {
                $customerEmail = $_SESSION['customer']['Email'];
                $customerName  = $_SESSION['customer']['Name'];

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'kongtu2x@gmail.com';
                $mail->Password = 'dangioexefxpiced'; // App password
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';

                $mail->setFrom('kongtu2x@gmail.com', 'Figure Store');
                $mail->addAddress($customerEmail, $customerName);

                $mail->isHTML(true);
                $mail->Subject = 'Thanks for your order';
                $mail->Body    = "
                <h3>Xin chào {$customerName},</h3>
                <p>Đơn hàng <b>#$orderId</b> đã lên thành công!</p>
                <p>Chúng tôi sẽ xử lý và giao hàng cho bạn sớm nhất có thể.</p>
                <br>
                <p>-- Figure Store --</p>
            ";

                $mail->send();
                error_log("Gửi mail thành công tới $customerEmail");
            } catch (Exception $e) {
                error_log("Gửi mail thất bại: {$mail->ErrorInfo}");
            }
        }

        $this->view('main-layout', [
            'page' => 'orders/thank',
            'categories' => $categories,
            'resultCode' => $resultCode
        ]);
    }
}
