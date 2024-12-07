<?php

class Products{
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function create($name,$description,$cat_id,$price,$unit,$qty){
        $sql = "INSERT INTO products
                    (name,description,category_id,price,unit,quantity) 
                    VALUES (:name,:description,:cat_id,:price,:unit,:qty)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);
        $stmt->bindParam(":unit", $unit, PDO::PARAM_STR);
        $stmt->bindParam("qty", $qty, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update($id,$name,$description,$cat_id,$price,$unit,$qty){
        $sql = "UPDATE products SET name = :name, description = :description, category_id = :cat_id, price = :price, unit = unit, quantity = :qty WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);
        $stmt->bindParam(":unit", $unit, PDO::PARAM_STR);
        $stmt->bindParam("qty", $qty, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function delete($id){
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function get($id){
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAll(){
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}