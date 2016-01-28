<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['car_ID'];
if(isset($_POST['tankowanie_ID'])AND $_POST['tankowanie_ID']!="") {
    $tankowanie_ID = $_POST['tankowanie_ID'];

    if (unlink('pliki/potwierdzeniaplatnosci/paliwo/' . $car_ID . '_' . $tankowanie_ID . '.pdf')) {
        echo 'Operacja zakończona pomyślnie.<br />';
    } else {
        echo 'Błąd. Spróbuj ponownie później.<br />';
    }
}
if(isset($_POST['serwis_ID'])AND $_POST['serwis_ID']!="") {
    $serwis_ID = $_POST['serwis_ID'];

    if (unlink('pliki/potwierdzeniaplatnosci/serwis/' . $car_ID . '_' . $serwis_ID . '.pdf')) {
        echo 'Operacja zakończona pomyślnie.<br />';
    } else {
        echo 'Błąd. Spróbuj ponownie później.<br />';
    }
}
echo '<a href="samochod.php"><button type="button">&nbsp;POWRÓT&nbsp;</button></a>&nbsp;';
?>

<?php
include('template/footer.php');
?>