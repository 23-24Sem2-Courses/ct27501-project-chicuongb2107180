<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Models\PDOFactory;

class Product
{
    private ?PDO $db;
    private int $product_id = -1;
    private $product_name;
    private $product_price;
    private $category_id;
    private $product_description;
    private $product_images;
    private $product_updated_at;
    private $product_sold_quantity;
    ## contructor
    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }
    ## fill data
    public function fill(array $data): Product
    {   
        $this->product_id = $data['product_id'] ?? -1;
        $this->product_name = $data['product_name'] ?? '';
        $this->product_price = $data['product_price'] ?? '';
        $this->product_description = $data['product_description'] ?? '';
        $this->category_id = $data['category_id'] ?? '';
        $this->product_images = $data['product_images'] ?? '';
        $this->product_sold_quantity = $data['sold_quantity'] ?? 0;
        return $this;
    }
    ## fill from db
    public function fillFromDb(array $data): Product
    {
        $this->product_id = $data['product_id'] ?? -1;
        $this->product_name = $data['product_name'] ?? '';
        $this->product_price = $data['product_price'] ?? '';
        $this->product_description = $data['product_description'] ?? '';
        $this->category_id = $data['category_id'] ?? '';
        $this->product_images = $data['product_images'] ?? '';
        $this->product_updated_at = $data['updated_at'] ?? '';
        $this->product_sold_quantity = $data['sold_quantity'] ?? 0;
        return $this;
    }
    ## get id
    public function getId(): int
    {
        return $this->product_id;
    }
    ## get all product
    public function all(): array
    {

        $product = [];
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDb($row);
            $products[] = $product;
        }
        return $products;
    }
    ## get product by id
    public function getById(int $id): ?Product
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Product($this->db))->fillFromDb($data);
    }

    public function update($data): bool
    {
        $this->fill($data);
        if ($this->product_id == -1) {
            $sql = "INSERT INTO products (product_name, product_price, category_id, product_description, product_images,sold_quantity)
             VALUES (:product_name, :product_price, :category_id, :product_description, :product_images, :product_sold_quantity)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':product_name', $this->product_name, PDO::PARAM_STR);
            $stmt->bindParam(':product_price', $this->product_price, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_description', $this->product_description, PDO::PARAM_STR);
            $stmt->bindParam(':product_images', $this->product_images, PDO::PARAM_STR);
            $stmt->bindParam(':product_sold_quantity', $this->product_sold_quantity, PDO::PARAM_INT);
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        $sql = "UPDATE products SET
         product_name = :product_name, product_price = :product_price, category_id = :category_id, product_description = :product_description, product_images = :product_images WHERE product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':product_name', $this->product_name, PDO::PARAM_STR);
        $stmt->bindParam(':product_price', $this->product_price, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_description', $this->product_description, PDO::PARAM_STR);
        $stmt->bindParam(':product_images', $this->product_images, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
        try {   
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }



    }
   
    ## delete product
    public function delete(): bool
    {
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([$this->product_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
 
    ## get name
    public function getName(): string
    {
        return $this->product_name;
    }
    ## get price
    public function getPrice(): string
    {
        return $this->product_price;
    }
    ## get category
    public function getCategory(): string
    {
        return $this->category_id;
    }
    ## get images
    public function getImages(): string
    {
        return  $this->product_images;
    }
    ## get images array
    public function getImagesArray(): array
    {
        return explode(',', $this->product_images);
    }
    ## get first image
    public function getFirstImage(): string
    {
        return explode(',', $this->product_images)[0];
    }

    ## get updated at
    public function getUpdatedAt(): string
    {
        return $this->product_updated_at;
    }
    ## get description
    public function getDescription(): string
    {
        return $this->product_description;
    }
    ## get updated ad newest at limit
    public static function getNewest(int $limit): array
    {
        $db = PDOFactory::connect();
        $product = [];
        $sql = "SELECT * FROM products ORDER BY updated_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $product = new Product($db);
            $product->fillFromDb($row);
            $products[] = $product;
        }
        $products = array_slice($products, 0, $limit);
        return $products;
    }
    ## get sold quantity
    public function getSoldQuantity(): int
    {
        return $this->product_sold_quantity;
    }
    ## filter giá tăng dần hoặc giảm dần nếu truyền và 1 tăng dần còn -1 giảm dần con mặc định không truyền thì không sắp xếp
    public static function sort($sort,$Products): array{
        if($sort == 1){
            usort($Products, function($a, $b) {
                return $a->getPrice() <=> $b->getPrice();
            });
        }
        if($sort == -1){
            usort($Products, function($a, $b) {
                return $b->getPrice() <=> $a->getPrice();
            });
        }
        return $Products;
    }
    ## search product
    public  function search($search): array{
        $Products= $this->all();
        $result = [];
        foreach($Products as $product){
            $search = mb_strtoupper($search,'UTF-8');
            $product_name = mb_strtoupper($product->getName(),'UTF-8');
            if(strpos($product->getName(),$search) !== false){
                $result[] = $product;
            }
        }
        return $result;
    }
   
    ## paginate
    public static function paginate($offset, $limit,$products): array
    {
        return array_slice($products, $offset, $limit);
    }
}
