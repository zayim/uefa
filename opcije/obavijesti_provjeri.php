<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }

$id=$_SESSION['id'];

$upit="SELECT * FROM obavijesti WHERE korisnik_id=$id";
$rez=mysqli_query($veza, $upit);

if ($rez!=false) $broj_redova=mysqli_num_rows($rez); else $broj_redova=0;

echo $broj_redova;

?>