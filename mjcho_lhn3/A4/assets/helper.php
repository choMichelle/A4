<?php
function addListItem($itemName) {
    echo "<a href=\"modeldetails.php?id=$itemName\" class=\"list-anchor\"><div class=\"models-list-item\">$itemName</div></a>";
}

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

function isInWatchlist($prodCode){
    if(!isset($_SESSION['db'])){
        echo "can't fetch database";
    }
    else{
        $db = $_SESSION['db'];
        $query = "SELECT * FROM watchlist WHERE productCode =? AND email =?";
        $stmt = $db->prepare($query);
		$stmt->bind_param('ss',$prodCode, $_SESSION['email']);
        $stmt->execute();
        $stmt->store_result();
        $bro = $stmt -> num_rows;
        if($stmt -> num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}

function makeUserTable(){
    $db = $_SESSION['db'];
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`users` (`firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `hashedPassword` VARCHAR(255) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB";
    mysqli_query($db, $create_table_query);
}

function makeWatchListTable(){
    $db = $_SESSION['db'];
    $create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`watchlist` (`productCode` VARCHAR(15) NOT NULL , `email` VARCHAR(255) NOT NULL) ENGINE = InnoDB;";
    mysqli_query($db, $create_table_query);
}
?>