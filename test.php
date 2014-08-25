<?php
require_once("konekcija.php");

session_start();
if (isset($_SESSION['username']))
echo $_SESSION['ime'];
else echo "Nije";

?>