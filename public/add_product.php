<?php
require_once "../config/Database.php";
require_once "../classes/Product.php";

// connect to database
$database = new Database();
$db = $database->getConnection();

// create product object
$product = new Product($db);

// handle form submission
if ($_POST) {
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];

    if ($product->create()) {
        echo "<p style='color:green;'>Product was added successfully.</p>";
    } else {
        echo "<p style='color:red;'>Unable to add product.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form method="post" action="add_product.php">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" cols="30"></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br><br>

        <input type="submit" value="Save Product">
    </form>
    <br>
    <a href="../index.php">← Back to Products</a>
</body>
</html>
