<?php
$poistettava = isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

if (empty($poistettava)){
    header("Location:palautelomake.html");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    //$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
$yhteys=mysqli_connect("db", "root", "password", "webohjelmointi");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

$sql="delete from team1_asiakaspalaute where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);

//Suljetaan tietokantayhteys
mysqli_close($yhteys);
print "Palaute poistettu"
?>