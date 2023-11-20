<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

require_SSL(); //force to HTTPS

?>
<html lang="en">
    <head>
        <title>Log in</title>
    </head>
    <body>
        <form action="login.php" method="POST">
            <label for="email">Email: </label>
            <input type="text" id="email" name="email" />

            <label for="password">Password: </label>
            <input type="text" id="password" name="password" />

            <input type="submit" name="submit"/>
        </form>
        <a href="register.php"><div>Register here</div></a>
    </body>
</html>