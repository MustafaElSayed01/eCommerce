<?php

class OrderDetails
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($order_id, $product_id, $quantity, $price)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function update($id, $order_id, $product_id, $quantity, $price)
    {
        $sql = "UPDATE order_details SET order_id = :order_id, product_id = :product_id, quantity = :quantity, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM order_details WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function get($id)
    {
        $sql = "SELECT * FROM order_details WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM order_details";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
