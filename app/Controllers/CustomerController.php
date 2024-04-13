<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\{Customer, Product,Category,Order,Order_details};
use App\utils\{Helper, Validator};
use PD0;
class CustomerController{
    public function cart(){ 
        $categories = new Category(PDOFactory::connect());
        $categories = $categories->all();
        $cart = $_SESSION['cart'] ?? [];
        foreach($cart as $product_id => $quantity){
            $product = new Product(PDOFactory::connect());
            $product = $product->getById($product_id);
            $cart[$product_id] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
        Helper::renderPage('/customer/cart.php', ['cart' => $cart, 'categories' => $categories]);
        
    }

    public function addCart(){
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = new Product(PDOFactory::connect());
        $product = $product->getById($product_id);
        $cart = $_SESSION['cart'] ?? [];
      ## mỗi phẩn tủ trong card chỉ lưu id sản phẩm với số lượng
        $cart[$product_id] = $quantity;
        $_SESSION['cart'] = $cart;
        Helper::redirectTo($_SERVER['HTTP_REFERER'], [
            [
                'status' => 'success',
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công'
            ]
        ]);
    }
    public function deleteCart(){
        $product_id = $_POST['product_id'];
        $cart = $_SESSION['cart'] ?? [];
        unset($cart[$product_id]);
        $_SESSION['cart'] = $cart;
        Helper::redirectTo('/cart', [
            [
                'status' => 'success',
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công'
            ]
        ]);
    }

    public function checkout(){
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $categories = new Category(PDOFactory::connect());
        $categories = $categories->all();
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach($cart as $product_id => $quantity){
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
    public function addOrder(){
        $data = [];
        $data['order_total'] = $_POST['total'];
        $customer = new Customer(PDOFactory::connect());
        $customer = $customer->getByUsername($_SESSION['username']);
        $data['customer']=$customer;
        $data['order_status'] = 0;
        $cart = $_SESSION['cart'] ?? [];
        $Order = new Order(PDOFactory::connect());
        $Order->add($data, $cart);
    }
}