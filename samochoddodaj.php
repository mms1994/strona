<?php
include('template/header.php');
?>

<?php
$id=$_POST['id'];
echo ('Uzupełnij dane:(zamiast spacji użyj podkreślników "_")<br />');
echo ('<form method="post" action="samochoddodaj2.php" name="formularz" id="formularz">
<input type="hidden" name="wl" value="'.$id.'" />
<b>Marka</b>:<br /><input type="text" name="marka" placeholder="Wpisz markę" pattern="[A-Z][A-Za-z0-9\-\._]{0,48}" required /><br />
<b>Model</b>:<br /><input type="text" name="model" placeholder="Wpisz model" pattern="[A-Z][A-Za-z0-9\-\._]{0,48}" required /><br />
<b>Rocznik</b>:<br /><input type="text" name="rocznik" placeholder="Wpisz rocznik" pattern="[1-2][0-9]{3}" required /><br />
<b>Przebieg</b>:<br /><input type="text" name="przebieg" placeholder="Wpisz przebieg" pattern="[1-9][0-9]{0,18}" required /><br />
<b>VIN</b>:<br /><input type="text" name="vin" maxlength="17" placeholder="Wpisz VIN" required /><br />
<b>Numer rejestracyjny</b>:<br /><input type="text" name="nrrej" maxlength="7" pattern="[BCDEFGKLNOPRSTWZ][A-Z]{1,2}[A-Z0-9]{4,5}" placeholder="Wpisz numer rejestracyjny" required /><br />
&nbsp;<input type="submit" value="Zapisz"/>&nbsp;</form>');
?>
<?php
include('template/footer.php');
?>