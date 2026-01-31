<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$vendorPath = realpath(__DIR__ . '/../../../vendor');

$root = '/Applications/XAMPP/xamppfiles/htdocs/Ecommerce_website';
$paths = [
    $root . '/vendor/PHPMailer/src/Exception.php',          // Vị trí 1: Gốc dự án
    $root . '/Customer/vendor/PHPMailer/src/Exception.php', // Vị trí 2: Trong Customer
    __DIR__ . '/../../../vendor/PHPMailer/src/Exception.php' // Vị trí 3: Tương đối
];

$found = false;
foreach ($paths as $path) {
    if (file_exists($path)) {
        $baseDir = dirname($path);
        require_once $path;
        require_once $baseDir . '/PHPMailer.php';
        require_once $baseDir . '/SMTP.php';
        $found = true;
        break;
    }
}

if (!$found) {
    die("LỖI: Không tìm thấy thư mục PHPMailer. Bạn hãy kiểm tra xem thư mục 'vendor' đang nằm ở đâu trong Ecommerce_website và nhắn cho tôi.");
}

class OrderController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
    }

    public function sayHi()
    {
        $orders =  $this->orderModel->getOrders();
        $this->view(
            'main-layout',
            [
                'page' => 'orders/index',
                'pageName' => 'Đơn đặt hàng',
                'orders' => $orders
            ]
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $orders = $this->orderModel->searchOrders($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'orders/index',
                    'pageName' => 'Đơn đặt hàng',
                    'orders' => $orders
                ]
            );
        } else {
            header('location:sayHi');
        }
    }


    public function accept($id)
    {
        $data = ['StatusOrder' => 2];
        $this->orderModel->updateOrder($id, $data);
        header("location:../sayHi");
    }



    public function acceptShow($id)
    {
        $data = ['StatusOrder' => 2];
        $this->orderModel->updateOrder($id, $data);
        header("location:../show/{$id}");
    }

    public function destroy($id)
    
    {
        // 1. Hoàn kho
        $this->orderModel->returnStock($id);

        // 2. Cập nhật trạng thái thành 3 (Đã hủy)
        $this->orderModel->updateOrder($id, ['StatusOrder' => 3]);

        $this->sendCancelMail($id);

        header("location:../sayHi");
    }

    public function destroyShow($id)
    {
        $this->orderModel->returnStock($id);
        $this->orderModel->updateOrder($id, ['StatusOrder' => 3]);
        header("location:../show/{$id}");
    }
    
    private function sendCancelMail($id) 
    {
        $order = $this->orderModel->getOrderById($id);
        $customerModel = $this->model('CustomerModel');
        $customer = $customerModel->getCustomer($order['CustomerID']);

        if ($customer && !empty($customer['Email'])) {
            try {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'phatlu678@gmail.com';
                $mail->Password = 'hbht kgyc erkd tlar'; 
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('kongtu2x@gmail.com', 'Figure Store');
                $mail->addAddress($customer['Email'], $customer['FullName'] ?? $customer['Name']);

                $mail->isHTML(true);
                $mail->Subject = 'Thông báo hủy đơn hàng #' . $id;

                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
                        <h3>Chào " . ($customer['FullName'] ?? $customer['Name']) . ",</h3>
                        <p>Chúng tôi rất tiếc phải thông báo rằng đơn hàng <b>#$id</b> của bạn đã bị hủy.</p>
                        <p>Chúng tôi chân thành xin lỗi vì sự bất tiện này.</p>
                        <br>
                        <p>Trân trọng,<br>-- Figure Store --</p>
                    </div>
                ";
                $mail->send();
            } catch (Exception $e) {
                error_log("Gửi mail hủy đơn thất bại: {$mail->ErrorInfo}");
            }
        }
    }


    public function show($id)
    {
        $customerModel = $this->model('CustomerModel');

        $order = $this->orderModel->getOrderById($id);
        $customerByOrder = $customerModel->getCustomer($order['CustomerID']);
        $orderDetails = $this->orderModel->getOrderDetails($id);

        $this->view(
            'main-layout',
            [
                'page' => 'orders/showOrder',
                'pageName' => 'Chi tiết đơn hàng',
                'order' => $order,
                'customer' => $customerByOrder,
                'orderDetails' => $orderDetails
            ]
        );
    }
    public function shippingShow($id)
    {
        $data = ['StatusOrder' => 4];
        $this->orderModel->updateOrder($id, $data);

        $order = $this->orderModel->getOrderById($id);
        $customerModel = $this->model('CustomerModel');
        $customer = $customerModel->getCustomer($order['CustomerID']);

        // 3. Gửi Mail thông báo
        if ($customer && !empty($customer['Email'])) {
            try {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'phatlu678@gmail.com';
                $mail->Password = 'hbht kgyc erkd tlar'; 
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('kongtu2x@gmail.com', 'Figure Store');
                $mail->addAddress($customer['Email'], $customer['FullName'] ?? $customer['Name']);

                $mail->isHTML(true);
                $mail->Subject = 'Đơn hàng của bạn đang trên đường giao!';

                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
                        <h3 style='color: #2c3e50;'>Chào " . ($customer['FullName'] ?? $customer['Name']) . ",</h3>
                        <p>Đơn hàng <b>#$id</b> của bạn đã được đóng gói và đang trên đường giao đến bạn.</p>
                        <p><b>Địa chỉ nhận hàng:</b> {$order['AddressReceive']}</p>
                        <p><b>Tổng thanh toán:</b> " . number_format($order['Total']) . " VNĐ</p>
                        <p>Vui lòng giữ điện thoại để shipper có thể liên lạc với bạn dễ dàng nhé.</p>
                        <br>
                        <p>Cảm ơn bạn đã ủng hộ Figure Store!</p>
                    </div>
                ";

                $mail->send();
            } catch (Exception $e) {
                error_log("Gửi mail thông báo giao hàng thất bại: {$mail->ErrorInfo}");
            }
        }

        

        header("location:../show/{$id}");
    }

    // 2. Chuyển sang trạng thái Hoàn tất/Đã giao (Status = 5)
    public function completedShow($id)
    {
        $data = ['StatusOrder' => 5];
        $this->orderModel->updateOrder($id, $data);
        // Có thể gửi mail "Cảm ơn đã mua hàng" tại đây
        header("location:../show/{$id}");
    }
}
