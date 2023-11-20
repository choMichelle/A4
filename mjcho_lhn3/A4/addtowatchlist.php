<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

// SSLtoHTTP();
?>

<?php
if (isset($_SESSION['email'])) {    

    //Create a table for watchlist with useremail and model column
    $allInputValid = false;
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`watchlist` (`email` VARCHAR(255) NOT NULL , `hashedPassword` VARCHAR(255) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB";
    mysqli_query($db, $create_table_query);
}


?>

<html lang="en">
    <head>

    </head>
    <body>

    </body>
</html>