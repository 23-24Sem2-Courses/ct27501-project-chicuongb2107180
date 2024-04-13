<?php
namespace App\Models;
use PDO;
use App\Models\PDOFactory;
use App\Models\Product;
class category{
    private ?PDO $db;
    private int $category_id = -1;
    private $category_name;
    ## contructor
    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }
    ## fill data
    public function fill(array $data): Category
    {
        $this->category_name = $data['category_name'] ?? '';
        return $this;
    }
    ## fill from db
    public function fillFromDb(array $data): Category
    {
        $this->category_id = $data['category_id'] ?? -1;
        $this->category_name = $data['category_name'] ?? '';
        return $this;
    }
    ## get id
    public function getId(): int
    {
        return $this->category_id;
    }
    ## get all category
    public function all(): array
    {
        $sql = "SELECT * FROM product_categories"; 
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    ## get category by id
    public function getById(int $id): ?Category
    {
        $sql = "SELECT * FROM product_categories WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Category($this->db))->fillFromDb($data);
    }
    ## get product by category
    public function getProducts(): array
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->category_id]);
        $data = $stmt->fetchAll();
        $products = [];
        foreach ($data as $product) {
            array_push($products, (new Product($this->db))->fillFromDb($product));
        }
        return $products;
    }

}