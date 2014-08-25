<?php

session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) die("Greska!");
if (!isset($_POST['id_utakmice'])) die("Greska!");

$id_sezone=$_POST['id_sezone'];
$id_utakmice=$_POST['id_utakmice'];

$upit="DELETE FROM utakmice_$id_sezone WHERE utakmica_id=$id_utakmice";
mysql_query($upit);

$upit="DROP TABLE strijelci_$id_utakmice";
mysql_query($upit);
$upit="DROP TABLE zuti_$id_utakmice";
mysql_query($upit);
$upit="DROP TABLE crveni_$id_utakmice";
mysql_query($upit);
$upit="DROP TABLE asistenti_$id_utakmice";
mysql_query($upit);

$upit="DELETE FROM utakmice WHERE id=$id_utakmice";
mysql_query($upit);

?>