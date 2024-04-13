<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\{Product, Category,Order, Customer};
use App\utils\{Helper, Validator};

class AdminController{
    public function product(){
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $products = $product->all();
        Helper::renderPage('/admin/product.php', ['products' => $products]);
    }
    public function createProduct(){
        $pdo = PDOFactory::connect();
        $category = new Category($pdo);
        $categories = $category->all();
        Helper::renderPage('/admin/add/addproduct.php', ['categories' => $categories]);
    }
    public function storeProduct(){
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
        foreach($images['name'] as $key => $image){
            $image_name = $image;
            move_uploaded_file($images['tmp_name'][$key], 'uploads/'.$image_name);
            $image_names[] = $image_name;
        }
        if($data['product_id']!=-1){
            $product = $product->getById($data['product_id']);
            $data['product_images'] = $product->getImages().','.implode(',', $image_names);  
            $check= $product->update($data);
            if(!$check){
                Helper::redirectTo('/admin/product/create', [
                    [
                        'status' => 'danger',
                        'message' => 'Cập nhật sản phẩm thất bại'
                    ]
                ]);
            }
            Helper::redirectTo('/admin/product', [
                [
                    'status' => 'success',
                    'message' => 'Cập nhật sản phẩm thành công'
                ]
            ]);
        }
        else{
             $data['product_images'] = implode(',', $image_names);
        $check= $product->update($data);
        if(!$check){
            Helper::redirectTo('/admin/product/create', [
                [
                    'status' => 'danger',
                    'message' => 'Cập nhật sản phẩm thất bại'
                ]
            ]);
        }
        Helper::redirectTo('/admin/product', [
            [
                'status' => 'success',
                'message' => 'Cập nhật sản phẩm thành công'
            ]
        ]);
        }

    }   
    public function editProduct(){
        $id = $_GET['product_id'];
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $product = $product->getById($id);
        $category = new Category($pdo);
        $categories = $category->all();
        Helper::renderPage('/admin/add/addproduct.php', ['product' => $product, 'categories' => $categories]);
    }

    public function deleteProduct(){
        $id = $_POST['product_id'];
        $pdo = PDOFactory::connect();
        $product = new Product($pdo);
        $product = $product->getById($id);
        $product->delete();

        $images = explode(',', $product->getImages());
        foreach($images as $image){
            unlink('uploads/'.$image);
        }
        Helper::redirectTo('/admin/product', [
            [
                'status' => 'success',
                'message' => 'Xóa sản phẩm thành công'
            ]
        ]);
    }

}