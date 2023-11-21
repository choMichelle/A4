<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

require_SSL(); //force to HTTPS


if (!empty($_POST['submit'])) {
    if (validateTextInput($_POST['email']) && validateTextInput($_POST['password'])) {
        $hash_pass = sha1($_POST['password']);
        $query_accounts = "SELECT hashedPassword FROM users WHERE email=?";
    
        $stmt_accounts = mysqli_prepare($db, $query_accounts);
        mysqli_stmt_bind_param($stmt_accounts, "s", $_POST['email']);
        mysqli_stmt_execute($stmt_accounts);
        $result = mysqli_stmt_get_result($stmt_accounts);
    
        if (!empty($result)) {
            $row = mysqli_fetch_assoc($result);
    
            if (mysqli_num_rows($result) != 0) {
                $row = mysqli_fetch_assoc($result);
                if ($hash_pass === $row['hashedPassword']) {
                    //set session (log in) and redirect
                    $_SESSION['email'] = $_POST['email'];
                    header("Location: showmodels.php");
                }
                
            }
            else {
                echo "Incorrect email or password.";
            }
        }
    }
}
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