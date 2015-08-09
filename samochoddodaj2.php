<?php
include('template/header.php');
?>

<?php
$wl=$_POST['wl'];
$marka=$_POST['marka'];
$model=$_POST['model'];
$rocznik=$_POST['rocznik'];
$przebieg=$_POST['przebieg'];
$vin=$_POST['vin'];
$nrrej=$_POST['nrrej'];

$zapytanie = "INSERT INTO cars VALUES ('', '$marka', '$model', '$rocznik', '$przebieg', '$wl', '$vin', '$nrrej', '0')";
$wynik = mysql_query($zapytanie);

if ($wynik) {
    echo 'Wpis dodany prawidłowo<br />';
    echo '<a href="samochod.php">POWRÓT</a><br />';
} else {
    if(mysql_errno()==1062)
        echo 'Podany VIN lub nr rejestracyjny został już użyty!<br />';
    echo 'Błąd spróbuj ponownie później <a href="samochod.php">POWRÓT</a><br />';
}

?>
<?php
include('template/footer.php');
?>