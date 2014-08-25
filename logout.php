<?php
require_once("konekcija.php");

session_start();
//if (!isset($_SESSION['username'])) header("Location: index.php");
destroy_session_and_data();
header("Location: index.php"); die();

?>