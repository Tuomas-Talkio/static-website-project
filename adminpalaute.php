<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){
    print "Connection error";
    exit;
}
$tulos=mysqli_query($yhteys, "select * from team1_asiakaspalaute");
print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr>";
    print "<td>$rivi->id<td>$rivi->etunimi<td>$rivi->sukunimi<td>$rivi->palvelu".
    "<td>$rivi->ruoka<td>$rivi->vapaasana<td>$rivi->aika";
    print "<td><button onclick='muokkaaPalaute($rivi->id);'>Edit</button>";
    print "<td><button onclick='poistaPalaute($rivi->id);'>Delete</button>";
}
print "</table>";
?>