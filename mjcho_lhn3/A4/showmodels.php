<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

// SSLtoHTTP();

//query for all model names
$query_model_names = "SELECT productName FROM products";
$model_names_result = mysqli_query($db, $query_model_names);
if (!$model_names_result) {
    die("query failed");
}

print_r($_SESSION['email']);
?>

<html>
<head>
    <title>Show models</title>
</head>
<body>
    <div class="models-container">
        <?php
        if (mysqli_num_rows($model_names_result) != 0) {
            while ($row = mysqli_fetch_assoc($model_names_result)) {
                addListItem($row['productName']);
            }
        }
        ?>
    </div>
    <!-- model names from products table in the db, list all, click one item to redirect to model details -->
</body>
<?php
mysqli_free_result($model_names_result);
?>
</html>
<?php
$db->close();
?>