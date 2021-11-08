<?php

include "includes/navbar.php";
include "includes/dbconn.php";
$user_id = $_SESSION['user_id'];
$order_id= $_GET['order_id'];

$query= "SELECT * from orders where order_id like '$order_id'";
$result = mysqli_query($conn, $query);
$result= mysqli_fetch_assoc($result);

$total = $result['amount'];

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <h4>Select Payment Options</h4> 
                </div>
                <form class="form" action="complete_order.php" method="POST">
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <div class="card-body"><input type="radio" class="mr-3"  value="Debit Card" name="x"><i class="fab fa-cc-visa fa-lg"></i> 
                            Debit Card</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"><input type="radio" class="mr-3" value="Credit Card" name="x"><i class="far fa-credit-card fa-lg"></i> Credit Card</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"><input type="radio" class="mr-3" value="UPI"  name="x"><i class="fab fa-cc-paypal fa-lg"></i> UPI</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"><input type="radio" class="mr-3" value="Netbanking"  name="x"> <i class="fas fa-university fa-lg"></i> Netbanking</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"><input type="radio" class="mr-3" value="CashOnDelevery"  name="x"> <i class="fas fa-money-bill-wave fa-lg"></i> Cash On Delivery</div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="submit" value="paynow" class="btn btn-lg btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <h4>Order Details</h4>
                    <h5>Total Amount</h5>
                    <h3>Rs 
                        <span>
                            <?php echo $total; 
                            ?>
                        </span> 
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>