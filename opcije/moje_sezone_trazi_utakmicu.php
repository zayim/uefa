<?php

session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) die("Greska!");
if (!isset($_POST['username1'])) die("Greska!");
if (!isset($_POST['username2'])) die("Greska!");
if (!isset($_POST['tip'])) die("Greska!");

$id_sezone=$_POST['id_sezone'];
$username1=$_POST['username1'];
$username2=$_POST['username2'];
$tip=$_POST['tip'];

$upit="SELECT * FROM utakmice WHERE sezona_id=$id_sezone";
$rez=mysqli_query($veza, $upit);
$broj_redova=mysqli_num_rows($rez);

echo "<ul class='list_moje_sezone_ul'>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id1=$red['korisnik_domacin_id'];
	$id2=$red['korisnik_gost_id'];
	$id_utakmice=$red['id'];

	$upit2="SELECT * FROM korisnici WHERE id=$id1";
	$rez2=mysqli_query($veza, $upit2);
	$upit3="SELECT * FROM korisnici WHERE id=$id2";
	$rez3=mysqli_query($veza, $upit3);
	
	$red2=mysqli_fetch_assoc($rez2); $red3=mysqli_fetch_assoc($rez3);
	$un1=$red2['username']; $un2=$red3['username'];
	$golovi1=$red['rezultat_domacin']; $golovi2=$red['rezultat_gost'];
	
	$ima=false;
	if ($username1=="" && $username2=="") $ima=true;
	if (($username1=="" && $username2==$un1) || ($username1=="" && $username2==$un2)) $ima=true;
	if (($username2=="" && $username1==$un1) || ($username2=="" && $username1==$un2)) $ima=true;
	if (($username1==$un1 && $username2==$un2) || ($username1==$un2 && $username2==$un1)) $ima=true;
	
	if ($ima)
	{
		echo<<<_END
	<li><a href="javascript:moja_sezona_obrisi_utakmicu($id_utakmice,$id_sezone,$tip)">  $un1 $golovi1-$golovi2 $un2  </a></li><br />
_END;
	}
}
echo "</ul>";

?>