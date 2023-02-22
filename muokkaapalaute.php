<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$id = isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";
try{
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
    //$yhteys=mysqli_connect("db", "root", "password", "webohjelmointi");
}
catch(Exception $e){
    print "Connection error";
    exit;
}

$tulos=mysqli_query($yhteys, "select * from team1_asiakaspalaute where id=$id");
if ($rivi=mysqli_fetch_object($tulos)){
    $palaute=new class{};
    $palaute->id=$rivi->id;
    $palaute->etunimi=$rivi->etunimi;
    $palaute->sukunimi=$rivi->sukunimi;
    $palaute->palvelu=$rivi->palvelu;
    $palaute->ruoka=$rivi->ruoka;
    $palaute->vapaasana=$rivi->vapaasana;
    
}
mysqli_close($yhteys);
print json_encode($palaute);
?>