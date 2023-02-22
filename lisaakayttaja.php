<?php

$json=isset($_POST["kayttaja"]) ? $_POST["kayttaja"] : "";
if (!($kayttaja=tarkistaJson($json))){
    exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){
    print "Connection error";
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja

$sql="insert into team1_kayttajat (username, password, secretword) values(?, ?, ?)";
//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sss', $kayttaja->username, $kayttaja->password, $kayttaja->secretword);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
print "New admin account succesfully added"
?>

<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $kayttaja=json_decode($json, false);
    if (empty($kayttaja->username) || empty($kayttaja->password) || empty($kayttaja->secretword)){
        print "Fill in all fields";
        return false;
    }

    if (strcmp(($kayttaja->password),($kayttaja->secretword))!=0){
        print "Passwords are not the same";
        return false;
    }
    
    return $kayttaja;
}
?>