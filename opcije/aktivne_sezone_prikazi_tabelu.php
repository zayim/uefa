<?php
session_start();
require_once("../konekcija.php");
if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }
if (!isset($_POST['id_sezone'])) { die("Greska!"); }
$id=$_SESSION['id'];
$id_sezone=$_POST['id_sezone'];

class igrac
{
	public $ime="";
	public $prezime="";
	public $broj_odigranih=0;
	public $broj_pobjeda=0;
	public $broj_nerijesenih=0;
	public $broj_poraza=0;
	public $postignuti_golovi=0;
	public $primljeni_golovi=0;
}

$upit = "SELECT DISTINCT vlasnik_id, ime, prezime FROM spiskovi JOIN korisnici ON spiskovi.vlasnik_id=korisnici.id  WHERE sezona_id=$id_sezone";
$rez=mysqli_query($veza, $upit);
$broj_redova=mysqli_num_rows($rez);

$igraci = array();

for ($i=0; $i<$broj_redova; $i++)
{
	$red = mysqli_fetch_assoc($rez);
	
	$igrac = new igrac;
	$igrac->ime = $red['ime'];
	$igrac->prezime = $red['prezime'];
	
	////// OBRADA DOMACIH UTAKMICA
	$upit2 = "SELECT * FROM utakmice WHERE sezona_id=$id_sezone AND korisnik_domacin_id=".$red['vlasnik_id'];
	$rez2 = mysqli_query($veza, $upit2);
	$broj_redova2 = mysqli_num_rows($rez2);
	
	for ($j=0; $j<$broj_redova2; $j++)
	{
		$red2 = mysqli_fetch_assoc($rez2);
		
		$igrac->broj_odigranih++;
		if ($red2['rezultat_domacin'] > $red2['rezultat_gost'] ) $igrac->broj_pobjeda++;
		else if ($red2['rezultat_domacin'] == $red2['rezultat_gost'] ) $igrac->broj_nerijesenih++;
		else $igrac->broj_poraza++;
		$igrac->postignuti_golovi += $red2['rezultat_domacin'];
		$igrac->primljeni_golovi += $red2['rezultat_gost'];
	}
	/////// KRAJ OBRADE DOMACIH UTAKMICA
	$upit2 = "SELECT * FROM utakmice WHERE sezona_id=$id_sezone AND korisnik_gost_id=".$red['vlasnik_id'];
	$rez2 = mysqli_query($veza, $upit2);
	$broj_redova2 = mysqli_num_rows($rez2);
	
	for ($j=0; $j<$broj_redova2; $j++)
	{
		$red2 = mysqli_fetch_assoc($rez2);
		
		$igrac->broj_odigranih++;
		if ($red2['rezultat_domacin'] > $red2['rezultat_gost'] ) $igrac->broj_poraza++;
		else if ($red2['rezultat_domacin'] == $red2['rezultat_gost'] ) $igrac->broj_nerijesenih++;
		else $igrac->broj_pobjeda++;
		$igrac->postignuti_golovi += $red2['rezultat_gost'];
		$igrac->primljeni_golovi += $red2['rezultat_domacin'];
	}
	////// OBRADA GOSTUJUCIH UTAKMICA
	
	
	/////// KRAJ OBRADE GOSTUJUCIH H UTAKMICA
	
	$igraci[] = $igrac;
}

for ($i=0; $i<$broj_redova-1; $i++)
{
	for ($j=$i+1; $j<$broj_redova; $j++)
	{
		if (3*$igraci[$i]->broj_pobjeda + $igraci[$i]->broj_nerijesenih < 3*$igraci[$j]->broj_pobjeda + $igraci[$j]->broj_nerijesenih)
		{
			$t = $igraci[$i];
			$igraci[$i] = $igraci[$j];
			$igraci[$j] = $t;
		}
	}
}

echo "<br><br>";
echo "<table id='tabela_rezultati'>";
echo "<tr><td>RB</td><td>Ime i prezime</td><td>Odigrano</td><td>Pobjede</td><td>Neriješeno</td><td>Porazi</td><td>Gol-razlika</td><td>Poeni</td></tr>";
for ($i = 0; $i < $broj_redova; $i++)
{
	$rb=$i+1;
	echo "<tr>";
	
	echo "<td>$rb</td><td>".$igraci[$i]->ime." ".$igraci[$i]->prezime."</td><td>".$igraci[$i]->broj_odigranih."</td><td>".$igraci[$i]->broj_pobjeda."</td>";
	echo "<td>".$igraci[$i]->broj_nerijesenih."</td><td>".$igraci[$i]->broj_poraza."</td><td>".$igraci[$i]->postignuti_golovi.":".$igraci[$i]->primljeni_golovi."</td>";
	echo "<td>".(3*$igraci[$i]->broj_pobjeda + $igraci[$i]->broj_nerijesenih)."</td>";
	
	echo "</tr>";
}
echo "</table>";
?>