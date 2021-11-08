<?php

include "includes/navbar.php";
include "includes/dbconn.php";
$user_id = $_SESSION['user_id'];
$order_id= $_GET['order_id'];

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <h4>Select Address</h4> 
                </div>
                <?php
                    $query= "SELECT * FROM address WHERE user_id= $user_id";
                    $result = mysqli_query($conn, $query);
                    $counter = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <p>'.$row['details'].' <br>
                                   '.$row['phone'].' <br>
                                   Pin Code - '.$row['pincode'].'  
                                </p>
                                <a href="update_address.php?address_id='.$row['address_id'].'&order_id='.$order_id.'" class="btn btn-sm" style="background-color: #FB641B;"> Continue with this address</a>
                            </div>
                        </div>
                    </div>';
                    $counter++;
                    }
                    if($counter ==0){
                        echo '<div class="col-md-12 mt-3">
                                <h4>You dont have any addresses</h4>
                              </div>';
                    }

                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <h4>Add New Address</h4>
                    <form action="add_new_address.php" method="POST">
                        <label for="">Address Details</label> <br>
                        <textarea name="details" cols="2" rows="2" class="form-control"></textarea><br>
                        <label>Phone</label> <br>
                        <input type="text" name="phone" class="form-control"> <br>
                        <label>Pincode</label> <br>
                        <input type="text" name="pincode" class="form-control"> <br>
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="submit" class="btn" style="background-color: #FB641B;" name="" value="Add Address">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>