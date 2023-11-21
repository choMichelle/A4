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
            addItemToWatchList($_POST['newWatchListProdName']);
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