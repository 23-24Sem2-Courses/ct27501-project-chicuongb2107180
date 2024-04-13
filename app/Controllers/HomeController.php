<?php
namespace App\Controllers;

use App\Models\PDOFactory;
use App\Models\Category;
use App\Models\Product;
use App\utils\Helper;
use PDOException;

class HomeController
{
    
    public function index()
    {
        try{
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories= $Category->all();
            $Product = new Product($pdo);
            $Products = $Product->all();
            $newest_Products = $Product::getNewest($limit = 3);
            Helper::renderPage('/home/home.php', ['categories' => $Categories, 'Products' => $Products,'newest_Products' => $newest_Products]);
        }
        
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function category($id)
    {
        try{
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories= $Category->all();
            $Category = $Category->getById($id);
            $Product = new Product($pdo);
            $Products = $Category->getProducts();
            if(isset($_GET['sort'])){
                $Products= Product::sort($_GET['sort'],$Products);
            }
            Helper::renderPage('/home/category.php', ['categories' => $Categories, 'Products' => $Products,'category_id' => $id]);

        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function viewItem($id)
    {
        try{
            $pdo = PDOFactory::connect();
            $Category = new Category($pdo);
            $Categories= $Category->all();
            $Product = new Product($pdo);
            $Product = $Product->getById($id);
            Helper::renderPage('/home/product.php', ['categories' => $Categories, 'Product' => $Product]);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}