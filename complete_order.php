<?php
include "includes/dbconn.php";
session_start();

$order_id= $_POST['order_id'];
$user_id= $_SESSION['user_id'];
$payment_method= $_POST['x'];

$query= "UPDATE orders SET status=1, payment_method='$payment_method' where order_id like '$order_id'";
if(mysqli_query($conn, $query)){

    //clear cart
    $query1= "DELETE from cart where user_id=$user_id";
    if(mysqli_query($conn, $query1)){
        header('Location: success.php');
    }else{
        echo "Could not clear cart";
    }
    
}else{
    header('Location:show_payment_options.php?order_id='.$order_id);
}
?>