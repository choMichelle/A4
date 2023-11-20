<?php
//Starting sesions here
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
else {
    $email = $_SESSION['email'] = [];
}

require_once("db.php");
include("assets/helper.php");
?>