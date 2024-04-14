<?php
namespace App\Models;
use App\Utils\Helper;
use App\Models\PDOFactory;
use PDOException;
use PDO;
class Customer{
    private ?PDO $db;
    private int $customer_id = -1;
    private $customer_name, $customer_email, $customer_phone,$customer_gender, $customer_address,$username,$password;
    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }
    ## fill data
    public function fill(array $data): Customer
    {
        $this->customer_name = $data['customer_name'] ?? '';
        $this->customer_email = $data['customer_email'] ?? '';
        $this->customer_phone = $data['customer_phone'] ?? '';
        $this->customer_gender = $data['customer_gender'] ?? '';
        $this->customer_address = $data['customer_address'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        return $this;
    }
    ## fill from db
    public function fillFromDb(array $data): Customer
    {
        $this->customer_id = $data['customer_id'] ?? -1;
        $this->customer_name = $data['customer_name'] ?? '';
        $this->customer_email = $data['customer_email'] ?? '';
        $this->customer_phone = $data['customer_phone'] ?? '';
        $this->customer_gender = $data['customer_gender'] ?? '';
        $this->customer_address = $data['customer_address'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        return $this;
    }
    ## get id
    public function getId(): int
    {
        return $this->customer_id;
    }
    ## getname
    public function getName(): string
    {
        return $this->customer_name;
    }
    ## get gender
    public function getGender(): string
    {
        return $this->customer_gender;
    }
    ## get email
    public function getEmail(): string
    {
        return $this->customer_email;
    }
    ## get phone
    public function getPhone(): string
    {
        return $this->customer_phone;
    }
    ## get address
    public function getAddress(): string
    {
        return $this->customer_address;
    }
    ## get Password
    public function getPassword(): string
    {
        return $this->password;
    }

    ## get all customer
    public function login($data): ?Customer
    {
        $sql = "SELECT * FROM customers WHERE username = :username AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $data['username'],PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['password'],PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Customer($this->db))->fillFromDb($data);
    }
   ## check username
    public function checkUsername(): bool
    {
        $sql = "SELECT * FROM customers WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->username]);
        $data = $stmt->fetch();
        if (!$data) {
            return false;
        }
        return true;
    }
    ## get by username
    public function getByUsername(string $username): ?Customer
    {
        $sql = "SELECT * FROM customers WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return (new Customer($this->db))->fillFromDb($data);
    }
    ## register
    public function register(): bool
    {   
        if($this->checkUsername()){
            return false;
        }
        else{
            $sql = "INSERT INTO customers (customer_name, customer_email, customer_phone,customer_gender, customer_address, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$this->customer_name, $this->customer_email, $this->customer_phone, $this->customer_gender, $this->customer_address, $this->username, $this->password]);
        }
      
    }
    ## get customer by id

    public function getUsername(): string
    {
        return $this->username;
    }
    ## get all customer
    ## update customer
    public function update(array $data): bool
    {   
        try{

            $sql = "UPDATE customers SET customer_name = :customer_name, customer_email = :customer_email, customer_phone = :customer_phone, customer_gender = :customer_gender, customer_address = :customer_address WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':customer_name', $data['customer_name'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_email', $data['customer_email'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_phone', $data['customer_phone'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_gender', $data['customer_gender'], PDO::PARAM_INT);
            $stmt->bindParam(':customer_address', $data['customer_address'], PDO::PARAM_STR);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            return $stmt->execute();
        }
        catch(PDOException $e){
           ($e->getMessage());
            return false;
        }
    }
        
    ## change password
    public function changePassword($data): bool
    {   
        $sql = "UPDATE customers SET password = :password WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
}

