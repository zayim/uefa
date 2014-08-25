<?php

session_start();

require_once("konekcija.php");

if (!isset($_SESSION['username'])) { header("Location: index.php"); die(); }

$ime=$_SESSION['ime'];
$prezime=$_SESSION['prezime'];
$username=$_SESSION['username'];
$slika=$_SESSION['slika'];

echo <<<_END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>[$username] - UEFA.com</title>
<script type="text/javascript" src="ajax_zahtjev.js"> </script>
<script type="text/javascript" src="profil_meni.js"> </script>
<script type="text/javascript" src="obavijest.js"> </script>
<script type="text/javascript" src="aktivne_sezone.js"> </script>
<link rel="stylesheet" href="stilovi/profil.css" />
<link rel="stylesheet" href="stilovi/opcije.css" />
<link rel="stylesheet" href="stilovi/obavijest.css" />
<link rel="stylesheet" href="stilovi/aktivne_sezone.css" />
</head>
_END;

?>
<body onload='init()'>
<center><ul>
<a href="javascript:moje_sezone()"><li> Moje sezone </li></a>
<a href="javascript:aktivne_sezone()"><li> Aktivne sezone </li></a>
<a href="javascript:napravi_sezonu('start')"><li> Napravi sezonu </li></a>
<a href="javascript:obavijesti()" ><li id="obavijesti_meni"> Obavijesti </li></a>
<a href="logout.php"><li> Odjava </li></a>
</ul></center>

<div id="omotac">

<div id="sadrzaj">
<br>
Dobro došli!

</div>

<div id="podaci">
<p>
<br>
<?php
echo "<center><img src='$slika' id='slikaProfila' alt='$ime $prezime'  /></center><br>Pozdrav, $ime $prezime.<br />Logovani ste kao: $username<br>";
?>
</p>
</div>
</div>

</body>
</html>