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
        $this->view(
            'main-layout',
            [
                'page' => 'auth/login',
                'pageName' => 'Đăng nhập',
                'categories' => $categories
            ]
        );
    }

public function checkEmail()
{
    $email = $_POST['email'] ?? '';
    $customer = $this->customerModel->findEmail($email);

    header('Content-Type: application/json');

    if ($customer) {
        echo json_encode(['status' => true, 'message' => 'Email đã được đăng ký']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Email chưa được đăng ký']);
    }
    exit();
}





public function signIn()
{
    $email = $_POST['username'];
    $pass = $_POST['password'];
    $customer = $this->customerModel->findEmail($email);

    header('Content-Type: application/json');

    if ($customer) {
        if ($pass == $customer['Password']) {
            $_SESSION['customer'] = $customer;
            echo json_encode([
                'status' => true,
                'message' => 'Đăng nhập thành công'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'field' => 'password',
                'message' => 'Mật khẩu không chính xác'
            ]);
        }
    } else {
        echo json_encode([
            'status' => false,
            'field' => 'username',
            'message' => 'Email không tồn tại'
        ]);
    }
    exit();
}

    public function register()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view(
            'main-layout',
            [
                'page' => 'auth/register',
                'pageName' => 'Đăng ký',
                'categories' => $categories
            ]
        );
    }

    public function verify()
    {
        $categories = $this->categoryModel->getCategories();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_r = $_POST['pass_r'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $code = rand(0000, 9999);

        $customer = $this->customerModel->findEmail($email); //Tìm email
        $verifyEmail = $this->customerModel->emailVerify($email);
        if ($customer) {
            echo "Email đã tồn tại";
        } else {
            if ($name || $email || $pass || $pass_r || $birthday ||  $address || $phoneNumber) {
                if ($verifyEmail) {
                    $data = [
                        'Name' => $name,
                        'Password' => $pass,
                        'Birthday' => $birthday,
                        'Address' => $address,
                        'PhoneNumber' => $phoneNumber,
                        'code' => $code
                    ];
                    $this->customerModel->updateCustomer($verifyEmail['ID'], $data);
                    try {
                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'kongtu2x@gmail.com';
                        $mail->Password = 'dangioexefxpiced';
                        $mail->Port = 465;
                        $mail->SMTPSecure = 'ssl';

                        //Recipients
                        $mail->setFrom('Mohinh123@gmail.com', 'Figure Store');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'CODE OTP';
                        $mail->Body    = "Code OTP create account: <b>${code}</b>";

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    try {
                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'kongtu2x@gmail.com';
                        $mail->Password = 'dangioexefxpiced';
                        $mail->Port = 465;
                        $mail->SMTPSecure = 'ssl';

                        //Recipients
                        $mail->setFrom('Mohinh123@gmail.com', 'Figure Store');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'CODE OTP';
                        $mail->Body    = "Code OTP create account: <b>${code}</b>";

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    $data = [
                        'Name' => $name,
                        'Email' => $email,
                        'Password' => $pass,
                        'Birthday' => $birthday,
                        'Address' => $address,
                        'PhoneNumber' => $phoneNumber,
                        'code' => $code,
                    ];

                    $this->customerModel->createCustomer($data);
                }
            } else {
                header("location:register");
            }
        }
        $this->view(
            'main-layout',
            [
                'page' => 'auth/otp',
                'pageName' => 'Xác thực',
                'categories' => $categories,
                'email' => $email
            ]
        );
    }

    public function submitVerify()
    {
        $email =  $_POST['email'];
        $categories = $this->categoryModel->getCategories();
        if (isset($_POST['otp'])) {
            $otp =  $_POST['otp'];
            $verifyEmail = $this->customerModel->emailVerify($email);
            if ($verifyEmail['code'] === $otp) {
                $this->customerModel->updateCustomer($verifyEmail['ID'], ['verify' => 1]);
                header("location:sayHi");
            } else {
                $this->view(
                    'main-layout',
                    [
                        'page' => 'auth/otp',
                        'pageName' => 'Xác thực',
                        'categories' => $categories,
                        'email' => $email,
                        'err' => 'Mã OTP không chính xác'
                    ]
                );
            }
        } else {
            $this->view(
                'main-layout',
                [
                    'page' => 'auth/otp',
                    'pageName' => 'Xác thực',
                    'categories' => $categories,
                    'email' => $email,
                    'err' => 'Vui lòng nhập mã OTP'
                ]
            );
        }
    }

    public function logout()
    {
        if ($_SESSION['customer']) {
            unset($_SESSION['customer']);
            header('Location: ../home');
        }
    }

    
}

