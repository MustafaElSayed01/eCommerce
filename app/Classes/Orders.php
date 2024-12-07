<?php

class Orders
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($user_id, $VAT, $total_price)
    {
        $sql = "INSERT INTO orders (user_id, VAT, total_price) VALUES (:user_id, :VAT, :total_price)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":VAT", $VAT, PDO::PARAM_STR);
        $stmt->bindParam(":total_price", $total_price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function update($id, $user_id, $VAT, $total_price)
    {
        $sql = "UPDATE orders SET user_id = :user_id, VAT = :VAT, total_price = :total_price WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":VAT", $VAT, PDO::PARAM_STR);
        $stmt->bindParam(":total_price", $total_price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function get($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
