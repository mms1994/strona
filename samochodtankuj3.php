<?php
include('template/header.php');
?>

<?php
// wczytanie zmiennych z POSTa
$car_ID=$_POST['car_ID'];
$stacja_ID=$_POST['stacja_ID'];
$cena=$_POST['cena'];
$koszt=$_POST['koszt'];
$ilosc=$_POST['ilosc'];
$przebieg=$_POST['przebieg'];
$dystans=$_POST['dystans'];
$data=$_POST['data'];
$zrob=true;
$blad='';
// sprawdzenie czy pola są odpowiednio uzupełnione, ewentualne uzupełnienie wybranych pól
if($przebieg!='' || $dystans!='') {
    if($przebieg==''){
        $zapytanie = mysql_query("SELECT * FROM cars WHERE id='$car_ID'");
        $row = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
        $przebieg=$dystans+$row['przebieg'];
    }
    if($dystans==''){
        $zapytanie = mysql_query("SELECT * FROM cars WHERE id='$car_ID'");
        $row = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
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
    $zapytanie = "INSERT INTO fuel VALUES ('', '$car_ID', '$data', '$przebieg', '$stacja_ID', '$ilosc', '$koszt', '$dystans', '$cena')";
    $wynik = mysql_query($zapytanie);
    $zapytanie2="UPDATE cars SET przebieg='$przebieg' WHERE id='$car_ID'";
    $wynik2 = mysql_query($zapytanie2);
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