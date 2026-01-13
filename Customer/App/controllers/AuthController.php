<?php

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';

class AuthController extends BaseController
{
    private $categoryModel;
    private $customerModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('categoryModel');
        $this->customerModel = $this->model('customerModel');
    }

    public function sayHi()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view('main-layout', [
            'page' => 'auth/login',
            'pageName' => 'Đăng nhập',
            'categories' => $categories
        ]);
    }

    public function checkEmail()
    {
        $email = $_POST['email'] ?? '';
        $customer = $this->customerModel->findEmail($email);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => (bool)$customer,
            'message' => $customer ? 'Email đã được đăng ký' : 'Email chưa được đăng ký'
        ]);
        exit();
    }

    public function signIn()
    {
        $email = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';
        $customer = $this->customerModel->findEmail($email);

        header('Content-Type: application/json');
        if ($customer) {
            if ($pass == $customer['Password']) {
                $_SESSION['customer'] = $customer;
                echo json_encode(['status' => true, 'message' => 'Đăng nhập thành công']);
            } else {
                echo json_encode(['status' => false, 'field' => 'password', 'message' => 'Mật khẩu không chính xác']);
            }
        } else {
            echo json_encode(['status' => false, 'field' => 'username', 'message' => 'Email không tồn tại']);
        }
        exit();
    }

    public function register()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view('main-layout', [
            'page' => 'auth/register',
            'pageName' => 'Đăng ký',
            'categories' => $categories
        ]);
    }

    // Hàm phụ trợ cấu hình và gửi Email
    private function sendOTPMail($toEmail, $toName, $otpCode)
    {
        $mail = new PHPMailer(true);
        try {
            // Cấu hình Server
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'phatlu678@gmail.com'; 
            $mail->Password   = 'hbht kgyc erkd tlar'; // Đảm bảo đây là Mật khẩu ứng dụng 16 ký tự
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // Người nhận
            $mail->setFrom('kongtu2x@gmail.com', 'Figure Store Support');
            $mail->addAddress($toEmail, $toName);

            // Nội dung
            $mail->isHTML(true);
            $mail->Subject = 'MÃ XÁC THỰC OTP ĐĂNG KÝ TÀI KHOẢN';
            $mail->Body    = "<h3>Xin chào {$toName},</h3>
                             <p>Mã OTP của bạn là: <b style='font-size: 20px; color: red;'>{$otpCode}</b></p>
                             <p>Mã này dùng để xác thực tài khoản của bạn. Vui lòng không cung cấp mã này cho bất kỳ ai.</p>";

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    public function verify()
    {
        $categories = $this->categoryModel->getCategories();
        $name        = $_POST['name'] ?? '';
        $email       = $_POST['email'] ?? '';
        $pass        = $_POST['pass'] ?? '';
        $birthday    = $_POST['birthday'] ?? '';
        $address     = $_POST['address'] ?? '';
        $phoneNumber = $_POST['phoneNumber'] ?? '';
        $code        = rand(1000, 9999);

        // Kiểm tra email tồn tại
        $customer = $this->customerModel->findEmail($email);
        if ($customer && $customer['verify'] == 1) {
            echo "Email đã tồn tại và đã được xác thực!";
            return;
        }

        if (!empty($name) && !empty($email) && !empty($pass)) {
            $data = [
                'Name' => $name,
                'Email' => $email,
                'Password' => $pass,
                'Birthday' => $birthday,
                'Address' => $address,
                'PhoneNumber' => $phoneNumber,
                'code' => $code
            ];

            // Lưu hoặc cập nhật thông tin khách hàng tạm thời
            $verifyEmail = $this->customerModel->emailVerify($email);
            if ($verifyEmail) {
                $this->customerModel->updateCustomer($verifyEmail['ID'], $data);
            } else {
                $this->customerModel->createCustomer($data);
            }

            // Gửi Mail
            if ($this->sendOTPMail($email, $name, $code)) {
                $this->view('main-layout', [
                    'page' => 'auth/otp',
                    'pageName' => 'Xác thực',
                    'categories' => $categories,
                    'email' => $email
                ]);
            } else {
                echo "Không thể gửi mail. Vui lòng kiểm tra lại cấu hình SMTP hoặc kết nối internet.";
            }
        } else {
            header("location:register");
            exit();
        }
    }

    public function submitVerify()
    {
        $email = $_POST['email'] ?? '';
        $otp   = $_POST['otp'] ?? '';
        $categories = $this->categoryModel->getCategories();

        if (!empty($otp)) {
            $verifyEmail = $this->customerModel->emailVerify($email);
            
            if ($verifyEmail && $verifyEmail['code'] == $otp) {
                // Xác thực thành công
                $this->customerModel->updateCustomer($verifyEmail['ID'], ['verify' => 1]);
                header("location:sayHi");
                exit();
            } else {
                $err = 'Mã OTP không chính xác';
            }
        } else {
            $err = 'Vui lòng nhập mã OTP';
        }

        $this->view('main-layout', [
            'page' => 'auth/otp',
            'pageName' => 'Xác thực',
            'categories' => $categories,
            'email' => $email,
            'err' => $err
        ]);
    }

    public function logout()
    {
        if ($_SESSION['customer']) {
            unset($_SESSION['customer']);
            header('Location: ../home');
        }
    }
}