<?php
session_start();
if (!isset($_SESSION['pbd_tabela_username']) || $_SESSION['pbd_tabela_username']!='zayim') die("Greska");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Svi članci</title>
<link rel="stylesheet" type="text/css" href="stilovi.css" />
</head>

<body>
<?php

$upit="select * from clanci order by datum desc";
$rez=mysqli_query($veza, $upit);
	
if ($rez==false) die("Greška! <a href='index.php'> Povratak </a>");
$broj_redova=mysqli_num_rows($rez);
echo "<table><tr><td>RB</td><td>Ime članka</td><td>Vrijeme dodavanja</td></tr>";
for ($i=0; $i<$broj_redova; $i++)
{
	$red=mysqli_fetch_assoc($rez);
	echo "<tr><td>".($i+1)."</td><td>".$red['ime_clanka']."</td><td>".$red['datum']."</td></tr>";
}
echo "</table>";

?>
</body>
</html>