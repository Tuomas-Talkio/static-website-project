<?php

$json=isset($_POST["palaute"]) ? $_POST["palaute"] : "";

if (!($palaute=tarkistaJson($json))){
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
if (isset($palaute->id) && $palaute->id>0){
    $sql="update team1_asiakaspalaute set etunimi=?, sukunimi=?, palvelu=?, ruoka=?, vapaasana=? where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssi', $palaute->etunimi, $palaute->sukunimi, $palaute->palvelu, $palaute->ruoka, $palaute->vapaasana, $palaute->id);
}else{
    $sql="insert into team1_asiakaspalaute (etunimi, sukunimi, palvelu, ruoka, vapaasana) values(?, ?, ?, ?, ?)";
    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'sssss', $palaute->etunimi, $palaute->sukunimi, $palaute->palvelu, $palaute->ruoka, $palaute->vapaasana);
    //Suoritetaan sql-lause
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
    if (empty($palaute->etunimi) || ($palaute->sukunimi) || ($palaute->palvelu) || ($palaute->ruoka) || ($palaute->vapaasana)){
        return false;
    }
    return $palaute;
}
?>