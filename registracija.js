// JavaScript Document

function provjeri_dostupnost()
{
	
	var zahtjev=new ajaxZahtjev();
	var username_tmp=document.getElementById("username").value;
	
	if (username_tmp=="")
	{
		document.getElementById("username_opis").innerHTML="";
		return;
	}
	
	zahtjev.open("POST","provjeri_username.php",true);
	
	zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	zahtjev.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200)
		{
			if (this.responseText=="dostupno")
			{
				document.getElementById("username_opis").innerHTML="Dostupno :)";
				document.getElementById("dugme").disabled="";
			}
			else
			{
				document.getElementById("username_opis").innerHTML="Nije dostupno :(";
				document.getElementById("dugme").disabled="true";
			}
		}
	}
	
	if (username_tmp!="")
	{
		var parametri="username="+username_tmp;
		zahtjev.send(parametri);
	}
}

function provjeri_podatke()
{
	var poruka="";
	var podaciOK=true;
	
	var ime=document.getElementById("ime").value;
	var prezime=document.getElementById("prezime").value;
	var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;
	
	if (ime=="") { poruka+="ime"; podaciOK=false; }
	if (prezime=="") { poruka+=", prezime"; podaciOK=false; }
	if (username=="") { poruka+=", username"; podaciOK=false; }
	if (password=="") { poruka+=", password"; podaciOK=false; }
	
	if (!podaciOK)
	{
		if (poruka.charAt(0)==",") poruka=poruka.substr(2);
		poruka="Niste unijeli " + poruka + "!";
		alert(poruka);
	}
}