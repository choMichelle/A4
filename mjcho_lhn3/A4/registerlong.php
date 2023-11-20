<?php

require_once("initializer.php");

if(isset($_SESSION['email'])){
    header("Location: index.php");
  }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(
    isset($_POST['email']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['password']) &&
    isset($_POST['password_confirm'])){
        //check if password confirm is correct
        //code is adaptedd from lab
        if($_POST['password'] == $_POST['password_confirm']){
            $sql = "select count(*) as count from users where email=?";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt,"s", $_POST["email"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            //check with email is registered
            if($result){
                $res = mysqli_fetch_assoc($result);
                if($res['count'] > 0){
                    echo "This email is taken.";
                }
            }
            //if not, hash password
            else{
                $hash_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $sql = "insert into admins (first_name, last_name, email, hashed_password) values (?,?,?,?)";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt,"sssss", 
                $_POST["first_name"],
                $_POST['last_name'],
                $_POST['email'],
                $hash_pass);
                $res = mysqli_stmt_execute($stmt);
                if($res){
                    $_SESSION['email'] = $_POST['email'];
                    header("Location: index.php");
                }
            }
        }
    }
}
//finishing recording user's entries
?>

<?php
//start drawing register page
$page_title = 'Register an account';
include('header.php');
?>

<form action="registerlong.php" method="post">
    First Name:<br />
    <input type="text" name="first_name" value="" required /><br />
    Last Name:<br />
    <input type="text" name="last_name" value="" required /><br />
    Email:<br />
    <input type="text" name="email" value="" required /><br />
    Password:<br />
    <input type="password" name="password" value="" required /><br />
    Confirm Password:<br />
    <input type="password" name="password_confirm" value="" required /><br />
    <input type="submit" />
  </form>

