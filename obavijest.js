// JavaScript Document


function obavijesti()
{
	parametri="";
	zahtjev = new ajaxZahtjev();
	zahtjev.open("POST","opcije/obavijesti_ispisi.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("sadrzaj").innerHTML= "<br />" + this.responseText;
		}
	}
	
	zahtjev.send(parametri);
}

function provjeri_obavijesti()
{
	parametri="";
	zahtjev = new ajaxZahtjev();
	zahtjev.open("POST","opcije/obavijesti_provjeri.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			var broj=this.responseText;
			var obavijest_meni=document.getElementById("obavijesti_meni");
			if (broj!=0)
			{
				var obavijest_meni=document.getElementById("obavijesti_meni");
				obavijest_meni.style.background="url('slike/bg_list_o.png') no-repeat";
				obavijest_meni.style.color="#000";
				obavijest_meni.style.textShadow="none";
				document.getElementById("obavijesti_meni").innerHTML="Obavijesti ("+broj+")";
				naslov=document.getElementsByTagName("title").item(0);
				var i=0; var duzina=naslov.innerHTML.length;
				while (i<duzina && naslov.innerHTML.charAt(i)!=')') i++; if (i==duzina) i=0; else i++;
				naslov.innerHTML="(" + broj + ") " + naslov.innerHTML.substr(i);
			}
			else
			{
				var obavijest_meni=document.getElementById("obavijesti_meni");
				obavijest_meni.style.background="url('slike/bg_list.png') no-repeat";
				obavijest_meni.style.color="#FFF";
				obavijest_meni.style.textShadow="2px 2px 4px #000";
				document.getElementById("obavijesti_meni").innerHTML="Obavijesti";
				
				naslov=document.getElementsByTagName("title").item(0);
				var i=0; var duzina=naslov.innerHTML.length;
				while (i<duzina && naslov.innerHTML.charAt(i)!=')') i++; if (i==duzina) i=0; else i++;
				naslov.innerHTML=naslov.innerHTML.substr(i);
			}
		}
	}
	
	zahtjev.send(parametri);
}
function obavijest_prihvati(id_obavijesti)
{
	
	parametri="id_obavijesti="+id_obavijesti;
	zahtjev.open("POST","opcije/obavijesti_meni_za_unos_igraca.php",true);
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
function obavijest_odbij(id_obavijesti,tip)
{
	parametri="id_obavijesti="+id_obavijesti;
	zahtjev.open("POST","opcije/obavijesti_izbrisi.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText && tip==1)
		{
			if (this.responseText=="success") obavijesti();
		}
	}
	
	zahtjev.send(parametri);
}
function provjeri_i_unesi(id_korisnika,id_sezone,broj_igraca,id_obavijesti)
{
	parametri="id_korisnika="+id_korisnika+"&id_sezone="+id_sezone+"&broj_igraca="+broj_igraca;
	for (var i=0; i<broj_igraca; i++)
	{
		var editPolje=document.getElementById("igrac_"+i);
		if (editPolje.value=="" || editPolje.value==("Igrač "+i))
		{
			alert("Niste unijeli sve igrače!");
			return;
		}
		parametri+="&igrac_"+i+"="+editPolje.value;
	}
	
	zahtjev.open("POST","opcije/obavijesti_dodaj_igraca_u_sezonu.php",true);
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200 && this.responseText)
		{
			document.getElementById("sadrzaj").innerHTML=this.responseText;
			obavijest_odbij(id_obavijesti,2);
		}
	}
	
	zahtjev.send(parametri);
	
}