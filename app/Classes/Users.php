<?php
class Users
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($user_name, $password, $email_address, $phone_number, $national_id, $full_name, $role)
    {
        $user_name = InputSanitizer::sanitizeAndValidate($user_name);
        $email_address = InputSanitizer::sanitizeAndValidate($email_address, 'email');
        $phone_number = InputSanitizer::sanitizeAndValidate($phone_number, 'phone');
        $full_name = InputSanitizer::sanitizeAndValidate($full_name);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_name, password, email_address, phone_number, national_id, full_name, role)
                VALUES (:user_name, :password, :email_address, :phone_number, :national_id, :full_name, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":email_address", $email_address, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(":national_id", $national_id, PDO::PARAM_INT);
        $stmt->bindParam(":full_name", $full_name, PDO::PARAM_STR);
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update($id, $user_name, $password, $email_address, $phone_number, $national_id, $full_name, $role)
    {
        $user_name = InputSanitizer::sanitizeAndValidate($user_name);
        $email_address = InputSanitizer::sanitizeAndValidate($email_address, 'email');
        $phone_number = InputSanitizer::sanitizeAndValidate($phone_number, 'phone');
        $full_name = InputSanitizer::sanitizeAndValidate($full_name);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users
                SET user_name = :user_name,
                    password = :password,
                    email_address = :email_address,
                    phone_number = :phone_number,
                    national_id = :national_id,
                    full_name = :full_name,
                    role = :role
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":email_address", $email_address, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(":national_id", $national_id, PDO::PARAM_INT);
        $stmt->bindParam(":full_name", $full_name, PDO::PARAM_STR);
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function get($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
