<?php
include('template/header.php');
?>

<?php


$wl=$_POST['wl'];
$marka=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['marka']))));
$model=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['model']))));
$rocznik=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['rocznik']))));
$przebieg=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['przebieg']))));
$vin=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['vin']))));
$nrrej=strip_tags(stripslashes(htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['nrrej']))));

$valid=true;
if(!preg_match('/^[A-Z][a-zA-Z_]{1,}$/D', $marka)) {
    $valid=false;
}
if(!preg_match('/^[A-Z][a-zA-Z_]{1,}$/D', $model)) {
    $valid=false;
}
if(!preg_match('/^[1-2][0-9]{3}$/D', $rocznik)) {
    $valid=false;
}
if(!preg_match('/^[1-9][0-9]{0,}$/D', $przebieg)) {
    $valid=false;
}
if(!validate_vin($vin)) {
    //$valid=false;
}
if(strlen($vin)!=17) {
    $valid=false;
}
if(!preg_match('/^[BCDEFGKLNOPRSTWZ][A-Z]{1,2}[A-Z0-9]{4,5}$/D', $nrrej)) {
    $valid=false;
}
if(strlen($nrrej)!=7) {
    $valid=false;
}
if($valid) {
    $zapytanie = "INSERT INTO samochody VALUES ('', '$marka', '$model', '$rocznik', '$przebieg', '$wl', '$vin', '$nrrej', '0')";
    $wynik = mysqli_query($mysqli, $zapytanie);

    if ($wynik) {
        echo 'Wpis dodany prawidłowo<br />';
        echo '<a href="samochod.php">POWRÓT</a><br />';
    } else {
        if (mysql_errno() == 1062)
            echo 'Podany VIN lub nr rejestracyjny został już użyty!<br />';
        echo 'Błąd spróbuj ponownie później <a href="samochod.php">POWRÓT</a><br />';
    }
}
else {
    echo "Formularz został błędnie wypełniony!<br />";
    echo 'Spróbuj ponownie <a href="samochod.php">POWRÓT</a><br />';
}
?>
<?php
include('template/footer.php');
?>