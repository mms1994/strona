<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['car_ID'];
$rodzaj=htmlspecialchars(mysql_real_escape_string($_POST['rodzaj']));
$data_start=htmlspecialchars(mysql_real_escape_string($_POST['data_start']));
$data_koniec=htmlspecialchars(mysql_real_escape_string($_POST['data_koniec']));
$koszt=htmlspecialchars(mysql_real_escape_string($_POST['koszt']));
$uwagi=htmlspecialchars(mysql_real_escape_string($_POST['uwagi']));
$polisa=htmlspecialchars(mysql_real_escape_string($_POST['nr_polisy']));
$zrob=true;
$blad="";
if(!preg_match('/^[2][0-9][0-9][0-9]-([0][0-9]|[1][0-2])-[0-3][0-9]$/D', $data_start)) {$zrob=false; $blad.="Zły format daty początku";}
if(!preg_match('/^[2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/D', $data_koniec)) {$zrob=false; $blad.="Zły format daty końca";}
if(!preg_match('/^[0-9]+\.[0-9]{1,2}$/D', $koszt)) {$zrob=false; $blad.="Zły format kosztu";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $polisa)) {$zrob=false; $blad.="Zły format nr polisy";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $uwagi)) {$zrob=false; $blad.="Zły format uwag";}

if($zrób) {

    $zapytanie = "INSERT INTO ubezpieczenia VALUES ('', '$car_ID', '$rodzaj', '$data_start', '$data_koniec', '$koszt', '$uwagi', '$polisa')";
    $wynik = mysql_query($zapytanie);

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