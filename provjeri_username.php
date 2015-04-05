<?php
require_once("konekcija.php");

if (!isset($_POST['username'])) die();
$username=popraviString($veza, $_POST['username']);
$upit="SELECT * FROM korisnici WHERE username='$username'";
$rez=mysqli_query($veza, $upit);

//echo ($upit);

echo !mysqli_num_rows($rez) ? "dostupno" : "nedostupno";
?>