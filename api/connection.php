<?php
// -- Made By ICT-LAB
$host = "localhost";
$gebruiker_mysql = "rubendem";
$wachtwoord2 = "540611331ROdm";
$DBNaam = "rubendem-4";
$Verbinding = mysql_connect("$host", "$gebruiker_mysql", "$wachtwoord2") or die("De verbinding met de database kan niet worden gemaakt<p>".mysql_error());
mysql_select_db($DBNaam) OR die("De database kan niet geselecteerd worden");
?>
