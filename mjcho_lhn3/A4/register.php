<!DOCTYPE html>
<?php
require_once("initializer.php");
include("header.php");

require_SSL(); //force to HTTPS

//if already logged in, redirect
if (isset($_SESSION['email'])) {
    header("Location: showmodels.php");
}

$allInputValid = false;

$create_table_query = "CREATE TABLE IF NOT EXISTS `classicmodels`.`users` (`firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `hashedPassword` VARCHAR(255) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB";

mysqli_query($db, $create_table_query);


//TODO - validate email text input to be 
if (validateTextInput('firstName') && validateTextInput('lastName') && validateTextInput('email') &&validateTextInput('password') && validateTextInput('passwordConfirm')) {
    if ($_POST['password'] == $_POST['passwordConfirm']) {
        $allInputValid = true;
    }
    else {
        echo "Please fill in all fields.";
    }
}

if (!empty($_POST["submit"])) {
    if ($allInputValid) {

        //check if the entered email is already registered
        $query_emails = "SELECT count(*) as count FROM users WHERE email=?";
        $stmt_emails = mysqli_prepare($db, $query_emails);
        mysqli_stmt_bind_param($stmt_emails, "s", $_POST['email']);
        mysqli_stmt_execute($stmt_emails);
        $emails_result = mysqli_stmt_get_result($stmt_emails);

        if ($emails_result) {
            $row = mysqli_fetch_assoc($emails_result);
            if ($row['count'] > 0) {
                echo "An account already exists for this email.";
            }
            else {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $hashPassword = sha1($_POST['password']);
    
                //save user data into the db
                $insert_query = "INSERT INTO users (firstName, lastName, email, hashedPassword) VALUES (?,?,?,?)";
                $insert_stmt = mysqli_prepare($db, $insert_query);
                mysqli_stmt_bind_param($insert_stmt, "ssss", $firstName, $lastName, $email, $hashPassword);
                $res = mysqli_stmt_execute($insert_stmt);
    
                //if save successful, set session and redirect
                if ($res) {
                    $_SESSION['email'] = $email;
                    header("Location: showmodels.php");
                    exit;
                }
                else {
                    echo "unable to add user";
                }
            }
        }
          
    }
}

?>

<html lang="en">
<head>
    <title>Register account</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="firstName">First name: </label>
        <input type="text" id="firstName" name="firstName" />

        <label for="lastName">Last name: </label>
        <input type="text" id="lastName" name="lastName" />

        <label for="email">Email: </label>
        <input type="text" id="email" name="email" />

        <label for="password">Password: </label>
        <input type="text" id="password" name="password" />

        <label for="passwordConfirm">Confirm password: </label>
        <input type="text" id="passwordConfirm" name="passwordConfirm" />

        <input type="submit" name="submit"/>
    </form>
    
</body>
</html>