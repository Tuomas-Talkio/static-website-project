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
    <title>Feedback</title>
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
        function lahetaPalaute(lomake){
            var palaute=new Object();
            palaute.id=lomake.id.value;
            palaute.etunimi=lomake.etunimi.value;
            palaute.sukunimi=lomake.sukunimi.value;
            palaute.palvelu=lomake.palvelu.value;
            palaute.ruoka=lomake.ruoka.value;
            palaute.vapaasana=lomake.vapaasana.value;
            var jsonPalaute=JSON.stringify(palaute);
            jsonkentta.innerHTML=jsonPalaute;
            
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result").innerHTML = this.responseText;
                    luePalaute();
                }
            };
            xmlhttp.open("POST", "lisaapalaute.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("palaute=" + jsonPalaute);	
        }

        function luePalaute(){
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("taulukko").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "./adminpalaute.php", true);
        xmlhttp.send();	
        }

        function poistaPalaute(indeksi){
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("poistettava").innerHTML = this.responseText;
            luePalaute();
            }
          };
        xmlhttp.open("GET", "./poistaPalaute.php?poistettava="+indeksi, true);
        xmlhttp.send();
        }

        function muokkaaPalaute(indeksi){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
                document.getElementById("muokattava").innerHTML = this.responseText;
                palaute=JSON.parse(this.responseText);
                palautelomake.id.value=palaute.id;
                palautelomake.etunimi.value=palaute.etunimi;
                palautelomake.sukunimi.value=palaute.sukunimi;
                palautelomake.palvelu.value=palaute.palvelu;
                palautelomake.ruoka.value=palaute.ruoka;
                palautelomake.vapaasana.value=palaute.vapaasana;
            }
        };
        xmlhttp.open("GET", "./muokkaapalaute.php?muokattava="+indeksi, true);
        xmlhttp.send();
    }
    </script>

    <form id='palautelomake'>
        <input type='hidden' name='id' value=''>
        <label for="etunimi"><b>First name:</b></label><br>
        <input id="etunimi" type='text' name='etunimi' value='' placeholder='Your first name...'><br>
        <label for="sukunimi"><b>Last name:</b></label><br>
        <input type='text' name='sukunimi' value='' placeholder='Your last name...'><br>
        <label for="palvelu"><b>Service:</b></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="palvelu" id="palvelu1" value="Excellent">
            <label class="form-check-label" for="palvelu1">
              Excellent
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="palvelu" id="palvelu2" value="Good">
            <label class="form-check-label" for="palvelu2">
              Good
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="palvelu" id="palvelu3" value="Average">
            <label class="form-check-label" for="palvelu3">
              Average
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="palvelu" id="palvelu4" value="Horrible">
            <label class="form-check-label" for="palvelu4">
              Horrible
            </label>
          </div>
          <label for="ruoka"><b>Food:</b></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="ruoka" id="ruoka1" value="Delicious">
            <label class="form-check-label" for="ruoka1">
              Delicious
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="ruoka" id="ruoka2" value="Good">
            <label class="form-check-label" for="ruoka2">
              Good
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="ruoka" id="ruoka3" value="Average">
            <label class="form-check-label" for="ruoka3">
              Average
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="ruoka" id="ruoka4" value="Horrible">
            <label class="form-check-label" for="ruoka4">
              Horrible
            </label>
          </div>

          <label for="vapaasana"><b>Additional feedback:</b></label>
          <br>
          <textarea name='vapaasana' rows="6" cols="50" placeholder='Tell us additional details about your experience...'></textarea>
          <br>
        <input type='button' name='ok' value='Send' onclick='lahetaPalaute(this.form);'><br>
    </form>

    <script>
      etunimi.focus();
      luePalaute();
    </script>

    <div id="taulukko">

    </div>

    <p id='result'>

    </p>

    <p id='poistettava'>

    </p>

    <input type='hidden' id='muokattava'>

    <input type="hidden" id='jsonkentta'>

</body>
</html>