<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\{Customer, Product, Category, Order, Order_details};
use App\utils\{Helper, Validator};
use PD0;

class CustomerController
{
    public function cart()
    {
        $categories = new Category(PDOFactory::connect());
        $categories = $categories->all();
        $cart = $_SESSION['cart'] ?? [];
        foreach ($cart as $product_id => $quantity) {
            $product = new Product(PDOFactory::connect());
            $product = $product->getById($product_id);
            $cart[$product_id] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
        Helper::renderPage('/customer/cart.php', ['cart' => $cart, 'categories' => $categories]);
    }

    public function addCart()
    {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = new Product(PDOFactory::connect());
        $product = $product->getById($product_id);
        $cart = $_SESSION['cart'] ?? [];
        ## mỗi phẩn tủ trong card chỉ lưu id sản phẩm với số lượng
        $cart[$product_id] = $quantity;
        $_SESSION['cart'] = $cart;
        Helper::redirectTo($_SERVER['HTTP_REFERER'], [

            'status' => 'success',
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công'

        ]);
    }
    public function deleteCart()
    {
        $product_id = $_POST['product_id'];
        $cart = $_SESSION['cart'] ?? [];
        unset($cart[$product_id]);
        $_SESSION['cart'] = $cart;
        Helper::redirectTo('/cart', [

            'status' => 'success',
            'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công'

        ]);
    }

    public function checkout()
    {   
        if (!isset($_SESSION['username'])) {
            Helper::redirectTo('/login', [
                'status' => 'info',
                'message' => 'Vui lòng đăng nhập để tiếp tục'
            ]);
        }
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $categories = new Category(PDOFactory::connect());
        $categories = $categories->all();
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cart as $product_id => $quantity) {
            $product = new Product(PDOFactory::connect());
            $product = $product->getById($product_id);
            $total += $product->getPrice() * $quantity;
            $cart[$product_id] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
        Helper::renderPage('/customer/checkout.php', ['cart' => $cart, 'total' => $total, 'categories' => $categories, 'customer' => $customer]);
    }
    public function addOrder()
    {
        $data = [];
        $data['order_total'] = $_POST['total'];
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $data['customer'] = $customer;
        $data['order_status'] = 0;
        $cart = $_SESSION['cart'] ?? [];
        $Order = new Order(PDOFactory::connect());
        $Order->add($data, $cart);
        unset($_SESSION['cart']);
        Helper::redirectTo('/', [
            'status' => 'success',
            'message' => 'Đặt hàng thành công'
        ]);
    }
    public function profile()
    {
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $categories = new Category(PDOFactory::connect());
        $categories = $categories->all();
        Helper::renderPage('/customer/profile.php', ['customer' => $customer]);
    }
    public function updateProfile()
    {
        $data = [];
        $data['customer_name'] = $_POST['customer_name'];
        $data['customer_email'] = $_POST['customer_email'];
        $data['customer_phone'] = $_POST['customer_phone'];
        $data['customer_address'] = $_POST['customer_address'];
        $data['customer_gender']= $_POST['customer_gender'];
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $check= $customer->update($data);
        if($check){
            Helper::redirectTo('/profile', [
                'status' => 'success',
                'message' => 'Cập nhật thông tin thành công'
            ]);
        }else{
            Helper::redirectTo('/profile', [
                'status' => 'error',
                'message' => 'Cập nhật thông tin thất bại'
            ]);
        }
    }
    public function changePassword()
    {
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        if ($_POST['old_password']===$customer->getPassword()) {
            $data = [];
            $data['password'] = $_POST['new_password'];
            $customer->changePassword($data);   
            Helper::redirectTo('/profile', [
                'status' => 'success',
                'message' => 'Đổi mật khẩu thành công'
            ]);
        } else {
            Helper::redirectTo('/profile', [
                'status' => 'danger',
                'message' => 'Mật khẩu cũ không đúng'
            ]);
        }
    }
    public function historyorder()
    {
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $order = new Order(PDOFactory::connect());
        $orders = $order->getOrdersByCustomer($customer->getId());
        Helper::renderPage('/customer/order.php', ['orders' => $orders]);
    }
    public function destroyOrder()
    {
        $order_id = $_POST['order_id'];
        $order = new Order(PDOFactory::connect());
        $order->destroyOrder($order_id);
        Helper::redirectTo('/order', [
            'status' => 'success',
            'message' => 'Hủy đơn hàng thành công'
        ]);
    }
}
