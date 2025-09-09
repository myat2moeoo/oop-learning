<?php
require_once "../config/Database.php";
require_once "../classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if(isset($_GET['id'])){
    $product->id = $_GET['id'];
    if($product->delete()){
        header("Location: ../index.php");
        exit;
    }else{
        echo "Failed to delete product.";
    }
}

?>