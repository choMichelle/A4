<?php
session_start();
session_destroy();
header('location: showmodels.php');
?>