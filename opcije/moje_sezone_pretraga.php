<?php

session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['ime_sezone'])) { die(); }
$id=$_SESSION['id'];
$dio_imena=$_POST['ime_sezone'];

$upit="SELECT  id,ime FROM sezone WHERE ime LIKE '%$dio_imena%' AND vlasnik_id=$id ORDER BY id DESC";

$rez=mysqli_query($veza, $upit);

$broj_redova=mysqli_num_rows($rez);

echo "<ul class='list_moje_sezone_ul'>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	$id_sezone=$red['id']; $ime_sezone=$red['ime'];
	echo <<< _END
	<li><a href="javascript:prikazi_moju_sezonu($id_sezone)">$ime_sezone</a></li><br/>
_END;
}
echo "</ul>";

?>