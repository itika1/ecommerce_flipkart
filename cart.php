<?php
    include "includes/navbar.php";
    include "includes/dbconn.php";
?>

<script type="text/javascript">
    $(document).ready(function(){


        $('#checkout').click(function(){
            var amount = $('#total_amount').text();
            $.ajax({
                url: 'place_order.php',
                method: 'POST',
                data : {'amount': amount},
                success: function(data){
                        //redirect to select address page
                        window.location.href = "http://localhost/flipkart/show_address.php?order_id=" +data;
                },
                error: function(error){

                }
            })
        })
        //For coupon btn fetch the data
        $('#coupon-btn').click(function(){
            var user_input = $('#coupon_code').val();
            //fetch inside database
            $.ajax({
                url: 'apply_coupon.php',
                method: 'POST',
                data:{'user_input': user_input},
                success:function(data){
                    if(data === 'invalid'){
                        $('#coupon-message').html("<p style='color:red'>Coupon code invalid</p>")
                    }else if(data === 'expired'){
                        $('#coupon-message').html("<p style='color:red'>Coupon expired</p>")
                    }else{
                        $('#coupon-message').html("<p style='color:green'>Coupon applied successfully</p>")
                        var total = $('#total_amount').text();
                        var discount_val= Math.round(Number(data)/100 * Number(total));
                        var new_total = total - discount_val;
                        $('#total_amount').text(new_total);
                        $('#coupon_discount_value').text(discount_val);
                    }
                    $('#coupon_code').val('');
                },
                error: function(error){

                }
            })
        })

        $('.change_quantity').click(function(){
            // 1. Update the quantity in frontend
            var quantity = $(this).siblings('span').text();
            var price= $(this).parent().parent().siblings('.col-md-7').children('h5').children('span').text();
             // 2. update the total
            var total = $('#total_amount').text();
            
            // 3. update the quantity in database
            //fetch product id
            var product_id = $(this).data('id');
            var sign = $(this).text();
            if(sign === '+'){
                $(this).siblings('span').text(Number(quantity) +1);
                $('#total_amount').text(Number(total)+ Number(price));
                $('#tax').text(Math.round((Number(total)+ Number(price))*0.18));
            }else{
                $(this).siblings('span').text(Number(quantity) -1);
                $('#total_amount').text(Number(total) - Number(price));
                $('#tax').text(Math.round((Number(total) - Number(price))*0.18));
            }
            
            $.ajax({
                url: 'update_cart_quantity.php',
                method: 'POST',
                data : {'product_id': product_id, 'sign': sign},
                success: function(data){
                    console.log(data);
                },
                error: function(error){
                    console.log(error);
                }
            })

        })
    })
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-5 mb-5">My Cart</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
        <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM cart w JOIN products p ON p.product_id = w.product_id WHERE w.user_id = $user_id;
            ";
            $result = mysqli_query($conn, $query);
            $total=0;
            $counter=0;
            while($row = mysqli_fetch_assoc($result)){
                $counter++;
                $total= $total+ ($row['price']* $row['quantity']);
                $img = substr(explode(',', $row['bg_img'])[0], 1);
                echo '<div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src='.$img.' style="width: 100%; height: auto; padding: 20px">
                                </div>
                                <div class="col-md-7">
                                    <h3>'.$row['name'].'</h3>
                                    <h5>Rs <span>'.$row['price'].'</span></h5>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-5">
                                        <button class="btn btn-sm btn-default change_quantity" style="background-color: #FBFBFB; border: 1px solid black; border-radius: 50px;"
                                        data-id="'.$row['product_id'].'">-</button>
                                        <span>'.$row['quantity'].'</span>
                                        <button class="btn btn-sm btn-default change_quantity" style="background-color: #FBFBFB; border: 1px solid black; border-radius: 40px;"
                                        data-id="'.$row['product_id'].'">+</button>
                                    </div>
                            
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            if($counter==0){
                echo "<h4>Cart is Empty</h4>";
            }
        ?>
        </div>
        
        <?php
        if($counter!=0){
            echo '<div class="col-md-3">
            <div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">Total Price</div>
						<div class="col-md-6 mb-2">Rs <span id="total_amount">'.$total.' </span></div>
						<div class="col-md-6">Discount</div>
						<div class="col-md-6 mb-2" style="color: green; font-weight: semibold;">Rs <span id="coupon_discount_value">0</span></div>
						<div class="col-md-6">Total Tax</div>
						<div class="col-md-6 mb-2" style="color: green; font-weight: semibold;">Rs <span id="tax" >'.$total*0.18.'</span></div>
						<div class="col-md-12">
							<p>Apply Discount</p>
                            <div id="coupon-message" style="text-color: green;">

                            </div>
							<input type="text" name="" class="form-control" id="coupon_code">
							<button class="btn btn-sm btn-primary mt-2" id="coupon-btn">Apply</button>
						</div>
						<div class="col-md-12">
							<button id="checkout" class="btn bg-amazon btn-block text-white mt-2" style="background-color:#FB641B;">Place Order</button>
						</div>
					</div>
				</div>
				
			</div>
        </div>';
        }
        ?>
        
        
    </div>
    <div class="row">
        
    </div>
    
</div>