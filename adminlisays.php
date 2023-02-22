<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: kirjautuminen.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin creation</title>
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
    <script>
       function lahetaKayttaja(lomake){
            var kayttaja=new Object(); 
            kayttaja.id=lomake.id.value;
            kayttaja.username=lomake.username.value;
            kayttaja.password=lomake.password.value;
            kayttaja.secretword=lomake.secretword.value;
            var jsonKayttaja=JSON.stringify(kayttaja);
            //jsonkentta.innerHTML=jsonKayttaja;
            
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "lisaakayttaja.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("kayttaja=" + jsonKayttaja);

            document.getElementById("adminlisayslomake").reset();
        } 
    </script>

    <form id='adminlisayslomake'>
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an admin account.</p>
    
        <label for="username"><b>Username</b></label><br>
        <input id="username" type="text" value='' placeholder="Enter username" name="username"><br>
    
        <label for="password"><b>Password</b></label><br>
        <input type="password" value='' placeholder="Enter Password" name="password"><br>
    
        <label for="check"><b>Repeat Password</b></label><br>
        <input type="password" value='' placeholder="Repeat Password" name="secretword"><br>
    <input type='button' name='ok' value='Sign up' onclick='lahetaKayttaja(this.form);'><br>
    
    </form>
    <script>
        username.focus();
    </script>

<p id='result'>
    
</p>

<!-- <p id='jsonkentta'>
    
</p> -->

</body>
</html>