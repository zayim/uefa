<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) { die("Greska!"); }
$id=$_SESSION['id'];
$id_sezone=$_POST['id_sezone'];

$upit = "SELECT rezultat_domacin, rezultat_gost, k1.ime, k1.prezime, k2.ime, k2.prezime FROM utakmice JOIN korisnici k1 ON korisnik_domacin_id=k1.id JOIN korisnici k2 ON korisnik_gost_id=k2.id WHERE sezona_id=$id_sezone";

$rez = mysqli_query($veza, $upit) or die("Greska!");
$broj_utakmica = mysqli_num_rows($rez);

echo "<br><br><table id='tabela_sve_utakmice'>";
for ($i=0; $i<$broj_utakmica; $i++)
{
	$red = mysqli_fetch_array($rez);
	
	echo "<tr><td align='right'>".$red[2]." ".$red[3]."</td><td align='center'>".$red[0]." - ".$red[1]."</td><td align='left'>".$red[4]." ".$red[5]."</td></tr>";
}

echo "</table>";

?>