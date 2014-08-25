// JavaScript Document

function moje_sezone()
{
	var sadrzaj="";
	sadrzaj+="<center> <input type='button' value='Sve sezone' onclick='prikazi_sve_moje_sezone()' class='moje_sezone_dugme' /> </center><br />";
	sadrzaj+="<center><input type='text' readonly='readonly' value='Ime sezone' class='moje_sezone_polje_header'/></center>";
	sadrzaj+="<center><input type='text' id='ime_moje_sezone' onkeyup='trazi_moje_sezone(this,1)' class='moje_sezone_polje'/></center>";
	sadrzaj+="<center> <div id='prikaz_mojih_sezona'></div>";
	document.getElementById("sadrzaj").innerHTML=sadrzaj;
}
function napravi_sezonu(arg)
{
	zahtjev = new ajaxZahtjev();
	if (zahtjev==false) alert("Nema zahtjeva");
	parametri="tip="+arg;
	zahtjev.open("POST","opcije/napravi_sezonu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	if(arg=="end")
	{
		parametri+="&imeSezone=" + document.getElementById("imeSezone").value + "&";
		parametri+="brojKola=" + document.getElementById("brojKola").value + "&";
		parametri+="brojIgraca=" + document.getElementById("brojIgraca").value;
	}
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200)
		{
			document.getElementById("sadrzaj").innerHTML= "<br /><br />" + this.responseText;
		}
	}
	
	zahtjev.send(parametri);
	zahtjev.close();
}

function init(arg)
{
	var w=document.getElementById("slikaProfila").width;
	var h=document.getElementById("slikaProfila").height;
	var wS=""; var hS="";
	if (w>h)
	{
		wS=150; hS+=parseInt(150*(h/w));
		document.getElementById("slikaProfila").width=wS;
		document.getElementById("slikaProfila").height=hS;
	}
	else
	{
		hS=150; wS+=parseInt(150*(w/h)); 
		document.getElementById("slikaProfila").height=hS;
		document.getElementById("slikaProfila").width=wS;
	}
	setInterval("provjeri_obavijesti()",1000);
}

function prikazi_sve_moje_sezone()
{
	trazi_moje_sezone(document.getElementById('ime_moje_sezone'), 2);
}

function trazi_moje_sezone(arg, arg2)
{
	zahtjev = new ajaxZahtjev();
	if (arg2==2) var ime_sezone="";
	else var ime_sezone=arg.value;
	if (ime_sezone=="" && arg2==1)
		document.getElementById("prikaz_mojih_sezona").innerHTML="";
	else
	{
		parametri="";
		zahtjev.open("POST","opcije/moje_sezone_pretraga.php",true);
		zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		parametri="ime_sezone="+ime_sezone;
	
		zahtjev.onreadystatechange=function()
		{
			if (this.readyState==4 && this.status==200 && this.responseText)
			{
				document.getElementById("prikaz_mojih_sezona").innerHTML=this.responseText;
			}
		}
	
		zahtjev.send(parametri);
	}
}

function prikazi_moju_sezonu(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	parametri="";
	document.getElementById("sadrzaj").innerHTML="";
	
	zahtjev.open("POST","opcije/prikazi_moju_sezonu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	parametri="id_sezone="+id_sezone;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);
	
}

function moja_sezona_dodaj(arg,id_korisnika,id_sezone)
{
	zahtjev = new ajaxZahtjev();
	parametri="tip="+arg+"&id_sezone="+id_sezone;
	zahtjev.open("POST","opcije/dodaj_korisnika.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	if (arg=='end') parametri+="&id_korisnika="+id_korisnika;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("moja_sezona_sadrzaj").innerHTML= this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function trazi_korisnika(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	parametri="id_sezone="+id_sezone;
	zahtjev.open("POST","opcije/trazi_korisnika_za_dodati.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var ime=document.getElementById("dodaj_korisnika_polje").value;
	
	if (ime=="")
	{
		document.getElementById("rezultati_pretrage_korisnika").innerHTML="";
		return;
	}
	
	parametri+="&ime="+ime;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("rezultati_pretrage_korisnika").innerHTML= this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function moja_sezona_obrisi(arg,id_korisnika,id_sezone)
{
	zahtjev = new ajaxZahtjev();
	parametri="tip="+arg+"&id_sezone="+id_sezone;
	zahtjev.open("POST","opcije/obrisi_korisnika.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	if (arg=='end') parametri+="&id_korisnika="+id_korisnika;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("moja_sezona_sadrzaj").innerHTML= this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function trazi_korisnika_brisi(id_sezone,tip)
{
	zahtjev = new ajaxZahtjev();
	parametri="id_sezone="+id_sezone;
	zahtjev.open("POST","opcije/trazi_korisnika_za_brisati.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var ime=document.getElementById("dodaj_korisnika_polje").value;
	
	if (ime=="" && tip==1)
	{
		document.getElementById("rezultati_pretrage_korisnika").innerHTML="";
		return;
	}
	
	parametri+="&ime="+ime;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("rezultati_pretrage_korisnika").innerHTML= this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function moja_sezona_obrisi_rez(arg,id_sezone)
{
	var sadrzaj="";
	sadrzaj+="<input type='text' readonly='readonly' value='Username 1. igrača' class='moje_sezone_polje_header'/><br/>";
	sadrzaj+="<input type='text' class='moje_sezone_polje' id='username1' /><br/>";
	sadrzaj+="<input type='text' readonly='readonly' value='Username 2. igrača' class='moje_sezone_polje_header'/><br/>";
	sadrzaj+="<input type='text' class='moje_sezone_polje' id='username2' /><br/>";
	sadrzaj+="<input type='button' value='Traži' class='moje_sezone_dugme' onclick='trazi_utakmice(1,"+id_sezone+")'/>";
	sadrzaj+="<input type='button' value='Prikaži sve' class='moje_sezone_dugme' onclick='trazi_utakmice(2,"+id_sezone+")' />";
	sadrzaj+="<div id='rezultat_pretrage_utakmice'></div>";
	document.getElementById("moja_sezona_sadrzaj").innerHTML=sadrzaj;
	
}
function trazi_utakmice(tip,id_sezone)
{
	zahtjev = new ajaxZahtjev();
	var username1=""; var username2="";
	
	if (tip==1)
	{
		username1=document.getElementById("username1").value;
		username2=document.getElementById("username2").value;
	}
	
	if (tip==1 && username1=="" && username2=="")
		return;
	
	parametri="id_sezone="+id_sezone+"&tip="+tip+"&username1="+username1+"&username2="+username2;
	
	zahtjev.open("POST","opcije/moje_sezone_trazi_utakmicu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("rezultat_pretrage_utakmice").innerHTML= this.responseText;
		}
	}
	
	zahtjev.send(parametri);
	
}
function moja_sezona_obrisi_utakmicu(id_utakmice,id_sezone,tip)
{
	zahtjev = new ajaxZahtjev();
	parametri="";
	zahtjev.open("POST","opcije/obrisi_utakmicu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	parametri="id_utakmice="+id_utakmice+"&id_sezone="+id_sezone;
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200) ///?!
		{
			trazi_utakmice(tip,id_sezone);
		}
	}
	
	zahtjev.send(parametri);	
}