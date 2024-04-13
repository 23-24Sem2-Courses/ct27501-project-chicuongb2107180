<?php
namespace App\Models;
use PDO;
use App\Models\PDOFactory;

class Order_details{
    private ?PDO $db;
    private int $order_id = -1;
    private $product_id;
    private $quantity;

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }
    ## fill data
    public function fill(array $data): Order_details
    {   
        $this->order_id = $data['order_id'] ?? '';
        $this->product_id = $data['product_id'] ?? '';
        $this->quantity = $data['quantity'] ?? '';
        return $this;
    }
    ## fill from db
    public function fillFromDb(array $data): Order_details
    {
        $this->order_id = $data['order_id'] ?? -1;
        $this->product_id = $data['product_id'] ?? '';
        $this->quantity = $data['quantity'] ?? '';
        return $this;
    }
    
    ## get all order_details
    public function all(): array
    {
        $sql = "SELECT * FROM order_details";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $order_details = [];
        while ($data = $stmt->fetch()) {
            $order_detail = (new Order_details($this->db))->fillFromDb($data);
            array_push($order_details, $order_detail);
        }
        return $order_details;
        
    }
    ## get order_details by id_order, id_product
    public function getById(int $id_order, int $id_product): ?Order_details
    {
        $sql = "SELECT * FROM order_details WHERE order_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_order, $id_product]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Order_details($this->db))->fillFromDb($data);
    }
    ## add order_details
    public function add(array $data): Order_details
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['order_id'], $data['product_id'], $data['quantity']]);
        return $this;
    }
}