<!DOCTYPE html>
<?php
require_once("db.php");
include("header.php");

$invalidID = true;
$id = $_GET["id"]; //get product id from showmodels.php

//query for all model names
$query_model_names = "SELECT productName FROM products";
$model_names_result = mysqli_query($db, $query_model_names);
if (!$model_names_result) {
    die("query failed");
}

//check if the product id is valid
if (mysqli_num_rows($model_names_result) != 0) {
    while ($row = mysqli_fetch_assoc($model_names_result)) {
        if ($row['productName'] === $id) {
            $invalidID = false;
            break;
        }
    }
}

mysqli_free_result($model_names_result); //release product names query result

//prepared stmt
$query_product = "SELECT * FROM products WHERE productName = ?";
$stmt_product = mysqli_prepare($db, $query_product);

//check if stmt prep failed
if(!$stmt_product) {
    die("Error:" .mysqli_error($db));
}
?>
<html>
    <head>

    </head>
    <body>
        <?php
        if ($invalidID) {
            echo "Product not found.";
        }
        else {
            mysqli_stmt_bind_param($stmt_product, "s", $id);
            mysqli_stmt_execute($stmt_product);
            $result = mysqli_stmt_get_result($stmt_product);

            if (mysqli_num_rows($result) != 0) {
                echo "<table>";
                echo $id;
                while ($row = mysqli_fetch_assoc($result)) {
                    //add a row for each retrieved row in the result
                    echo "<tr>";

                    //add cells in the row for the values of each column
                    
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
        <!-- "add to watchlist" button/link that redirects to addtowatchlist.php -->
        <!-- can't add duplicates to watchlist (no add if already in watchlist) -->
    </body>
</html>
<?php

$db->close();
?>