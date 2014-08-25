<?php

require_once("konekcija.php");

$ime=""; $prezime=""; $username=""; $password="";

if (isset($_POST['ime']))
{
	if ($_POST['ime']=="") { header("Location: registracija.html"); die(); }
	$ime=popraviString($_POST['ime']);
}
if (isset($_POST['prezime']))
{
	if ($_POST['prezime']=="") { header("Location: registracija.html"); die(); }
	$prezime=popraviString($_POST['prezime']);
}
if (isset($_POST['username']))
{
	if ($_POST['username']=="") { header("Location: registracija.html"); die(); }
	$username=popraviString($_POST['username']);
}
if (isset($_POST['password']))
{
	if ($_POST['password']=="") { header("Location: registracija.html"); die(); }
	$password=md5(popraviString($_POST['password']));
}

$slika="slikeProfila/default.png";
if ($_FILES && isset($_FILES['slika']['name']))
	switch($_FILES['slika']['type'])
	{
		case "image/png": case "image/jpeg": case "image/gif": case "image/tiff": case "image/bmp":
		$slika="slikeProfila/$username.png";
		move_uploaded_file($_FILES['slika']['tmp_name'], $slika);
		break;
	}

$upit="INSERT INTO korisnici(ime,prezime,username,password,slika) VALUES('$ime','$prezime','$username','$password','$slika')";
//echo $upit;
$rez=mysql_query($upit);

if (!$rez) { header("Location: greske.php?tip=2"); die(); }
header("Location: login.php"); die();

?>
