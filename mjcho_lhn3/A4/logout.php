<?php
session_unset();
session_destroy();
header('location: showmodels.php');
?>