<?php

session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_GET['id_sezone'])) die("Greska!");
if (!isset($_GET['id_korisnika'])) die("Greska!");

$id_korisnika=$_GET['id_korisnika'];
$id_sezone=$_GET['id_sezone'];
$rez=mysqli_query($veza, "SELECT vlasnik_id FROM sezone WHERE id=$id_sezone");
$red=mysqli_fetch_assoc($rez);
if ($red['vlasnik_id']!=$id_korisnika) die("Greska");

mysqli_query($veza, "UPDATE sezone SET status=2 WHERE id=$id_sezone");
header("Location: ../profil.php"); die();

?>