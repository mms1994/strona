<?php
include('template/header.php');
?>

<?php
// wczytanie zmiennych z POSTa
$car_ID=$_POST['car_ID'];
$stacja_ID=$_POST['stacja_ID'];
$data_start=htmlspecialchars(mysql_real_escape_string($_POST['data_start']));
$data_koniec=htmlspecialchars(mysql_real_escape_string($_POST['data_koniec']));
$przebieg_start=htmlspecialchars(mysql_real_escape_string($_POST['przebieg_start']));
$przebieg_koniec=htmlspecialchars(mysql_real_escape_string($_POST['przebieg_koniec']));
$koszt=htmlspecialchars(mysql_real_escape_string($_POST['koszt']));
$zakres=htmlspecialchars(mysql_real_escape_string($_POST['zakres']));
$zrob=true;
// tu dodać sprawdzanie czy dane wprowadzone prawidłowo

// jeśli wszystko dobrze wykonanie zapytań
if($zrob) {
    $zapytanie = "INSERT INTO service VALUES ('', '$car_ID', '$data_start', '$przebieg_start', '$stacja_ID', '$data_koniec', '$przebieg_koniec', '$koszt', '$zakres')";
    $wynik = mysql_query($zapytanie);
    if ($wynik) {
        echo 'Wpis dodany prawidłowo<br />';
        echo '<a href="samochod.php">POWRÓT</a><br />';
    } else {
        echo 'Błąd spróbuj ponownie później<a href="samochod.php">POWRÓT</a><br />';
    }
}
// jeśli błąd wyświetlenie co nie tak
else {
    echo $blad;
    echo '<a href="samochod.php">POWRÓT</a><br />';
}
?>

<?php
include('template/footer.php');
?>