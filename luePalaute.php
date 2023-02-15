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
$tulos=mysqli_query($yhteys, "select * from team1_asiakaspalaute");
print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr>";
    print "<td>$rivi->id<td>$rivi->etunimi<td>$rivi->sukunimi<td>$rivi->palvelu".
    "<td>$rivi->ruoka<td>$rivi->vapaasana<td>$rivi->aika".
    "<td><button onclick='muokkaaPalaute($rivi->id);'>Edit</button>".
    "<td><button onclick='poistaPalaute($rivi->id);'>Delete</button>";
}
print "</table>";
?>