
<?php
    include "includes/navbar.php";
    include "includes/dbconn.php";

?>
    <div class="jumbotron">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://rukminim1.flixcart.com/flap/2016/508/image/f6a0d4f77aba6557.jpg?q=50" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://rukminim1.flixcart.com/flap/1800/1800/image/6ef02d0d5720c4ce.jpg?q=80" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://rukminim1.flixcart.com/flap/844/140/image/d14f2001387c4aca.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4">Top Clothing Products</h3>
            </div>

            <?php
                $conn = mysqli_connect("localhost", "root", "", "amazon"); //database name amazon, server is blank
                $query = "SELECT * FROM products WHERE category LIKE 'Clothing' LIMIT 4";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    $img = substr(explode(',', $row['bg_img'])[0], 1);
                    echo '<div class="col-md-3">
                    <div class="card">
                        <img src='.$img.' class="card-img-top" alt="">
                        <div class="card-body">
                            <h4>'.$row['name'].'</h4>
                            <p>'.$row['price'].'</p>
                            <a href="description.php?product_id='.$row['product_id'].'" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                </div>';
                }
            ?>

            
            
        </div>
        <div class="row">
        <div class="col-md-12">
                <h3 class="mb-4">Top Footwear</h3>
            </div>

            <?php
                $conn = mysqli_connect("localhost", "root", "", "amazon"); //database name amazon, server is blank
                $query = "SELECT * FROM products WHERE category LIKE 'Footwear' LIMIT 4";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    $img = substr(explode(',', $row['bg_img'])[0], 1);
                    echo '<div class="col-md-3">
                    <div class="card">
                        <img src='.$img.' class="card-img-top" alt="">
                        <div class="card-body">
                            <h4>'.$row['name'].'</h4>
                            <p>'.$row['price'].'</p>
                            <a href="description.php?product_id='.$row['product_id'].'" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
        <div class="row">
        <div class="col-md-12">
                <h3 class="mb-4">Top Furniture</h3>
            </div>

            <?php
                $query = "SELECT * FROM products WHERE category LIKE 'Furniture' LIMIT 4";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    $img = substr(explode(',', $row['bg_img'])[0], 1);
                    echo '<div class="col-md-3">
                    <div class="card">
                        <img src='.$img.' class="card-img-top" alt="">
                        <div class="card-body">
                            <h4>'.$row['name'].'</h4>
                            <p>'.$row['price'].'</p>
                            <a href="description.php?product_id='.$row['product_id'].'" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                </div>';
                }
            ?>

            
            
        </div>
        <div class="row">
        <div class="col-md-12">
                <h3 class="mb-4">Sports</h3>
            </div>

            <?php
                $conn = mysqli_connect("localhost", "root", "", "amazon"); //database name amazon, server is blank
                $query = "SELECT * FROM products WHERE category LIKE 'Sports' LIMIT 4";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    $img = substr(explode(',', $row['bg_img'])[0], 1);
                    echo '<div class="col-md-3">
                    <div class="card">
                        <img src='.$img.' class="card-img-top" alt="">
                        <div class="card-body">
                            <h4>'.$row['name'].'</h4>
                            <p>'.$row['price'].'</p>
                            <a href="description.php?product_id='.$row['product_id'].'" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
        <div class="row">
        <div class="col-md-12">
                <h3 class="mb-4">Pet</h3>
            </div>

            <?php
                $conn = mysqli_connect("localhost", "root", "", "amazon"); //database name amazon, server is blank
                $query = "SELECT * FROM products WHERE category LIKE 'Pet' LIMIT 4";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    $img = substr(explode(',', $row['bg_img'])[0], 1);
                    echo '<div class="col-md-3">
                    <div class="card">
                        <img src='.$img.' class="card-img-top" alt="">
                        <div class="card-body">
                            <h4>'.$row['name'].'</h4>
                            <p>'.$row['price'].'</p>
                            <a href="description.php?product_id='.$row['product_id'].'" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="login_validation.php" method="POST">
                        <label for="">Email</label><br>
                        <input class="form-control" type="email" name="user_email"><br>
                        <label for="">Password</label>
                        <input  class="form-control" type="password" name="user_password"><br><br>
                        <input type="submit" name="" value="Login" class="btn btn-primary">
                    </form>
                    <div>
                        <p class="mt-3">Not a member? <a id="register-popup" href="#">Sign up</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="reg_validation.php" method="POST">
                        <label for="">Name</label><br>
                        <input class="form-control" type="text" name="user_name"><br>
                        <label for="">Email</label><br>
                        <input class="form-control" type="email" name="user_email"><br>
                        <label for="">Password</label>
                        <input  class="form-control" type="password" name="user_password"><br><br>
                        <input type="submit" name="" value="Register" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
