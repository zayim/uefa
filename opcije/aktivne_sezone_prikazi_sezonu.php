<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) { die("Greska!"); }
$id=$_SESSION['id'];
$id_sezone=$_POST['id_sezone'];

	echo <<<_END
	<br />
	<center> 
	<input type='button' value='Unesi rezultat' onclick="aktivne_sezone_unesi_rezultat($id_sezone)" class='aktivne_sezone_dugme' />
	<input type='button' value='Tabela' onclick="aktivne_sezone_prikazi_tabelu($id_sezone)" class='aktivne_sezone_dugme' />
	<!--<input type='button' value='Strijelci' onclick="" class='aktivne_sezone_dugme' />
	<input type='button' value='Asistenti' onclick="" class='aktivne_sezone_dugme' />
	<input type='button' value='Kartoni' onclick="" class='aktivne_sezone_dugme' />
	<input type='button' value='Učesnici' onclick="" class='aktivne_sezone_dugme' />-->
	<input type='button' value='Moji igrači' onclick="aktivne_sezone_moji_igraci($id_sezone,$id)" class='aktivne_sezone_dugme' />
	<input type='button' value='Sve utakmice' onclick="aktivne_sezone_sve_utakmice($id_sezone)" class='aktivne_sezone_dugme' />
	<input type='button' value='Moje utakmice' onclick="aktivne_sezone_moje_utakmice($id_sezone,$id)" class='aktivne_sezone_dugme' />
	</center>
	<center>
	<div id='aktivna_sezona_sadrzaj'>
	</div>
	</center>
_END;



?>