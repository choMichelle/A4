<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

SSLtoHTTP();
?>

<?php
if (isset($_SESSION['email'])) {    
    //Create a table for watchlist with user email and model column


    //save user data into the db
    if(!isset($POST['newWatchListProdCode'])){
        $productCode = $_POST['newWatchListProdCode'];
        $postedEmail = $_SESSION['email'];
        $insert_query = "INSERT INTO watchlist (productCode, email) VALUES (?,?)";
        $insert_stmt = mysqli_prepare($db, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "ss", $productCode, $postedEmail);
        $res = mysqli_stmt_execute($insert_stmt);

        unset($_POST['newWatchListProdCode']);
    }
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