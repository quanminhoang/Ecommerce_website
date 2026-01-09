<?php
class AuthController extends BaseController
{
    private $AdminModel;
    public function __construct()
    {
        $this->AdminModel = $this->model('AdminModel');
    }

    public function sayHi()
    {
        $this->view('auth-layout', ['page' => 'auth/login', 'pageName' => 'Đăng nhập']);
    }

    public function signIn()
    {
        $email = $_POST['username'];
        $pass = $_POST['password'];
        $result = $this->AdminModel->findEmail($email); //Tìm email
        if ($result) { // Nếu có email
            if ($pass == $result['Password']) { //Kiểm tra password
                $_SESSION['login'] = $result; // Tạo session_login

                header('Location: home');
            } else {
                $err = 'Mật khẩu không chính xác';
                echo $err;
            }
        } else {
            $err = 'Email không tồn tại';
            echo $err;
        }
    }

    public function checkEmail()
    {
        $email = $_POST['email'];
        $result = $this->AdminModel->findEmail($email); //Tìm email

        if ($result) {
            $response = array('status' => true, 'message' => 'Email đã tồn tại');
        } else {
            $response = array('status' => false, 'message' => 'Email không tồn tại');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function logout()
    {
        if ($_SESSION['login']) {
            unset($_SESSION['login']);
            header('Location: ../auth/login');
        }
    }
}
