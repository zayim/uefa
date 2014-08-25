<?php
session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) die("Greska!");

$id_korisnika=$_SESSION['id'];
$id_sezone=$_POST['id_sezone'];
$pass=$_SESSION['password'];

$upit="SELECT * FROM sezone WHERE id=$id_sezone";
$rez=mysql_query($upit);
if (mysql_num_rows($rez)!=1) die("Greska");

$red=mysql_fetch_assoc($rez);
if($red['status']==1)
{
	echo <<<_END
	<center> 
	<input type='button' value='Dodaj korisnika' onclick="moja_sezona_dodaj('start',-1,$id_sezone)" class='moje_sezone_dugme' />
	<input type='button' value='Obriši korisnika' onclick="moja_sezona_obrisi('start',-1,$id_sezone)" class='moje_sezone_dugme' />
	<input type='button' value='Počni sezonu' onclick="window.location.href='opcije/pocni_moju_sezonu.php?id_sezone=$id_sezone&id_korisnika=$id_korisnika'" class='moje_sezone_dugme' />
	
	</center></br>
	<center>
	<div id='moja_sezona_sadrzaj'>
	</div>
	</center>
_END;
}
else if($red['status']==2)
{
	echo <<<_END
	<center> 
	
	<input type='button' value='Obriši korisnika' onclick="moja_sezona_obrisi('start',-1,$id_sezone)" class='moje_sezone_dugme' />
	<input type='button' value='Obriši utakmicu' onclick="moja_sezona_obrisi_rez('start',$id_sezone)" class='moje_sezone_dugme' />
	<input type='button' value='Završi sezonu' onclick="window.location.href='opcije/zavrsi_moju_sezonu.php?id_sezone=$id_sezone&id_korisnika=$id_korisnika'" class='moje_sezone_dugme' />
	
	</center></br>
	<center>
	<div id='moja_sezona_sadrzaj'>
	</div>
	</center>
_END;
}
else if($red['status']==3)
{
	echo "Arhivirana";
}



?>