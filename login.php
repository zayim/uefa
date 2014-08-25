<?php

session_start();

require_once("konekcija.php");

if (isset($_SESSION['username'])) { header("Location: profil.php"); die(); }

if (!isset($_POST['username'])|| !isset($_POST['password'])){header("Location: index.php"); die();}

$username = popraviString($_POST['username']);
$password = md5(popraviString($_POST['password']));

if ($username=="" || $password=="") { header("Location: index.php"); die(); } //?!?!?!

$upit="SELECT * FROM korisnici WHERE username='$username'";
$rez=mysql_query($upit);

$red=mysql_fetch_array($rez,MYSQL_ASSOC);
if (mysql_num_rows($rez)==0 || $red['password']!=$password) { echo "fail"; die(); }

//session_start();
$_SESSION['id']=$red['id'];
$_SESSION['ime']=$red['ime'];
$_SESSION['prezime']=$red['prezime'];
$_SESSION['username']=$red['username'];
$_SESSION['password']=$red['password'];
$_SESSION['slika']=$red['slika'];
echo "success";

?>