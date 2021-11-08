<?php
include "includes/dbconn.php";
session_start();
$user_id= $_SESSION['user_id'];
$old_password= $_POST['old'];
$new_password= $_POST['new'];

$query= "select * from users where user_id = $user_id";
$result= mysqli_query($conn, $query);
$result =mysqli_fetch_assoc($result);
if($result['password']== $old_password){
    $query2 = "UPDATE users SET password='$new_password' where user_id= $user_id";
    if(mysqli_query($conn, $query2)){
        header('Location:profile.php?message=1');
    }else{
        header('Location:profile.php?message=2');
    }
}else{
    header('Location:profile.php?message=0');
}


?>