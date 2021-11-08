<?php

//database connect
include "includes/dbconn.php";
session_start(); //associative array to add new keyword
//receive html data --> $post
$email= $_POST['user_email'];
$password= $_POST['user_password'];
//search query --> SELECT
$query = "SELECT * FROM users WHERE email LIKE '$email' AND password LIKE '$password'";
$result= mysqli_query($conn, $query);
$num_rows= mysqli_num_rows($result);

$result= mysqli_fetch_assoc($result); //fetch the array

//compare
if($num_rows == 1){
    //set session
    $_SESSION['name']= $result['name']; //under session the value of name key is stored
    $_SESSION['user_id'] = $result['user_id'];
    header('Location:profile.php');
}else{
    echo "Incorrect email/password";
}

?>