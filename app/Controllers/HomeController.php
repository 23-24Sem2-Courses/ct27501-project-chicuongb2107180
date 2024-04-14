<?php

namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Paginator;
use App\utils\Helper;
use PDOException;

class HomeController
{

    public function index()
    {
        try {
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories = $Category->all();
            $Product = new Product($pdo);
            $Products = $Product->all();
            $newest_Products = $Product::getNewest($limit = 3);
            $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
                (int)$_GET['limit'] : 8;
            $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
                (int)$_GET['page'] : 1;
           $paginator = new Paginator( $limit,count($Products), $page);
            $Products = Product::paginate(($page-1)*8,$limit,$Products);
            $pages = $paginator->getPages(length: 3);
            Helper::renderPage('/home/home.php', ['categories' => $Categories, 'Products' => $Products, 'newest_Products' => $newest_Products, 'pages' => $pages,'paginator' => $paginator]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function category($id)
    {
        try {
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories = $Category->all();
            $Category = $Category->getById($id);
            $Product = new Product($pdo);
            $Products = $Category->getProducts();
            if (isset($_GET['sort'])) {
                $Products = Product::sort($_GET['sort'], $Products);
            }
            $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
                (int)$_GET['limit'] : 8;
            $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
                (int)$_GET['page'] : 1;
           $paginator = new Paginator( $limit,count($Products), $page);
            $Products = Product::paginate(($page-1)*8,$limit,$Products);
            $pages = $paginator->getPages(length: 3);
            Helper::renderPage('/home/category.php', ['categories' => $Categories, 'Products' => $Products, 'category_id' => $id, 'pages' => $pages,'paginator' => $paginator]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function viewItem($id)
    {
        try {
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories = $Category->all();
            $Product = new Product($pdo);
            $Product = $Product->getById($id);
            Helper::renderPage('/home/product.php', ['categories' => $Categories, 'Product' => $Product]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function search()
    {
        try {
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories = $Category->all();
            $Product = new Product($pdo);
            $Products = $Product->search($_GET['search']);
            $key = $_GET['search'];
            Helper::renderPage('/home/search.php', ['categories' => $Categories, 'Products' => $Products, 'key' => $key]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
