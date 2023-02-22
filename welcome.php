<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:kirjautuminen.php");
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
            <a class="nav-link" href="palautehallinta.php">Feedback management</a>
            <a class="nav-link" href="adminlisays.php">Add new admins</a>
            <a class="nav-link" href="logout.php">Log out</a>
        </nav>  
    </div>

    <p>Welcome to our page</p>
</body>
</html>