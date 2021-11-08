<?php
    include "includes/navbar.php";
?>
<?php
$product_id = $_GET['product_id'];
include "includes/dbconn.php";

$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);

$img = substr(explode(',', $result['bg_img'])[0], 1);

$query4= "Select * from reviews where product_id= $product_id";
$result4 = mysqli_query($conn, $query4);
$counter=0;
$total=0;
while($row4=mysqli_fetch_assoc($result4)){
    $counter++;
    $total= $total+ $row4['rating'];
}
if($counter== 0){
    $avg_rating = "No Rating";
}else{
    $avg_rating= round($total/$counter);
}


?>

<?php
$user_id = $_SESSION['user_id'];
$query1 = "SELECT * FROM wishlist WHERE user_id=$user_id AND product_id=$product_id";
$result1 = mysqli_query($conn, $query1);
$num_rows = mysqli_num_rows($result1);

?>



<?php
$user_id = $_SESSION['user_id'];
$query2 = "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id";
$result2 = mysqli_query($conn, $query2);
$num_rows2 = mysqli_num_rows($result2);

?>

<script type="text/javascript">
    $(document).ready(function(){
		$('#wishlist-btn').click(function(){
			var product_id = '<?php echo $product_id; ?>';
			$.ajax({
				url:'add_to_wishlist.php',
				method:'POST',
				data:{'product_id':product_id},
				success:function(data){

					if(data === 'Success'){
						$('#wishlist-btn').hide();
						$('#button-container').append('<button class="btn btn-success btn-lg" >Wishlisted</button>')
					}

				},
				error:function(error){

				}
			})
		})

        $('#button_container').on('click', '#unwishlist-btn', function(){
			var product_id = '<?php echo $product_id; ?>';
			$.ajax({
				url:'delete_from_wishlist.php',
				method:'POST',
				data:{'product_id':product_id},
				success:function(data){

					if(data === 'Success'){
						$('#unwishlist-btn').hide();
						$('#button-container').append('<button class="btn btn-lg id="wishlist-btn" style="background-color:#FB641B;"><i class="fas fa-shopping-cart"></i>Wishlist</button>')
					}

				},
				error:function(error){

				}
			})
		})

        $('#add_cart').click(function(){
            var product_id = '<?php echo $product_id; ?>';
			$.ajax({
				url:'add_to_cart.php',
				method:'POST',
				data:{'product_id':product_id},
				success:function(data){

					if(data === 'Success'){
						$('#add_cart').hide();
						$('#button-container').prepend('<button class="btn btn-primary btn-lg">Added to Cart</button>')
					}

				},
				error:function(error){

				}
			})
        })
    })
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h5> <a href="index.php">Home</a>  -> <a href="category.php?category=<?php echo $result['category'] ; ?>"><?php echo $result['category'] ; ?></a> </h5>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 mt-5">
                <img src=<?php echo $img; ?> alt="" style="width: 100%; height: auto">
            </div>
            <div class="col-md-6">
                <h2><?php
                echo $result['name'] ;
            ?></h2>
                <p><?php echo $counter; ?> reviews | Avg Ratings - <?php echo $avg_rating?> </p>
                <hr>
                <h3>Rs. <?php
                echo $result['price'] ;
            ?></h3>
            <div class="mt-3 mb-5" id="button-container">
                <?php
                    if($num_rows2 == 0){
                        echo '<button class="btn btn-lg text-white" id="add_cart" style="background-color:#FF9F00; color:white;">Add to Cart</button>';
                    }else{
                        echo '<button class="btn bg-primary btn-lg text-white" id="add_cart">Added to Cart</button>';
                    }
                    if($num_rows == 0){
                        echo '<button class="btn btn-lg" id="wishlist-btn" style="background-color:#FB641B; color:white;">Wishlist</button>';
                    }else{
                        echo '<button class="btn btn-success btn-lg" id="unwishlist-btn">Wishlisted</button>';
                    }
                ?>
                
            </div>
                <p><?php
                echo $result['details'] ;
            ?></p>
            
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-7 mt-3">

            <h4>Ratings & Reviews</h4>
            <?php
                if($counter ==0){
                    echo "No reviews available for this product";
                }
                $query3= "select * from reviews r join users u on r.user_id=u.user_id where r.product_id = $product_id";

                $result3= mysqli_query($conn, $query3);

                while($row3 = mysqli_fetch_assoc($result3)){
                    echo '<h5> '.$row3['review_title'].'</h5>
                            <p>Rating - '.$row3['rating'].'<span style="float: right">Reviewed By - 
                            <b>'.$row3['name'].'</b></span></p>
                            <p>'.$row3['review_text'].'</p>
                            <p> Reviewd On - '.$row3['review_date'].'</p><hr>
                            ';
                }
                
            
            ?>
            
        </div>
        <div class="col-md-5">
            <h3>Rate the Product</h3>
            <form  class="mb-5" action="submit_review.php" method="POST">
                <label for="">Rate the Product(1 to 5)</label> <br>
                <input type="number" name="rating" min="1" max="5" class="form-control"> <br>
                <label for="">Review Title</label> <br>
                <input type="text" name="title" class="form-control"> <br>
                <label for="">Review Text</label>
                <textarea class="form-control" name="body"></textarea> <br>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input class="btn btn-primary" type="submit" value="Submit Review">
            </form>
        </div>
    </div>
</div>