<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone']) || !isset($_POST['id_igraca'])) { die("Greska!"); }
$id_igraca=$_POST['id_igraca'];
$id_sezone=$_POST['id_sezone'];

$upit = "SELECT * FROM spiskovi WHERE vlasnik_id=$id_igraca AND sezona_id=$id_sezone";
$rez = mysql_query($upit) or die("Greška!");
$red = mysql_fetch_assoc($rez);
$id_spiska = $red['id'];

$upit = "SELECT * FROM spisak_$id_spiska";
$rez = mysql_query($upit) or die("Greška!");

echo "<br><br><table id='tabela_moji_igraci'><tr><td>RB</td><td>Ime fudbalera</td></tr>";

$broj_igraca = mysql_num_rows($rez);
for ($i=0; $i<$broj_igraca; $i++)
{
	$red = mysql_fetch_assoc($rez);
	
	echo "<tr><td>".($i+1)."</td><td>".$red['ime_fudbalera']."</td></tr>";
}

echo "</table>";

?>