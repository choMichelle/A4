<?php
//Starting sesions here
session_start();

require_once("db.php");

include("assets/helper.php");
makeUserTable();
makeWatchListTable();
?>