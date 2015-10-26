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

$zapytanie = "INSERT INTO ubezpieczenia VALUES ('', '$car_ID', '$rodzaj', '$data_start', '$data_koniec', '$koszt', '$uwagi', '$polisa')";
$wynik = mysql_query($zapytanie);

if ($wynik) {
    echo 'Wpis dodany prawidłowo<br />';
    echo '<a href="samochod.php">POWRÓT</a><br />';
} else {
    echo 'Błąd spróbuj ponownie później <a href="samochod.php">POWRÓT</a><br />';
}

?>
<?php
include('template/footer.php');
?>