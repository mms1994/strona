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
$blad="";
// tu dodać sprawdzanie czy dane wprowadzone prawidłowo
if($data_start==""){
    $blad.="Pole data oddania do serwisu nie może być puste!<br />";
    $zrob=false;
}
if($data_koniec==""){
    $blad.="Pole data odbioru z serwisu nie może być puste!<br />";
    $zrob=false;
}
if($przebieg_start==""){
    $blad.="Pole przebieg przy oddaniu do serwisu nie może być puste!<br />";
    $zrob=false;
}
if($przebieg_koniec==""){
    $blad.="Pole przebiegy przy odbiorze z serwisu nie może być puste!<br />";
    $zrob=false;
}
if($koszt==""){
    $blad.="Pole koszt nie może być puste!<br />";
    $zrob=false;
}
if($zakres==""){
    $blad.="Pole zakres napraw nie może być puste!<br />";
    $zrob=false;
}
if(!preg_match('/^[2][0-9][0-9][0-9]-([0][0-9]|[1][0-2])-[0-3][0-9]$/D', $data_start)) {$zrob=false; $blad.="Zły format daty oddania";}
if(!preg_match('/^[2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/D', $data_koniec)) {$zrob=false; $blad.="Zły format daty odebrania";}
if(!preg_match('/^[1-9][0-9]{0,19}$/D', $przebieg_start)) {$zrob=false; $blad.="Zły format przebiegu przy oddaniu";}
if(!preg_match('/^[1-9][0-9]{0,19}$/D', $przebieg_koniec)) {$zrob=false; $blad.="Zły format przebiegu przy odebraniu";}
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $koszt)) {$zrob=false; $blad.="Zły format kosztu";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_]+$/D', $zakres)) {$zrob=false; $blad.="Zły format zakresu";}
// jeśli wszystko dobrze wykonanie zapytań
if($zrob) {
    $zapytanie = "INSERT INTO serwisowanie VALUES ('', '$car_ID', '$data_start', '$przebieg_start', '$stacja_ID', '$data_koniec', '$przebieg_koniec', '$koszt', '$zakres')";
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
    echo "Błąd:".$blad;
    echo '<a href="samochod.php">POWRÓT</a><br />';
}
?>

<?php
include('template/footer.php');
?>