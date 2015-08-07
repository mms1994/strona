<?php
include('template/header.php');
?>

<?php
$tankowanie_ID=$_POST['tankowanie_ID'];
$car_ID=$_POST['car_ID'];
if(unlink('pliki/potwierdzeniaplatnosci/paliwo/'.$car_ID.'_'.$tankowanie_ID.'.pdf'))
{
    echo 'Operacja zakończona pomyślnie.<br />';
}
else
{
    echo 'Błąd. Spróbuj ponownie później.<br />';
}
echo '<a href="samochod.php"><button type="button">&nbsp;POWRÓT&nbsp;</button></a>&nbsp;';
?>

<?php
include('template/footer.php');
?>