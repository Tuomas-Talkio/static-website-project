<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin functions</title>
    <link href="text-align.CSS" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="row" style="margin-bottom: 5px;">
        <nav class="navbar navbar-expand-sm  navbar-dark">
            <a class="nav-link" href="index.html">Main Page</a>
            <a class="nav-link" href="main-courses.html">Main courses</a>
            <a class="nav-link" href="drinks.html">Drinks</a>
            <a class="nav-link" href="desserts.html">Desserts</a>
            <a class="nav-link" href="palautelomake.html">Feedback</a>
            <a class="nav-link" href="adminlisays.html">Log in</a>
        </nav>  
    </div>

    <p>Welcome to our page</p>
    <a href="logout.php">logout</a>
</body>
</html>