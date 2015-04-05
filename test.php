<?php

$veza=mysqli_connect("127.0.0.1","root");

echo "Veza: <br/><pre>";
var_dump($veza);
echo "</pre>";

$imeBaze="uefa";
$imaLiBaza=mysqli_select_db($veza, "$imeBaze");

echo "Ima li baza: <br/><pre>";
var_dump($imaLiBaza);
echo "</pre>";

$tabela=mysqli_query($veza, "DESCRIBE korisnici");

echo "Tabela: <br/><pre>";
var_dump($tabela);
echo "</pre>";