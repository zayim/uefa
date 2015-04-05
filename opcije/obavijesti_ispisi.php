<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }

$id=$_SESSION['id'];

$upit="SELECT * FROM obavijesti WHERE korisnik_id=$id";
$rez=mysqli_query($veza, $upit);

if ($rez!=false) $broj_redova=mysqli_num_rows($rez); else $broj_redova=0;

echo "<ul class='obavijest_ul'>";

for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id_sezone=$red['sezona_id'];
	$id_obavijesti=$red['id'];
	
	$upit2="SELECT * FROM sezone WHERE id=$id_sezone";
	$rez2=mysqli_query($veza, $upit2);
	if ($rez2==false || mysqli_num_rows($rez2)!=1) die("Greska!");
	
	$red2=mysqli_fetch_assoc($rez2);
	$id_vlasnika=$red2['vlasnik_id'];
	$ime_sezone=$red2['ime'];
	$broj_igraca=$red2['broj_igraca'];
	$broj_kola=$red2['broj_kola'];
	$status=$red2['status'];
	
	$upit3="SELECT * FROM korisnici WHERE id=$id_vlasnika";
	$rez3=mysqli_query($veza, $upit3);
	if ($rez3==false || mysqli_num_rows($rez3)!=1) echo("Greska!");
	
	$red3=mysqli_fetch_assoc($rez3);
	$ime_vlasnika=$red3['ime'];
	$prezime_vlasnika=$red3['prezime'];
	$username_vlasnika=$red3['username'];
	
	if ($status!=1) mysqli_query($veza, "DELETE FROM obavijesti WHERE id=$id_obavijesti");
	else
	{
	echo<<<_END
	
	<li class="obavijest_li"> Korisnik $username_vlasnika ($ime_vlasnika $prezime_vlasnika) Vas je dodao u sezonu $ime_sezone. 
	<input type="button" value="Prihvati" onclick="obavijest_prihvati($id_obavijesti)" class="obavijest_dugme"/>
	<input type="button" value="Odbij" onclick="obavijest_odbij($id_obavijesti,1)" class="obavijest_dugme" /> 
	</li>
	<br/>
	
_END;
	}

}
echo "</ul>";

?>