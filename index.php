<?php
require_once "config/Database.php";
require_once "classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$row_per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
    $page = 1;

$offset = ($page - 1) * $row_per_page;
$total_products = $product->countAll();
$total_pages = ceil($total_products / $row_per_page);

$stmt = $product->readWithPagination($offset, $row_per_page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
</head>

<body>
    <h1>Product List</h1>
    <div style="display: flex; justify-content: flex-start; gap: 20px; margin-bottom: 15px;">
        <a href="public/add_product.php">Add New Product</a>
        <a href="public/deleted_product.php">Restore</a>
    </div>

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
            echo "<td>";
            echo "<a href='public/edit_product.php?id=" . $row['id'] . "'>Edit</a> | ";
            echo "<a href='public/delete_product.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div style="margin-top: 20px">
        <?php
        $disabledFirstPrev = ($page <= 1) ? "style='color: gray; pointer-events: none;'" : "";
        $disabledNextLast = ($page >= $total_pages) ? "style='color: gray; pointer-events: none;'" : "";

        echo "<a href='?page=1' $disabledFirstPrev>First</a> ";
        echo "<a href='?page=" . ($page - 1) . "' $disabledFirstPrev>Previous</a> ";

        if($page <= 2){
            $start_page = 1;
            $end_page = min(3, $total_pages);
        }elseif ($page >= $total_pages){
            $start_page = max(1, $total_pages - 2);
            $end_page = $total_pages;
        }else{
            $start_page = $page - 1;
            $end_page = $page + 1;
        }

        for($i = $start_page; $i <= $end_page; $i++){
            if($i == $page){
                echo "<strong>[$i]</strong>";
            }else{
                echo "$i";
            }
        }
        echo "<a href='?page=" . ($page + 1) . "' $disabledNextLast>Next</a> ";
        echo "<a href='?page=$total_pages' $disabledNextLast>Last</a>";
        ?>
    </div>
</body>

</html>