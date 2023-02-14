<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
//$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
$yhteys=mysqli_connect("db", "root", "password", "webohjelmointi");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}
//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$tulos=mysqli_query($yhteys, "select * from team1_asiakaspalaute");
?>