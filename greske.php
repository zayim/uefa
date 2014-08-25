<?php
$tip=$_GET['tip'];

if ($tip==0) // NISMO SE KONEKTOVALI NA BAZU
{
	echo "Ne moze se konektovati na bazu";
}
elseif($tip==1) // NE MOZEMO NAPRAVITI TABELU
{
	$tabela=$_GET['tabela'];
	
	if ($tabela=="korisnici") echo "Ne moze napraviti tabelu korisnici";
	elseif ($tabela=="sezone") echo "Ne moze napraviti tabelu sezone";
	elseif ($tabela=="spiskovi") echo "Ne moze napraviti tabelu spiskovi";
	elseif ($tabela=="utakmice") echo "Ne moze napraviti tabelu utakmice";
}
elseif($tip==2) // NIJE USPJELA REGISTRACIJA
{
	echo "Nije uspjela registracija";
}

?>