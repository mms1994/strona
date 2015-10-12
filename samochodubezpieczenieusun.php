<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['car_ID'];
if($_POST['rodzaj']=="polisa") {
    $ubezpieczenie_ID = $_POST['ubezpieczenie_ID'];

    if (unlink('pliki/potwierdzeniaplatnosci/paliwo/' . $car_ID . '_' . $ubezpieczenie_ID . '.pdf')) {
        echo 'Operacja zakończona pomyślnie.<br />';
    } else {
        echo 'Błąd. Spróbuj ponownie później.<br />';
    }
}
if($_POST['rodzaj']=="potwierdzenie") {
    $ubezpieczenie_ID = $_POST['ubezpieczenie_ID'];

    if (unlink('pliki/potwierdzeniaplatnosci/serwis/' . $car_ID . '_' . $ubezpieczenie_ID . '.pdf')) {
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