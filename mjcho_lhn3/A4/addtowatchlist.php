<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

SSLtoHTTP();
?>

<?php
    if (isset($_SESSION['email'])) {    

        //save user data into the db
        if(isset($_POST['newWatchListProdName'])){
            $productName = $_POST['newWatchListProdName'];
            $postedEmail = $_SESSION['email'];
            //GPT taught me INSERT IGNORE INTO
            $insert_query = "INSERT IGNORE INTO watchlist (productName, email) VALUES (?,?)";
            $insert_stmt = mysqli_prepare($db, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "ss", $productName, $postedEmail);
            $res = mysqli_stmt_execute($insert_stmt);

            unset($_POST['newWatchListProdName']);
        }
        showUserWatchlist($_SESSION['email']);
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