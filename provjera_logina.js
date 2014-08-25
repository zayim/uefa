// JavaScript Document
function provjeri()
{
	var poruka="";
	var podaciOK=true;
	
	var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;
	
	if (username=="") { poruka+="username"; podaciOK=false; }
	if (password=="") { poruka+=", password"; podaciOK=false; }
	
	if (!podaciOK)
	{
		if (poruka.charAt(0)==",") poruka=poruka.substr(2);
		poruka="Niste unijeli " + poruka + "!";
		alert(poruka);
		document.getElementById("username").value="";
		document.getElementById("password").value="";
	}
	else
	{
		var zahtjev=new ajaxZahtjev();
		zahtjev.open("POST","login.php",true);
		zahtjev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var parametri="username="+username+"&password="+password;
		zahtjev.onreadystatechange=function()
		{
			if (this.readyState==4 && this.status==200 && this.responseText)
			{
				//Sdocument.getElementById("nedo").innerHTML=this.responseText;
				if (this.responseText=="fail")
				{
					document.getElementById("upozorenje").style.background="url('slike/warning.png')";
				}
				else if(this.responseText=="success")
				{
					window.location.href="profil.php";
				}
			}
		}
		zahtjev.send(parametri);
		zahtjev.close();
	}
}