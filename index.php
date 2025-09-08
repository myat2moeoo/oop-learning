<?php
require_once "config/Database.php";
require_once "classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->readAll();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Info</title>
</head>

<body>
    <h1>Product List</h1>
    <a href="public/add_product.php">Add New Product</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['price']; ?></td>
                <td>
                    <a href="public/edit_product.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="public/delete_product.php?id=<?= $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>