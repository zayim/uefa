<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['ime'])) die("Greska!");
if (!isset($_POST['id_sezone'])) die("Greska!");

$dio_usernamea=$_POST['ime'];
$id_sezone=$_POST['id_sezone'];

$upit="SELECT id,username,ime,prezime FROM korisnici WHERE username LIKE '%$dio_usernamea%'";
$rez=mysql_query($upit);

$broj_redova=mysql_num_rows($rez);

echo "<ul class='list_moje_sezone_ul'>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysql_fetch_assoc($rez);
	$id=$red['id']; $un=$red['username']; $ime=$red['ime']; $prezime=$red['prezime'];
	echo<<<_END
	<li><a href="javascript:moja_sezona_dodaj('end',$id,$id_sezone)">  $un | $ime $prezime  </a></li><br />
_END;
}

?>