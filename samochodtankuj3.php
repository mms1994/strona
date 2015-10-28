<?php
include('template/header.php');
?>

<?php
// wczytanie zmiennych z POSTa
$car_ID=$_POST['car_ID'];
$stacja_ID=$_POST['stacja_ID'];
$cena=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['cena']));
$koszt=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['koszt']));
$ilosc=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['ilosc']));
$przebieg=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['przebieg']));
$dystans=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['dystans']));
$data=htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['data']));
$zrob=true;
$blad='';
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $cena)) {$zrob=false; $blad.="Zły format ceny za litr";}
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $koszt)) {$zrob=false; $blad.="Zły format kosztu";}
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $ilosc)) {$zrob=false; $blad.="Zły format ilości";}
if(!preg_match('/^[1-9][0-9]{0,19}$/D', $przebieg)) {$zrob=false; $blad.="Zły format przebiegu";}
if(!preg_match('/^[0-9]{0,19}$/D', $dystans)) {$zrob=false; $blad.="Zły format dystansu";}
if(!preg_match('/^[2][0-9][0-9][0-9]-([0][0-9]|[1][0-2])-[0-3][0-9]$/D', $data)) {$zrob=false; $blad.="Zły format daty";}
// sprawdzenie czy pola są odpowiednio uzupełnione, ewentualne uzupełnienie wybranych pól
if($przebieg!='' || $dystans!='') {
    if($przebieg==''){
        $zapytanie = mysqli_query($mysqli, "SELECT * FROM samochody WHERE car_id='$car_ID'");
        $row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC);
        $przebieg=$dystans+$row['przebieg'];
    }
    if($dystans==''){
        $zapytanie = mysqli_query($mysqli, "SELECT * FROM samochody WHERE car_id='$car_ID'");
        $row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC);
        $dystans=$przebieg-$row['przebieg'];
    }
}
else {
    $zrob=false;
    $blad.='Jedno z pól przebieg oraz dystans musi być uzupełnione!<br/>';
}
if(($cena!='' && $koszt!='') || ($cena!='' && $ilosc!='') || ($koszt!='' && $ilosc!='')) {
    if($cena=='') {
        $cena=$koszt/$ilosc;
    }
    if($koszt=='') {
        $koszt=$cena*$ilosc;
    }
    if($ilosc=='') {
        $ilosc=$koszt/$cena;
    }
}
else {
    $zrob=false;
    $blad.='Dwa z pól cena, koszt oraz ilość muszą być uzupełnione!<br />';
}
if($data=='') {
    $zrob = false;
    $blad.='Pole data nie może być puste!<br />';
}
// jeśli wszystko dobrze wykonanie zapytań
if($zrob) {
    $zapytanie = "INSERT INTO tankowanie VALUES ('', '$car_ID', '$data', '$przebieg', '$stacja_ID', '$ilosc', '$koszt', '$dystans', '$cena')";
    $wynik = mysqli_query($mysqli, $zapytanie);
    $zapytanie2="UPDATE samochody SET przebieg='$przebieg' WHERE car_id='$car_ID'";
    $wynik2 = mysqli_query($mysqli, $zapytanie2);
    if ($wynik&&$wynik2) {
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