<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_obavijesti'])) die("Greska!");

$id_obavijesti=$_POST['id_obavijesti'];

$upit="DELETE FROM obavijesti WHERE id=$id_obavijesti";
$rez=mysql_query($upit);

if ($rez==false) die("Greska");
echo "success";

?>