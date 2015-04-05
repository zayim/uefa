<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) { die(); }
$id=$_SESSION['id'];
$id_sezone=$_POST['id_sezone'];

echo "<input type='hidden' id='sezId' value=$id_sezone>";

echo "<table cellspacing='0'>";
echo "<tr>";

echo "<td>";
//////// IZBOR DOMAĆINA

$upit="SELECT DISTINCT korisnici.id, korisnici.username FROM korisnici JOIN korisnici_$id_sezone ON korisnici.id=korisnici_$id_sezone.korisnik_id ORDER BY korisnici.username";
$rez=mysqli_query($veza, $upit);
if (!$rez) die ("Nema nikog u sezoni!");
$broj_redova=mysqli_num_rows($rez);

echo<<<_END
<ul id="domacin_meni">
<input type="text" readonly="readonly" id="domacin_username" value="Domaćin" />
_END;

for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id_korisnika=$red['id'];
	$username_korisnika=$red['username'];
	
	echo<<<_END
	<li onclick="document.getElementById('domacin_username').value=this.innerHTML; generisi_golove($id_korisnika,'domacin');" value=$id_korisnika>
$username_korisnika
	</li>
_END;
}

echo "</ul>";

//////// ---kraj izbora domaćina---
echo "</td>";

echo "<td>";
//////// REZULTAT DOMAĆINA
echo<<<_END
<input type="text" id="domacin_rezultat" maxlength="2"/>
_END;
//////// ---kraj rezultata domaćina---
echo "</td>";

echo "<td align=right'>";
//////// REZULTAT GOSTA
echo<<<_END
<input type="text" id="gost_rezultat" maxlength="2"/>
_END;
//////// ---kraj rezultata gosta---
echo "</td>";

echo "<td align='right'>";
//////// IZBOR GOSTA

$upit="SELECT DISTINCT korisnici.id, korisnici.username FROM korisnici JOIN korisnici_$id_sezone ON korisnici.id=korisnici_$id_sezone.korisnik_id ORDER BY korisnici.username";
$rez=mysqli_query($veza, $upit);
if (!$rez) die ("Nema nikog u sezoni!");
$broj_redova=mysqli_num_rows($rez);

echo<<<_END
<ul id="gost_meni">
<input type="text" readonly="readonly" id="gost_username" value="Gost" />
_END;

for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id_korisnika=$red['id'];
	$username_korisnika=$red['username'];
	
	echo<<<_END
	<li onclick="document.getElementById('gost_username').value=this.innerHTML; generisi_golove($id_korisnika,'gost');" value=$id_korisnika>
$username_korisnika
	</li>
_END;
}

echo "</ul>";

//////// ---kraj izbora gosta---
echo "</td>";

echo "</tr>";
echo "</table><br />";

echo "<input type='hidden' id='idDomacina' value=0>";
echo "<input type='hidden' id='idGosta' value=0>";

echo "<input type='button' value='Unesi' onclick='aktivne_sezone_registruj_rezultat()' class='aktivne_sezone_dugme'/>";
?>