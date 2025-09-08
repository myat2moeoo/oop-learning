<?php
require_once "../config/Database.php";
require_once "../classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if (isset($_GET['id'])) {
    $product->id = $_GET['id'];
    if ($product->delete()) {
        echo "<p style='color:green;'>Product deleted successfully.</p>";
    } else {
        echo "<p style='color:red;'>Unable to delete product.</p>";
    }
} else {
    echo "<p style='color:red;'>No product ID provided.</p>";
}
?>

<a href="../index.php">← Back to Products</a>
