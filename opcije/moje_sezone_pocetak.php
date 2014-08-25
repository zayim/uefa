<?php

echo<<<_END

<center> <input type="button" value="Sve sezone" onclick="prikazi_sve_sezone()" /> </center><br />
<center><input type="text" readonly="readonly" value="Ime sezone" /></center><br />
<center><input type="text" id="ime_moje_sezone" onkeyup="trazi_moje_sezone(this)"/></center><br />
<center>
<div id="prikaz_mojih_sezona">
</div>

_END;

?>