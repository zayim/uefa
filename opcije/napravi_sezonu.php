<?php
require_once("../konekcija.php");
session_start();

if (!isset($_SESSION['username']) || !isset($_POST['tip'])) { header("Location: ../index.php"); die(); }
$username=$_SESSION['username'];
$ime=$_SESSION['ime'];
$prezime=$_SESSION['prezime'];
$slika=$_SESSION['slika'];
$id=$_SESSION['id'];

$tip=$_POST['tip'];

if ($tip=='end')
{
	$podaciOK=true;
	if (isset($_POST['imeSezone'])) { $imeSezone=popraviString($veza, $_POST['imeSezone']); } else { $podaciOK=false; }
	if (isset($_POST['brojIgraca'])) { $brojIgraca=popraviString($veza, $_POST['brojIgraca']); } else { $podaciOK=false; }
	if (isset($_POST['brojKola'])) { $brojKola=popraviString($veza, $_POST['brojKola']); } else { $podaciOK=false; }
	if ($podaciOK)
	{
		$_upit="INSERT INTO sezone(ime,vlasnik_id,broj_kola,broj_igraca,status) VALUES('$imeSezone','$id',$brojKola,$brojIgraca,1)";
		$_rez=mysqli_query($veza, $_upit);
		
		$_id_sezone=-1;
		$ima_greska=false;
		if (!$_rez) $ima_greska=true;
		else $_id_sezone=mysqli_insert_id($veza);
		
		if (!$ima_greska){
		$_upit="CREATE TABLE korisnici_$_id_sezone(
										rb INT NOT NULL AUTO_INCREMENT,
										korisnik_id int NOT NULL UNIQUE,
										PRIMARY KEY(rb),
										FOREIGN KEY(korisnik_id) REFERENCES korisnici(id)
		) ENGINE=InnoDB";
		$_rez=mysqli_query($veza, $_upit);
		if (!$_rez) $ima_greska=true;}
		
		if (!$ima_greska){
		$_upit="CREATE TABLE utakmice_$_id_sezone(
										rb INT NOT NULL AUTO_INCREMENT,
										utakmica_id int NOT NULL UNIQUE,
										PRIMARY KEY(rb),
										FOREIGN KEY(utakmica_id) REFERENCES utakmice(id)
		) ENGINE=InnoDB";
		$_rez=mysqli_query($veza, $_upit);
		if (!$_rez) $ima_greska=true;}
		
		if (!$ima_greska)
		{
			mysqli_query($veza, "INSERT INTO obavijesti(sezona_id,korisnik_id) VALUES($_id_sezone,$id)");
		
			echo<<<_END
			<br><br>
<center><input type="text" class="napravi_polje" readonly="readonly" value="ID Sezone: $_id_sezone" style="color:#FF0" /><br /></center>
<center><input type="button" value="Uredu" class="napravi_dugme" onclick="javascript:napravi_sezonu('start');" /></center>
_END;
		}
		else
		{
			echo<<<_END
			<br><br>
<center><input type="text" class="napravi_polje" readonly="readonly" value="Greska!" style="color:#FF0" /><br /></center>
<center><input type="button" value="Uredu" class="napravi_dugme" onclick="javascript:napravi_sezonu('start');" /></center>
_END;
		}
	}
}
else
{
	echo <<<_END
<center>
	<input type="text" class="napravi_polje_header" readonly="readonly" value="Ime sezone" /><br />
	<input type="text" class="napravi_polje" name="imeSezone" id="imeSezone" /><br />
	<input type="text" class="napravi_polje_header" readonly="readonly" value="Broj kola" /><br />
	<input type="text" class="napravi_polje" name="brojKola" id="brojKola" /><br />
	<input type="text" class="napravi_polje_header" readonly="readonly" value="Broj igraca" /><br />
	<input type="text" class="napravi_polje" name="brojIgraca" id="brojIgraca" /><br /><br />
</center>
<center> <input type="button" value="Napravi sezonu" class="napravi_dugme" onclick="javascript:napravi_sezonu('end');" /> </center>
_END;
}
?>