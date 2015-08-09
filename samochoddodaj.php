<?php
include('template/header.php');
?>

<?php
$id=$_POST['id'];
echo ('Uzupełnij dane:<br />');
echo ('<form method="post" action="samochoddodaj2.php" name="formularz" id="formularz">
<input type="hidden" name="wl" value="'.$id.'" />
<b>Marka</b>:<br /><input type="text" name="marka" placeholder="Wpisz markę" required /><br />
<b>Model</b>:<br /><input type="text" name="model" placeholder="Wpisz model" required /><br />
<b>Rocznik</b>:<br /><input type="number" name="rocznik" placeholder="Wpisz rocznik" required /><br />
<b>Przebieg</b>:<br /><input type="number" name="przebieg" placeholder="Wpisz przebieg" required /><br />
<b>VIN</b>:<br /><input type="text" name="vin" maxlength="17" placeholder="Wpisz VIN" required /><br />
<b>Numer rejestracyjny</b>:<br /><input type="text" name="nrrej" maxlength="7" placeholder="Wpisz numer rejestracyjny" required /><br />
&nbsp;<input type="submit" value="Zapisz"/>&nbsp;</form>');
?>
<?php
include('template/footer.php');
?>