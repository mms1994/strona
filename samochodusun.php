<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];

$zapytanie="UPDATE cars SET status='1' WHERE id='$car_ID'";
$wynik = mysql_query($zapytanie);

if ($wynik) {
    echo 'Usunięcie dokonane prawidłowo.<br />';
    echo '<a href="samochod.php">POWRÓT</a><br />';
} else {
    echo 'Błąd spróbuj ponownie później<a href="samochod.php">POWRÓT</a><br />';
}

?>

<?php
include('template/footer.php');
?>