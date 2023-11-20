<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

SSLtoHTTP();

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

if ($invalidID) {
    echo "Product not found.";
}
else {
    //bind and execute stmt
    mysqli_stmt_bind_param($stmt_product, "s", $id);
    mysqli_stmt_execute($stmt_product);

    //get query result
    $result = mysqli_stmt_get_result($stmt_product);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //save all data values in variables
            $prodCode = $row['productCode']; //
            $buyPrice = $row['buyPrice']; // 
            $msrp = $row['MSRP']; //
            $prodDesc = $row['productDescription']; //
            $prodLine = $row['productLine']; //
            $prodName = $row['productName']; //
            $prodScale = $row['productScale']; //
            $prodVendor = $row['productVendor']; //
            $stockQty = $row['quantityInStock'];
        }
    }
}
mysqli_free_result($result);
?>
<html lang="en">
    <head>
        <title><?php echo $id; ?></title>
    </head>
    <body>
        <div class="detail-container">
            
            <div><?php echo "<h1>$prodName</h1>"; ?></div>
            <div class="detail-multi-horizontal">
                <div><?php echo "Product code: $prodCode"; ?></div>
                <div><?php echo "Product line: $prodLine"; ?></div>
            </div>
            <div><?php echo "Scale: $prodScale"?></div>
            
            <div class="detail-description"><?php echo $prodDesc; ?></div>

            <div class="detail-button">
                <div><?php echo "Buy it for $$buyPrice"?></div>

                <div class="detail-multi-horizontal">
                    <div><?php echo "$stockQty left " ?></div>
                    <div><?php echo "Sold by $prodVendor" ?></div>
                </div>
            </div>

            <div class="detail-multi-horizontal">
                <div><?php echo "MSRP: $$msrp"?></div>
                <div><a href="addtowatchlist.php">Add to watchlist</a></div>
            </div>

        </div>
        
        <!-- "add to watchlist" button/link that redirects to addtowatchlist.php -->
        <!-- can't add duplicates to watchlist (no add if already in watchlist) -->
    </body>
</html>
<?php

$db->close();
?>