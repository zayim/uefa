<?php
require_once("../konekcija.php");

$domacin_id=$_POST['domacin_id'];
$gost_id=$_POST['gost_id'];
$domacin_rezultat=$_POST['domacin_rezultat'];
$gost_rezultat=$_POST['gost_rezultat'];
$sezona_id=$_POST['sezona_id'];

$upit="INSERT INTO utakmice(sezona_id,korisnik_domacin_id,korisnik_gost_id,rezultat_domacin,rezultat_gost) VALUES($sezona_id,$domacin_id,$gost_id,$domacin_rezultat,$gost_rezultat)";

$rez = mysqli_query($veza, $upit);

if ($rez==false) die($upit);

echo "Uspjeh";

?>