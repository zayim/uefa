<?php
session_start();

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }

$ime=$_SESSION['ime'];
$prezime=$_SESSION['prezime'];
$username=$_SESSION['username'];
$slika=$_SESSION['slika'];

echo "<img src='$slika' /><br>Pozdrav, $ime $prezime. Logovani ste kao: $username<br>";

?>