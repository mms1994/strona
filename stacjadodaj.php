<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['car_ID'];
echo ('<form method="post" action="stacjadodaj2.php" name="formularz" id="formularz" >
<input type="hidden" name="car_ID" value='.$car_ID.' />
<b>Nazwa stacji</b>:<br /><input type="text" name="nazwa" id="nazwa" placeholder="Wpisz nazwę stacji" required /><br />
<b>Miejscowość</b>:<br /><input type="text" name="miejscowosc" id="miejscowosc" placeholder="Wpisz miejscowość" required /><br />
<b>Ulica</b>:<br /><input type="text" name="ulica" id="ulica" placeholder="Wpisz ulicę" required /><br />
<b>Numer</b>:<br /><input type="text" name="numer" id="numer" placeholder="Wpisz numer" required /><br />
<input type="submit" value="Dalej"/>&nbsp;</form>');

?>

<?php
include('template/footer.php');
?>