<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}
$tulos=mysqli_query($yhteys, "select * from team1_asiakaspalaute");
print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr>";
    // Lisää automaattinen päivämäärä
    print "<td>$rivi->id<td>$rivi->etunimi<td>$rivi->sukunimi<td>$rivi->palvelu<td>$rivi->ruoka<td>$rivi->vapaasana<td>$rivi->aika";
}
print "</table>";
?>