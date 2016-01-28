<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];
$nazwa=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['nazwa']))));
$miejscowosc=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['miejscowosc']))));
$ulica=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['ulica']))));
$numer=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['numer']))));
$zrob=true;
$blad='';
if(!preg_match('[a-zA-Z_]', $nazwa)) $valid=false;
if(!preg_match('[a-zA-Z_0-9\.]', $ulica)) $valid=false;
if(!preg_match('[a-zA-Z_]', $miejscowosc)) $valid=false;
if(!preg_match('[a-zA-Z_0-9]', $numer)) $valid=false;
if($zrob) {
$zapytanie = "INSERT INTO stacja VALUES ('', '$nazwa', '$miejscowosc', '$ulica', '$numer')";
$wynik = mysqli_query($mysqli, $zapytanie);

if ($wynik) {
    echo 'Wpis dodany prawidłowo<br />';
    echo '<form method="post" action="samochodtankuj.php"><input type="hidden" name="id" value='.$car_ID.' />&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>';
} else {
    echo 'Błąd spróbuj ponownie później<a href="samochod.php">POWRÓT</a><br />';
}
}
else {
    echo "Błąd: ".$blad;
    echo '<a href="samochod.php">POWRÓT</a><br />';
}
?>

<?php
include('template/footer.php');
?>