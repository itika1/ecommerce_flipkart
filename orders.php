<?php
include "includes/dbconn.php";
include "includes/navbar.php";
$user_id= $_SESSION['user_id'];

?>

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-8 mb-4">
            <h1>My Orders</h1>
        </div>
        <?php
            $query= "SELECT * from orders where user_id= $user_id ORDER BY date DESC";
            $result = mysqli_query($conn, $query);
            while($row=mysqli_fetch_assoc($result)){
                $current_id= $row['order_id'];
                $query1 = "SELECT * FROM order_details o JOIN products p ON p.product_id=o.product_id
                 WHERE o.order_id like '$current_id'";

                $result1= mysqli_query($conn, $query1);

                echo '<div class="col-md-8"><div class="card mb-5" >
                        <div class="card-body">
                        <h5>Order Id - '.$row['order_id'].'
                            <span style="float:right">
                                Date- '.$row['date'].'
                            </span>
                        </h5>';
                
                
                while($row1 = mysqli_fetch_assoc($result1)){
                    $img = substr(explode(',', $row1['bg_img'])[0], 1);
                    echo '<div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src='.$img.' style="width: 100%; height: auto; padding: 20px">
                                </div>
                                <div class="col-md-7">
                                    <h5><a href="description.php?product_id='.$row1['product_id'].'"> '.$row1['name'].' </a></h5>
                                    <h5>Rs <span>'.$row1['price'].'</span></h5>
                                </div>
                                
                            </div>
                        </div>
                    </div>';
                }
                echo '<h4 class="mt-3">Amount Paid - '.$row['amount'].'</h4>
                </div></div></div>';
            }
        ?>

        
    </div>
</div>