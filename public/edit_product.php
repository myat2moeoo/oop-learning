<?php
require_once "../config/Database.php";
require_once "../classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product ID not provided.");
}
$product->id = $_GET['id'];

$row = $product->readOne();
if (!$row) {
    die("Product not found.");
}

if ($_POST) {
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];

    if ($product->update()) {
        echo "<p style='color:green;'>Product updated successfully.</p>";
        $row = $product->readOne();
    } else {
        echo "<p style='color:red;'>Unable to update product.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post" action="edit_product.php?id=<?= $product->id; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']); ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" cols="30"><?= htmlspecialchars($row['description']); ?></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" value="<?= $row['price']; ?>" required><br><br>

        <input type="submit" value="Update Product">
    </form>
    <br>
    <a href="../index.php">← Back to Products</a>
</body>
</html>
