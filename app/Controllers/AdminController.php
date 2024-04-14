<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\{Product, Category, Order, Customer, Paginator};
use App\utils\{Helper, Validator};

class AdminController
{
    public function product()
    {
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $products = $product->all();
        if (isset($_GET['search'])) {
            $products = $product->search($_GET['search']);
        }
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
            (int)$_GET['limit'] : 8;
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
            (int)$_GET['page'] : 1;
        $paginator = new Paginator($limit, count($products), $page);
        $products = Product::paginate(($page - 1) * 8, $limit, $products);
        $pages = $paginator->getPages(length: 3);
        Helper::renderPage('/admin/product.php', ['products' => $products, 'pages' => $pages, 'paginator' => $paginator]);
    }
    public function createProduct()
    {
        $pdo = PDOFactory::connect();
        $category = new Category($pdo);
        $categories = $category->all();
        Helper::renderPage('/admin/add/addproduct.php', ['categories' => $categories]);
    }
    public function storeProduct()
    {
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $data = [];
        $data['product_id'] = $_POST['product_id'];
        $data['product_name'] = $_POST['product_name'];
        $data['product_price'] = $_POST['product_price'];
        $data['product_description'] = $_POST['product_description'];
        $data['category_id'] = $_POST['category_id'];
        $images = $_FILES['product_images'];
        $image_names = [];
        foreach ($images['name'] as $key => $image) {
            $image_name = $image;
            move_uploaded_file($images['tmp_name'][$key], 'uploads/' . $image_name);
            $image_names[] = $image_name;
        }
       if($image_names[0]==''){
            $image_names=null;
       }
        if ($data['product_id'] != -1) {
            $product = $product->getById($data['product_id']);
            if($image_names != null){
                if($product->getImages() != ''){
                    $data['product_images'] = $product->getImages() . ',' . implode(',', $image_names);
                }
                else{
                    $data['product_images'] = implode(',', $image_names);
                }
            }
            else{
                $data['product_images'] = $product->getImages();
            }
            $check = $product->update($data);
            if (!$check) {
                Helper::redirectTo('/admin/product/create', [

                    'status' => 'danger',
                    'message' => 'Cập nhật sản phẩm thất bại'

                ]);
            }
            Helper::redirectTo('/admin/product', [

                'status' => 'success',
                'message' => 'Cập nhật phẩm thành công'

            ]);
        } else {
            if($image_names != null){
                $data['product_images'] = implode(',', $image_names);
                }
            $check = $product->update($data);
            if (!$check) {
                Helper::redirectTo('/admin/product/create', [

                    'status' => 'danger',
                    'message' => 'Cập nhật sản phẩm thất bại'

                ]);
            }
            Helper::redirectTo('/admin/product', [

                'status' => 'success',
                'message' => 'Thêm sản phẩm thành công'

            ]);
        }
    }
    public function editProduct()
    {
        $id = $_GET['product_id'];
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $product = $product->getById($id);
        $category = new Category($pdo);
        $categories = $category->all();
        Helper::renderPage('/admin/add/addproduct.php', ['product' => $product, 'categories' => $categories]);
    }

    public function deleteProduct()
    {
        $id = $_POST['product_id'];
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $product = $product->getById($id);
        $product->delete();

        $images = explode(',', $product->getImages());
        foreach ($images as $image) {
            unlink('uploads/' . $image);
        }
        Helper::redirectTo('/admin/product', [

            'status' => 'success',
            'message' => 'Xóa sản phẩm thành công'

        ]);
    }
    public function order()
    {
        $pdo = PDOFactory::connect();
        $order = new Order($pdo);
        $orders = $order->all();
        if (isset($_GET['status'])  && $_GET['status'] != -2) {
            $orders = $order->getOrderByFilter($_GET['status']);
        }
        $status = $_GET['status'] ?? -2;
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
            (int)$_GET['limit'] : 5;
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
            (int)$_GET['page'] : 1;
        $paginator = new Paginator($limit, count($orders), $page);
        $orders = Product::paginate(($page - 1) * 5, $limit, $orders);
        $pages = $paginator->getPages(length: 3);
        
        Helper::renderPage('/admin/order.php', ['orders' => $orders, 'status' => $status, 'pages' => $pages, 'paginator' => $paginator]);
    }
    public function approveOrder()
    {
        $id = $_POST['order_id'];
        $pdo = PDOFactory::connect();
        $order = new Order($pdo);
        $order = $order->getById($id);
        var_dump($order);
        $order->approveOrder($id);
        Helper::redirectTo('/admin/order', [

            'status' => 'success',
            'message' => 'Duyệt đơn hàng thành công'

        ]);
    }
}
