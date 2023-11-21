<?php
function addListItem($itemName) {
    echo "<a href=\"modeldetails.php?id=$itemName\" class=\"list-anchor\"><div class=\"models-list-item\">$itemName</div></a>";
}
    $db = $_SESSION['db'];
//force page to use HTTPS
function require_SSL() {
    if ($_SERVER["HTTPS"] != "on") {
        header("Location: https://" .$_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"]);
        exit();
    }
}

//force page to use HTTP
function SSLtoHTTP() {
    if (isset($_SERVER["HTTPS"])) {
        header("Location: http://" .$_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function validateTextInput($inputName) {
    if (isset($_POST[$inputName]) && !empty($_POST[$inputName])) {
        return true;
    }
}

function isInWatchlist($prodName){
    if(!isset($_SESSION['db'])){
        echo "can't fetch database";
    }
    else{
        $db = $_SESSION['db'];
        $query = "SELECT * FROM watchlist WHERE productName=? AND email =?";
        $stmt = $db->prepare($query);
		$stmt->bind_param('ss',$prodName, $_SESSION['email']);
        $stmt->execute();
        $stmt->store_result();

        if($stmt -> num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}

function showUserWatchlist($email){
    $db = $_SESSION['db'];
    $query = "SELECT * FROM watchlist WHERE email =?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $bro = $stmt->num_rows;
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            addListItem($row['productName']);
        }
    } else {
        echo "Watchlist is empty";
    }
}

function makeUserTable(){
    $db = $_SESSION['db'];
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`users` (`firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `hashedPassword` VARCHAR(255) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB";
    mysqli_query($db, $create_table_query);
}

function makeWatchListTable(){
    $db = $_SESSION['db'];
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`watchlist` (`productName` VARCHAR(225) NOT NULL , `email` VARCHAR(255) NOT NULL) ENGINE = InnoDB;";
    mysqli_query($db, $create_table_query);
}

function addItemToWatchList($item){
    $db = $_SESSION['db'];
    $productName = $item;
    $postedEmail = $_SESSION['email'];
    //GPT taught me INSERT IGNORE INTO
    $insert_query = "INSERT IGNORE INTO watchlist (productName, email) VALUES (?,?)";
    $insert_stmt = mysqli_prepare($db, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ss", $productName, $postedEmail);
    mysqli_stmt_execute($insert_stmt);
}
?>

