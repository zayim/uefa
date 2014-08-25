// JavaScript Document
function aktivne_sezone()
{
	var sadrzaj="";
	sadrzaj+="<center> <input type='button' value='Sve sezone' onclick='prikazi_sve_aktivne_sezone()' class='moje_sezone_dugme' /> </center><br />";
	sadrzaj+="<center><input type='text' readonly='readonly' value='Ime sezone' class='moje_sezone_polje_header'/></center>";
	sadrzaj+="<center><input type='text' id='ime_aktivne_sezone' onkeyup='trazi_aktivne_sezone(this,1)' class='moje_sezone_polje'/></center>";
	sadrzaj+="<center> <div id='prikaz_aktivnih_sezona'></div>";
	document.getElementById("sadrzaj").innerHTML=sadrzaj;
}
function prikazi_sve_aktivne_sezone()
{
	trazi_aktivne_sezone(document.getElementById('ime_aktivne_sezone'), 2);
}
function trazi_aktivne_sezone(arg,arg2)
{
	zahtjev = new ajaxZahtjev();
	if (arg2==2) var ime_sezone="";
	else var ime_sezone=arg.value;
	
	if (ime_sezone=="" && arg2==1)
		document.getElementById("prikaz_aktivnih_sezona").innerHTML="";
		
		
	else
	{
		parametri="";
		zahtjev.open("POST","opcije/aktivne_sezone_pretraga.php",true);
		zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		parametri="ime_sezone="+ime_sezone;
	
		zahtjev.onreadystatechange=function()
		{
			if (this.readyState==4 && this.status==200 && this.responseText)
			{
				document.getElementById("prikaz_aktivnih_sezona").innerHTML=this.responseText;
			}
		}
	
		zahtjev.send(parametri);
	}
}
function prikazi_aktivnu_sezonu(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone;
	zahtjev.open("POST","opcije/aktivne_sezone_prikazi_sezonu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);	
}
function aktivne_sezone_unesi_rezultat(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone;
	zahtjev.open("POST","opcije/aktivne_sezone_meni_unos_rezultata.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("aktivna_sezona_sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function generisi_golove(id_korisnika,domacin_ili_gost)
{
	if (domacin_ili_gost=='domacin')
		document.getElementById("idDomacina").value=id_korisnika;
	else
		document.getElementById("idGosta").value=id_korisnika;
	/*if (domacin_ili_gost=="domacin" && document.getElementById("domacin_username").value=="Domaćin") return;
	if (domacin_ili_gost=="gost" && document.getElementById("gost_username").value=="Gost") return;
	var div=document.getElementById(domacin_ili_gost+"_golovi");
	if (document.getElementById(domacin_ili_gost+"_rezultat").value=="")
		div.innerHTML="";
	var broj_golova=parseInt(document.getElementById(domacin_ili_gost+"_rezultat").value);
	if (isNaN(broj_golova)) { div.innerHTML=""; return; }
	
	div.innerHTML="Nedo: "+broj_golova;	*/
}

function aktivne_sezone_registruj_rezultat()
{
	var domacinId=document.getElementById("idDomacina").value;
	var gostId=document.getElementById("idGosta").value;
	var domacinRezultat=document.getElementById("domacin_rezultat").value;
	var gostRezultat=document.getElementById("gost_rezultat").value;
	var idSezone=document.getElementById("sezId").value;
	
	if (isNaN(domacinRezultat) || domacinRezultat=="" || isNaN(gostRezultat) || gostRezultat=="" || domacinId == gostId)
	{
		alert("Niste ispravno unijeli podatke!");
		return;
	}
	
	var parametri = "domacin_id=" + domacinId + "&gost_id=" + gostId + "&domacin_rezultat="+domacinRezultat + "&gost_rezultat="+gostRezultat+"&sezona_id="+idSezone;

	zahtjev = new ajaxZahtjev();
	
	zahtjev.open("POST","opcije/aktivne_sezone_registruj_rezuktat.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			if (this.responseText=="Uspjeh")
				document.getElementById("aktivna_sezona_sadrzaj").innerHTML="<br><br>Uspješno uneseno!";
			else
				document.getElementById("aktivna_sezona_sadrzaj").innerHTML="<br><br>" + this.responseText + "<br>Greška!";
		}
	}
	
	zahtjev.send(parametri);
}
function aktivne_sezone_prikazi_tabelu(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone;
	zahtjev.open("POST","opcije/aktivne_sezone_prikazi_tabelu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("aktivna_sezona_sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);	
}
function aktivne_sezone_moji_igraci(id_sezone,id_igraca)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone + "&id_igraca=" + id_igraca;
	zahtjev.open("POST","opcije/aktivne_sezone_moji_igraci.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("aktivna_sezona_sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}
function aktivne_sezone_sve_utakmice(id_sezone)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone;
	zahtjev.open("POST","opcije/aktivne_sezone_sve_utakmice.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("aktivna_sezona_sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);	
}
function aktivne_sezone_moje_utakmice(id_sezone,id_igraca)
{
	zahtjev = new ajaxZahtjev();
	
	parametri="id_sezone=" + id_sezone + "&id_igraca=" + id_igraca;
	zahtjev.open("POST","opcije/aktivne_sezone_moje_utakmice.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("aktivna_sezona_sadrzaj").innerHTML=this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}