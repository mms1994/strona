<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];
$nazwa=htmlspecialchars(mysql_real_escape_string($_POST['nazwa']));
$miejscowosc=htmlspecialchars(mysql_real_escape_string($_POST['miejscowosc']));
$ulica=htmlspecialchars(mysql_real_escape_string($_POST['ulica']));
$numer=htmlspecialchars(mysql_real_escape_string($_POST['numer']));
$zrob=true;
$blad='';
if(!preg_match('[a-zA-Z_]', $nazwa)) $valid=false;
if(!preg_match('[a-zA-Z_0-9\.]', $ulica)) $valid=false;
if(!preg_match('[a-zA-Z_]', $miejscowosc)) $valid=false;
if(!preg_match('[a-zA-Z_0-9]', $numer)) $valid=false;
if($zrob) {
    $zapytanie = "INSERT INTO serwis VALUES ('', '$nazwa', '$miejscowosc', '$ulica', '$numer')";
    $wynik = mysql_query($zapytanie);

    if ($wynik) {
        echo 'Wpis dodany prawidłowo<br />';
        echo '<form method="post" action="samochodserwisuj.php"><input type="hidden" name="id" value=' . $car_ID . ' />&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>';
    } else {
        echo 'Błąd spróbuj ponownie później<a href="samochod.php">POWRÓT</a><br />';
    }
}
else {
    echo "Błąd:".$blad;
    echo '<a href="samochod.php">POWRÓT</a><br />';
}
?>

<?php
include('template/footer.php');
?>