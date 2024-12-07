<?php

class Category
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $parent_id)
    {
        $sql = "INSERT INTO categories (name,parent_category_id) VALUES (:name,:parent_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(
            ":parent_id",
            $parent_id,
            $parent_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT
        );
        return $stmt->execute();
    }

    public function update($id, $name, $parent_id)
    {
        $sql = "UPDATE categories SET name = :name, parent_category_id = :parent_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(
            ":parent_id",
            $parent_id,
            $parent_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT
        );
        return $stmt->execute();
    }
    public function delete($id){
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function get($id){
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAll(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
