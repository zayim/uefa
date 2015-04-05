<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_korisnika'])) die("Greska!");
if (!isset($_POST['id_sezone'])) die("Greska!");
if (!isset($_POST['broj_igraca'])) die("Greska!");

$broj_igraca=$_POST['broj_igraca'];
$id_korisnika=$_POST['id_korisnika'];
$id_sezone=$_POST['id_sezone'];
$id=$_SESSION['id'];

for ($i=0; $i<$broj_igraca; $i++)
	if (!isset($_POST['igrac_'.$i])) die("Greska: $i");
	
$igraci=new ArrayObject();
for ($i=0; $i<$broj_igraca; $i++)
	$igraci[$i]=$_POST['igrac_'.$i];
	
$upit="INSERT INTO spiskovi(vlasnik_id,sezona_id) VALUES($id_korisnika,$id_sezone)";
$rez=mysqli_query($veza, $upit);
if ($rez==false) die ("<br/><center>Korisnik je već u sezoni!</center><br/>");

$id_spiska=mysqli_insert_id($veza);

$upit="CREATE TABLE IF NOT EXISTS spisak_$id_spiska(
						id INT NOT NULL UNIQUE AUTO_INCREMENT,
						ime_fudbalera VARCHAR(100) NOT NULL,
						PRIMARY KEY(id)
						) ENGINE=InnoDB";
$rez=mysqli_query($veza, $upit);
if ($rez==false) die ("Greska2!");

for ($i=0; $i<$broj_igraca; $i++)
{
	$upit="INSERT INTO spisak_$id_spiska(ime_fudbalera) VALUES('$igraci[$i]')";
	$rez=mysqli_query($veza, $upit);
	if ($rez==false) die("UPIT: $upit <br> Greška: $i");
}

$upit="INSERT INTO korisnici_$id_sezone(korisnik_id) VALUES($id_korisnika)";
$rez=mysqli_query($veza, $upit);
if ($rez==false) die("Greska!");

echo <<<_END
<br />
<center><input type="text" readonly="readonly" class="moje_sezone_polje" value="Uspješno ste dodani u sezonu!" /></center> <br />
<center><input type="button" value="Uredu" onclick="window.location.href='profil.php'" class="napravi_dugme"/> </center>
_END;
?>