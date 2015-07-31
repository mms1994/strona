<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];
$nazwa=$_POST['nazwa'];
$miejscowosc=$_POST['miejscowosc'];
$ulica=$_POST['ulica'];
$numer=$_POST['numer'];

$zapytanie = "INSERT INTO stacja VALUES ('', '$nazwa', '$miejscowosc', '$ulica', '$numer')";
$wynik = mysql_query($zapytanie);

if ($wynik) {
    echo 'Wpis dodany prawidłowo<br />';
    echo '<form method="post" action="samochodtankuj.php"><input type="hidden" name="id" value='.$car_ID.' />&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>';
} else {
    echo 'Błąd spróbuj ponownie później<a href="samochod.php">POWRÓT</a><br />';
}

?>

<?php
include('template/footer.php');
?>