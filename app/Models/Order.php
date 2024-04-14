<?php
namespace App\Models;
use PDO;
use App\Models\PDOFactory;
use App\models\{Customer,Order_details};
use PDOException;
class Order {
    private ?PDO $db;
    private int $order_id = -1;
    private $order_create_at;
    private $order_status;
    private $order_total;
    private $customer;

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }
    ## fill data
    public function fill(array $data): Order
    {
        $this->order_create_at = $data['order_create_at'] ?? '';
        $this->order_status = $data['order_status'] ?? '';
        $this->order_total = $data['order_total'] ?? '';
        $this->customer = $data['customer'] ?? '';
        return $this;
    }
    ## fill from db
    public function fillFromDb(array $data): Order
    {
        $this->order_id = $data['order_id'] ?? -1;
        $this->order_create_at = $data['created_at'] ?? '';
        $this->order_status = $data['order_status'] ?? '';
        $this->order_total = $data['order_total'] ?? '';
        $this->customer = $data['customer'] ?? '';
        return $this;
    }
    ## get id
    public function getId(): int
    {
        return $this->order_id;
    }
    ## get all order
    public function all(): array
    {
        $sql = "SELECT * FROM orders, customers WHERE orders.customer_id = customers.customer_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $orders = [];
        while ($data = $stmt->fetch()) {
            $order = (new Order($this->db))->fillFromDb($data);
            $order->customer = (new Customer($this->db))->fillFromDb($data);
            array_push($orders, $order);
        }
        return $orders;
        
    }
    ## get order by id
    public function getById(int $id): ?Order
    {
        $sql = "SELECT * FROM orders WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Order($this->db))->fillFromDb($data);
    }
    ## get order by customer
    public function getOrders(): array
    {
        $sql = "SELECT * FROM orders WHERE customer_id = ?";
        $stmt = $this->db->prepare($sql);
        $customer_id = $this->customer->getId();
        $stmt->execute([$customer_id]);
        $data = $stmt->fetchAll();
        $orders = [];
        foreach ($data as $order) {
            array_push($orders, (new Order($this->db))->fillFromDb($order));
        }
        return $orders;
    }
    ## save order
   
    ## approve order
    public function approveOrder($id)
    {
        $sql = "UPDATE orders SET order_status = 1 WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }

    ## get order_status
    public function getStatus(): string
    {
        return $this->order_status;
    }
    ## get order_total
    public function getTotal(): string
    {
        return $this->order_total;
    }
    ## get order_create_at
    public function getCreateAt(): string
    {
        return $this->order_create_at;
    }
    ## get customer
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
    ## add order
    public function add($data,$cart)
    {   
        try{
            $this->fill($data);
            $sql = "INSERT INTO orders ( order_status, order_total, customer_id) VALUES ( :order_status, :order_total, :customer_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':order_status', $this->order_status, PDO::PARAM_INT);
            $stmt->bindParam(':order_total', $this->order_total, PDO::PARAM_INT);
            $customer_id = $this->customer->getId();
            $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $stmt->execute();
            $order_id = $this->db->lastInsertId();
            foreach ($cart as $product_id => $quantity) {
                $sql = "INSERT INTO order_details (order_id, product_id, quantity) VALUES ( :order_id, :product_id, :quantity)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->execute();
            }
            foreach ($cart as $product_id => $quantity) {
                $sql = "UPDATE products SET sold_quantity = sold_quantity + :quantity WHERE product_id = :product_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
            }

        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
       
    }
    ## get order by customer
    public function getOrdersByCustomer($id): array
    {
        $sql = "SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        $orders = [];
        foreach ($data as $order) {
            array_push($orders, (new Order($this->db))->fillFromDb($order));
        }
        return $orders;
    }
    ## get details Order
    public function getOrderDetails(): array
    {
        $sql = "SELECT * FROM order_details WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->order_id]);
        $data = $stmt->fetchAll();
        $details = [];
        foreach ($data as $detail) {
           $Order_details =new Order_details($this->db);
              $Order_details->fillFromDb($detail);
            array_push($details, $Order_details);
        }
        return $details;
    }
    ## get order date
    public function getOrderDate(): string
    {   
        return $this->order_create_at;
    }
    ##destroy order
    public function destroyOrder($id)
    {
        $sql = "UPDATE orders SET order_status = -1 WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }
    ## get order by filter
    public function getOrderByFilter($status): array
    {
        $sql = "SELECT * FROM orders WHERE order_status = :order_status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_status' => $status]);
        $data = $stmt->fetchAll();
        $orders = [];
        foreach ($data as $order) {
            array_push($orders, (new Order($this->db))->fillFromDb($order));
        }
        return $orders;
    }
    ## paginate
    public static function paginate($offset, $limit,$Orders): array
    {
        return array_slice($Orders, $offset, $limit);
    }
    

    
}
