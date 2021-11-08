<?php
session_start();
session_destroy();//destroying all the key values
header('Location:index.php'); //redirecting to the index page
?>