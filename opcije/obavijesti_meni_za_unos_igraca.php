<?php

session_start();
require_once("../konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_obavijesti'])) die("Greska!");

$id=$_SESSION['id'];

$id_obavijesti=$_POST['id_obavijesti'];

$upit="SELECT * FROM obavijesti WHERE id=$id_obavijesti";
$rez=mysql_query($upit);
if ($rez==false || mysql_num_rows($rez)>1) die("Greska");
$red=mysql_fetch_assoc($rez);

$id_sezone=$red['sezona_id'];

$upit2="SELECT * FROM sezone WHERE id=$id_sezone";
$rez2=mysql_query($upit2);
if ($rez2==false || mysql_num_rows($rez2)>1) die("Greska");
$red2=mysql_fetch_assoc($rez2);

$broj_igraca=$red2['broj_igraca'];

echo <<<_END
<br/><center><input type="text" readonly="readonly" value="Unesite igrače" class="obavijest_polje" /></center> <br />
_END;
echo "<center><table>";
for ($i=0; $i<$broj_igraca; $i++)
{
	if ($i%3==0) echo "<tr>";
	echo <<<_END
	<td class="obavijesti_td">  <input type="text" id="igrac_$i" value="Igrač $i" onfocus="if (this.value=='Igrač $i') this.value=''" onblur="if (this.value=='') this.value='Igrač $i'"/>   </td>
_END;
	if ($i%3==2) echo "</tr>";
}
echo "</table></center>";

echo <<<_END
<center><input type="button" value="Unesi" class="napravi_dugme" onclick="provjeri_i_unesi($id,$id_sezone,$broj_igraca,$id_obavijesti)" /></center>
_END;

?>