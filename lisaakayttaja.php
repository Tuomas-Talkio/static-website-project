<?php

$json=isset($_POST["palaute"]) ? $_POST["palaute"] : "";

if (!($palaute=tarkistaJson($json))){
    print "Fill all option, exept Additional feedback";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
if (isset($palaute->id) && $palaute->id>0){
    $sql="update team1_kayttajat set username=?, password=?, where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $palaute->username, $palaute->password, $palaute->id);
}
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
print "Paluupostina ".$json;
?>
<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $palaute=json_decode($json, false);
    if (empty($palaute->username) || empty($palaute->password)){
        return false;
    }
    
    return $palaute;
}
?>