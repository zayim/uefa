<?php
require_once("konekcija.php");

if (!isset($_POST['username'])) die();
$username=popraviString($_POST['username']);
$upit="SELECT * FROM korisnici WHERE username='$username'";
$rez=mysql_query($upit);

//echo ($upit);

echo !mysql_num_rows($rez) ? "dostupno" : "nedostupno";
?>