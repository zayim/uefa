<?php

$veza=mysql_connect("127.0.0.1","root");

if (!$veza) { header("Location: greske.php?tip=0"); die(); }

$imeBaze="uefa";
$imaLiBaza=mysql_select_db("$imeBaze",$veza);
if (!$imaLiBaza)
{
	mysql_query("CREATE DATABASE $imeBaze");
	$imaLiBaza=mysql_select_db("$imeBaze",$veza);
}
/////// KORISNICI
$tabela=mysql_query("DESCRIBE korisnici");

if (!$tabela)
{
	$rez=mysql_query("CREATE TABLE korisnici(
								id INT AUTO_INCREMENT,
								ime varchar(100) NOT NULL,
								prezime varchar(100) NOT NULL,
								username varchar(25) NOT NULL UNIQUE,
								password varchar(40) NOT NULL,
								slika varchar(255) NOT NULL,
								PRIMARY KEY(id)) ENGINE=InnoDB");
	if (!$rez) { header("Location: greske.php?tip=1&tabela=korisnici"); die(); }
}

/////// SEZONE
$tabela=mysql_query("DESCRIBE sezone");

if (!$tabela)
{
	$rez=mysql_query("CREATE TABLE sezone(
								id INT AUTO_INCREMENT,
								ime varchar(100) NOT NULL,
								vlasnik_id INT NOT NULL,
								broj_kola INT NOT NULL,
								broj_igraca INT NOT NULL,
								status INT(1) NOT NULL,
								PRIMARY KEY(id),
								FOREIGN KEY(vlasnik_id) REFERENCES korisnici(id)								
								) ENGINE=InnoDB");
	if (!$rez) { header("Location: greske.php?tip=1&tabela=sezone");  die(); }
}

/////// SPISKOVI
$tabela=mysql_query("DESCRIBE spiskovi");

if (!$tabela)
{
	$rez=mysql_query("CREATE TABLE spiskovi(
								id INT AUTO_INCREMENT,
								vlasnik_id INT NOT NULL,
								sezona_id INT NOT NULL,
								PRIMARY KEY(id),
								FOREIGN KEY(vlasnik_id) REFERENCES korisnici(id),
								FOREIGN KEY(sezona_id) REFERENCES sezone(id),
								CONSTRAINT sez_kor UNIQUE (sezona_id,vlasnik_id)								
								) ENGINE=InnoDB");
	if (!$rez) { header("Location: greske.php?tip=1&tabela=spiskovi"); die(); }
}

/////// UTAKMICE
$tabela=mysql_query("DESCRIBE utakmice");

if (!$tabela)
{
	$rez=mysql_query("CREATE TABLE utakmice(
								id INT AUTO_INCREMENT,
								sezona_id INT NOT NULL,
								korisnik_domacin_id INT NOT NULL,
								korisnik_gost_id INT NOT NULL,
								rezultat_domacin INT NOT NULL,
								rezultat_gost INT NOT NULL,
								PRIMARY KEY(id),
								FOREIGN KEY(sezona_id) REFERENCES sezone(id),
								FOREIGN KEY(korisnik_domacin_id) REFERENCES korisnici(id),
								FOREIGN KEY(korisnik_gost_id) REFERENCES korisnici(id)								
								) ENGINE=InnoDB");
	if (!$rez) { header("Location: greske.php?tip=1&tabela=utakmice"); die(); }
}

/////// OBAVIJESTI
$tabela=mysql_query("DESCRIBE obavijesti");

if (!$tabela)
{
	$rez=mysql_query("CREATE TABLE obavijesti(
								id INT AUTO_INCREMENT,
								sezona_id INT NOT NULL,
								korisnik_id INT NOT NULL,
								PRIMARY KEY(id),
								FOREIGN KEY(sezona_id) REFERENCES sezone(id),
								FOREIGN KEY(korisnik_id) REFERENCES korisnici(id),
								CONSTRAINT sez_kor UNIQUE (sezona_id,korisnik_id)							
								) ENGINE=InnoDB ");
	if (!$rez) { header("Location: greske.php?tip=1&tabela=obavijesti"); die(); }
}

function popraviString($var)
{
	$var = mysql_real_escape_string($var);
	if (get_magic_quotes_gpc()) $var = stripslashes($var);
	$var = htmlentities($var);
	$var = strip_tags($var);
	return $var;
}

function destroy_session_and_data()
{
	$_SESSION = array();
	if (session_id() != "" || isset($_COOKIE[session_name()]))
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();
}

?>