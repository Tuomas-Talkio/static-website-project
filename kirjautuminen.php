<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    print "ok";
    header("location:welcome.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
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
            <a class="nav-link" href="kirjautuminen.php">Log in</a>
        </nav>  
    </div>

    <script>
        function Kirjaudu(lomake2){
            var kirjautuminen=new Object();
            kirjautuminen.username=lomake2.username.value;
            kirjautuminen.password=lomake2.password.value;
            var jsonKirjautuminen=JSON.stringify(kirjautuminen);
            jsonkentta2.innerHTML=jsonKirjautuminen;
             
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result2").innerHTML = this.responseText;
                    if (this.responseText=="ok"){
                        window.location.assign("welcome.php");
                    }
                }
            };
            xmlhttp.open("POST", "login.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("kirjautuminen=" + jsonKirjautuminen);
    
            document.getElementById("kirjautumislomake").reset();
        } 
    </script>

    <form id='kirjautumislomake'>
        <label for="username"><b>Username</b></label><br>
        <input id="username" type="text" value='' placeholder="Enter username" name="username"><br>
    
        <label for="password"><b>Password</b></label><br>
        <input type="password" value='' placeholder="Enter Password" name="password"><br>
    <input type='button' name='ok' value='Login' onclick='Kirjaudu(this.form);'><br>
    </form>

    <script>
        username.focus();
    </script>

    <p id='result2'>
       
    </p>

    <input type="hidden" id='jsonkentta2'>

</body>
</html>