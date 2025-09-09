<?php
require_once "../config/Database.php";
require_once "../classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->readDeleted();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Products</title>
</head>
<body>
    <h1>Deleted Products</h1>
    <a href="../index.php">Back to Product List</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td><a href='restore_product.php?id=" . $row['id'] . "'>Restore</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>