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
	<input type="text" readonly="readonly" class="moje_sezone_polje_header" value="Username korisnika" /> <br />
	<input type="text" class="moje_sezone_polje" id="dodaj_korisnika_polje" onkeyup="trazi_korisnika($id_sezone)"/> <br />
	<div id="rezultati_pretrage_korisnika"></div>
	
_END;
}
else if ($tip=='end')
{
	if (!isset($_POST['id_korisnika'])) die("Greska!");
	$id=$_POST['id_korisnika'];
	
	$upit="INSERT INTO obavijesti(sezona_id,korisnik_id) VALUES ($id_sezone,$id)";
	$rez=mysqli_query($veza, $upit);
	if (!$rez) die("Korisnik je već u sezoni!");
	echo<<<_END
	
	<input type="text" readonly="readonly" class="moje_sezone_polje" value="Korisnik dodan!" /> <br />
	<input type="button" value="Uredu" onclick="javascript: moja_sezona_dodaj('start',-1,$id_sezone)" class="napravi_dugme"/>
	
_END;
}

?>