<?php

session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['tip'])) die("Greska!");
if (!isset($_POST['id_sezone'])) die("Greska!");

$id_sezone=$_POST['id_sezone'];
$tip=$_POST['tip'];

if ($tip=='start')
{
	echo<<<_END
	<input type="button" value="Prikazi sve" class="moje_sezone_dugme" onclick="trazi_korisnika_brisi($id_sezone,2)"/> <br />
	<input type="text" readonly="readonly" class="moje_sezone_polje_header" value="Username korisnika" /> <br />
	<input type="text" class="moje_sezone_polje" id="dodaj_korisnika_polje" onkeyup="trazi_korisnika_brisi($id_sezone,1)"/> <br />
	<div id="rezultati_pretrage_korisnika"></div>
	
_END;
}
else if ($tip=='end')
{
	if (!isset($_POST['id_korisnika'])) die("Greska!");
	$id=$_POST['id_korisnika'];
	
	$upit="DELETE FROM korisnici_$id_sezone WHERE korisnik_id=$id";
	$rez=mysqli_query($veza, $upit);
	if (!$rez) die("Greska");
	
	$upit="SELECT * FROM utakmice WHERE (korisnik_domacin_id=$id OR korisnik_gost_id=$id) AND sezona_id=$id_sezone";
	$rez=mysqli_query($veza, $upit);
	if (!$rez) die("Greska");
	
	$broj_redova=mysqli_num_rows($rez);
	for ($i=0; $i<$broj_redova; $i++)
	{
		$red=mysqli_fetch_assoc($rez);
		$id_utakmice=$red['id'];
		
		$rez2=mysqli_query($veza, "DELETE FROM utakmice_$id_sezone WHERE id=$id_utakmice");
		if (!$rez2) die("Greska!");
	}
	
	$upit="DELETE FROM utakmice WHERE (korisnik_domacin_id=$id OR korisnik_gost_id=$id) AND sezona_id=$id_sezone";
	$rez=mysqli_query($veza, $upit);
	if (!$rez) die("Greska");
	
	
	$upit="SELECT * FROM spiskovi WHERE korisnik_id=$id AND sezona_id=$id_sezone";
	$rez=mysqli_query($veza, $upit);
	if ($rez && mysqli_num_rows($rez)>1) die("Greska5");
	elseif ($rez && mysqli_num_rows($rez)==1)
	{
		$red=mysqli_fetch_assoc($rez);
		$id_spiska=$red['id'];
	
		mysqli_query($veza, "DROP TABLE spisak_$id_spiska");
		if (!$rez) die("Greska2");
	}
	
	$rez=mysqli_query($veza, "DELETE FROM spiskovi WHERE korisnik_id=$id AND sezona_id=$id_sezone");
	
	echo<<<_END
	
	<input type="text" readonly="readonly" class="moje_sezone_polje" value="Korisnik izbrisan!" /> <br />
	<input type="button" value="Uredu" onclick="moja_sezona_obrisi('start',-1,$id_sezone)" class="moje_sezone_dugme"/>
	
_END;
}


?>