<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UEFA - vas saputnik za PES 2013</title>
<script type="text/javascript" src="ajax_zahtjev.js"></script>
<script type="text/javascript" src="provjera_logina.js"> </script>
<link rel="stylesheet" type="text/css" href="stilovi/index.css" />
<?php
session_start();
require_once("konekcija.php");
if (isset($_SESSION['username'])) { header("Location: profil.php"); die(); }
?>
</head>

<body>
<br/><br/>
<center><div id="header"> PRIJAVI SE </div></center>
<center><div id="sadrzaj">
<br />
<div id="upozorenje"> </div>
<input type="text" readonly="readonly" class="polje_header" value="Korisničko ime" /><br />
<input type="text" name="username" id="username" class="polje"/><br />
<input type="text" readonly="readonly" class="polje_header" value="Šifra" /><br />
<input type="password" name="password" id="password" class="polje" /><br />
<input type="button" value="Prijavi se" onclick="provjeri()" class="dugme_prijavi_se" /><br />
<center><div id="footer" style="margin-top:130px">
<a href="registracija.html"> <input type="button" value="Registruj se" class="dugme"/> </a><br /><br />
<span style="color:#F00; font-family:'Segoe UI',Arial,Helvetica,sans-serif; font-size:18px; font-weight:bold">Autori: Elmir Sukanović i Nadin Zajimović</span>
</div></center>

</div></center>


</body>
</html>
