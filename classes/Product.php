<?php
class Product
{
    private $conn;
    private $table_name = "products";
    public $id;
    public $name;
    public $description;
    public $price;
    public $is_deleted;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create product
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (name, description, price, is_deleted) VALUES (:name, :description, :price, 0)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);

        return $stmt->execute();
    }

    // Read all products
    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_deleted = 0 order by id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get single product
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? AND is_deleted = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update product
    public function update()
    {
        $query = "UPDATE " . $this->table_name . "
                  SET name = :name, description = :description, price = :price
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Delete product
    public function delete()
    {
        $query = "UPDATE " . $this->table_name . " SET is_deleted = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function restore()
    {
        $query = "UPDATE " . $this->table_name . " SET is_deleted = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function readDeleted()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_deleted = 1 ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}
?>