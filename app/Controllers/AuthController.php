<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\Customer;
use App\utils\{Helper, Validator};


class AuthController
{
    private $rules;

    public function createlogin()
    {
        Helper::renderPage('/auth/login.php');
    }
    public function login()
    {
        $Customer = new Customer(PDOFactory::connect());
        $data = [];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $customer = $Customer->login($data);
        if ($customer) {
            $username = $customer->getUsername();
            $_SESSION['username'] = $username; 
             Helper::redirectTo(
                 '/',
                 [
                     [
                         'status' => 'success',
                         'message' => 'Đăng nhập thành công'
                     ]
                 ]
             );
        }
         Helper::redirectTo('/login', [
             [
                 'form' => ['username' => $data['username'], 'password' => $data['password']],
                 'errors' => 'Sai tên đăng nhập hoặc mật khẩu',
                 'status' => 'danger',
                 'message' => 'Đăng nhập thất bại'
             ]
         ]);
    }
    public function createregister()
    {
        Helper::renderPage('/auth/register.php');
    }
    public function register()
    {
        $data = [];
        $data['customer_name'] = $_POST['customer_name'];
        $data['customer_email'] = $_POST['customer_email'];
        $data['customer_phone'] = $_POST['customer_phone'];
        $data['customer_address'] = $_POST['customer_address'];
        $data['customer_gender'] = $_POST['customer_gender'] ?? 0;
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $Customer = new Customer(PDOFactory::connect());
        $Customer->fill($data);
        if ($Customer->checkUsername()) {
            Helper::redirectTo('/register', [
                [
                    'form' => $data,
                    'errors' => ['username' => 'Tên đăng nhập đã tồn tại'],
                    'status' => 'danger',
                    'message' => 'Đăng ký thất bại'
                ]
            ]);
            return;
        }
        $Customer->register();
        Helper::redirectTo('/login', [
            [
                'status' => 'success',
                'message' => 'Đăng ký thành công'
            ]
        ]);
    }
    public function logout()
    {
        unset($_SESSION['username']);
        Helper::redirectTo(
            '/',
            [
                [
                    'status' => 'success',
                    'message' => 'Đăng xuất thành công'
                ]
            ]
        );
    }
}
