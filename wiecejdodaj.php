<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['car_ID'];
$nazwa=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['nazwa']))));
$opis=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['opis']))));
$zrob=true;
$blad="";
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $nazwa)) {$zrob=false; $blad.="Zły format nazwy";}
if(!preg_match('/^[a-zA-Z0-9\.\-,!?\@_\(\)]+$/D', $opis)) {$zrob=false; $blad.="Zły format opisu";}

if($zrob) {

    $wynik = mysqli_query($mysqli, "CALL autocechy('$car_ID', '$nazwa', '$opis')");
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