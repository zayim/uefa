<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['ime_sezone'])) { die(); }
$id=$_SESSION['id'];
$dio_imena=$_POST['ime_sezone'];

//die("Nedo");

$upit="SELECT DISTINCT sezone.id, sezone.ime, sezone.status FROM sezone JOIN spiskovi ON sezone.id=spiskovi.sezona_id AND spiskovi.vlasnik_id=$id AND sezone.status IN (2,3) AND
				sezone.ime LIKE '%$dio_imena%' ORDER BY sezone.status, sezone.id DESC";
//die($upit);

$rez=mysql_query($upit);

$broj_redova=mysql_num_rows($rez);

echo "<ul class='list_moje_sezone_ul'>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysql_fetch_assoc($rez);
	$id_sezone=$red['id']; $ime_sezone=$red['ime'];
	echo <<< _END
	<li><a href="javascript:prikazi_aktivnu_sezonu($id_sezone)">$ime_sezone</a></li><br/>
_END;
}
echo "</ul>";

?>