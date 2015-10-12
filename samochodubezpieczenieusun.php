<?php
include('template/header.php');
?>
<?php
$car_ID=$_POST['car_ID'];
$ubezpieczenie_ID = $_POST['ubezpieczenie_ID'];
if($_POST['rodzaj']=="polisa") {
    if (unlink('pliki/polisy/komunikacyjne/' . $car_ID . '_' . $ubezpieczenie_ID . '.pdf')) {
        echo 'Operacja zakończona pomyślnie.<br />';
    } else {
        echo 'Błąd. Spróbuj ponownie później.<br />';
    }
}
else if($_POST['rodzaj']=="potwierdzenie") {
    if (unlink('pliki/potwierdzeniaplatnosci/ubezpieczenie/' . $car_ID . '_' . $ubezpieczenie_ID . '.pdf')) {
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