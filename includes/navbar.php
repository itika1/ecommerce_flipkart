<?php
session_start(); //session should be started at first otherwise it won't work
if(empty($_SESSION)){//login doesn't happen
    $logged_in=0;
}else{
    $logged_in=1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.3/css/all.min.css" integrity="sha512-f2MWjotY+JCWDlE0+QAshlykvZUtIm35A6RHwfYZPdxKgLJpL8B+VVxjpHJwZDsZaWdyHVhlIHoblFYGkmrbhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Flipkart</title>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $('#register-popup').click(function(){
            $('#exampleModal1').modal('hide');
            $('#exampleModal2').modal('show');
        })
    })
</script>
<body>
    <div class="bg-amazon" style="height: 60px; padding-top:10px">
        
        
            
            <div class="row">
                <div class="col-md-3" ><h2 class="text-white"> <a href="index.php" style="text-decoration:none; 
                color:white;" class="ml-3">Flipkart</a> </h2></div>
                <div class="col-md-7">
                    <form action="search.php" method="GET">
                        <input placeholder="Search Products" type="text" class="form-control" name="term" style="width: 80%; display:inline">
                        <input type="submit" class="btn" style="margin-top: -5px; background-color: white;" value="Search">
                    </form>
                   
                </div>
                <div class="col-md-2">
                    <div class="text-md-center">
                    <?php 
                if($logged_in ==1){
                    echo '<div class="dropdown"><i class="text-white fa-2x fas fa-user 
                    mr-5 id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
                    echo '<a href="cart.php"> <i class="text-white fa-2x fas fa-cart-plus"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Hi '.$_SESSION['name'].'</a>
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="orders.php">My Orders</a>
                    <a class="dropdown-item" href="wishlist.php">My Wishlist</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                    </div>';
                }else{
                    echo '<button class="btn btn-default" data-toggle="modal" 
                    data-target="#exampleModal1" style="background-color: white;">Login</button>';
                }?>
                    </div>
                
                </div>

            </div>
        
    </div>
    </body>
</html>