<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['ime'])) die("Greska!");
if (!isset($_POST['id_sezone'])) die("Greska!");

$dio_usernamea=$_POST['ime'];
$id_sezone=$_POST['id_sezone'];

$upit="SELECT id,username,ime,prezime FROM korisnici WHERE username LIKE '%$dio_usernamea%'";
$rez=mysqli_query($veza, $upit);

$broj_redova=mysqli_num_rows($rez);

echo "<ul class='list_moje_sezone_ul'>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id=$red['id']; $un=$red['username']; $ime=$red['ime']; $prezime=$red['prezime'];
	
	$upit="SELECT * FROM korisnici_$id_sezone WHERE korisnik_id=$id";
	$rez2=mysqli_query($veza, $upit);
	if ($rez2 && mysqli_num_rows($rez2)==1){
	
	echo<<<_END
	<li><a href="javascript:moja_sezona_obrisi('end',$id,$id_sezone)">  $un | $ime $prezime  </a></li><br />
_END;
}
}

?>