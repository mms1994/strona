<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['car_ID'];
$rodzaj=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['rodzaj']))));
$data_start=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['data_start']))));
$data_koniec=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['data_koniec']))));
$koszt=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['koszt']))));
$uwagi=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['uwagi']))));
$polisa=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['nr_polisy']))));
$zrob=true;
$blad="";
if(!preg_match('/^[2][0-9][0-9][0-9]-([0][0-9]|[1][0-2])-[0-3][0-9]$/D', $data_start)) {$zrob=false; $blad.="Zły format daty początku";}
if(!preg_match('/^[2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/D', $data_koniec)) {$zrob=false; $blad.="Zły format daty końca";}
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $koszt)) {$zrob=false; $blad.="Zły format kosztu";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $polisa)) {$zrob=false; $blad.="Zły format nr polisy";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $uwagi)) {$zrob=false; $blad.="Zły format uwag";}

if($zrob) {

    $zapytanie = "INSERT INTO ubezpieczenia VALUES ('', '$car_ID', '$rodzaj', '$data_start', '$data_koniec', '$koszt', '$uwagi', '$polisa')";
    $wynik = mysqli_query($mysqli, $zapytanie);

    if ($wynik) {
        echo 'Wpis dodany prawidłowo<br />';
        echo '<a href="samochod.php">POWRÓT</a><br />';
    } else {
        echo 'Błąd spróbuj ponownie później <a href="samochod.php">POWRÓT</a><br />';
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