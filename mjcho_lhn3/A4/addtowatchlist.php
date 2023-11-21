<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

SSLtoHTTP();
?>

<?php
if (isset($_SESSION['email'])) {    
    //Create a table for watchlist with user email and model column
    $allInputValid = false;
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`watchlist` (`email` VARCHAR(320) NOT NULL , `hashedPassword` VARCHAR(255) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB";
    mysqli_query($db, $create_table_query);
    //redirect the player back to the item when they login
    
}
else{
    $_SESSION['callback_url'] = 'addtowatchlist.php';
    header("Location: login.php");
}


?>

<html lang="en">
    <head>

    </head>
    <body>

    </body>
</html>