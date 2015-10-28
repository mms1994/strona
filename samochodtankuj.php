<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];
$selecty='';
$zapytanie = mysqli_query($mysqli, "SELECT * FROM stacja");
while ($row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC)) {
    $id=$row['stacja_id'];
    $nazwa=$row['nazwa'];
    $numer=$row['numer'];
    $ulica=$row['ulica'];
    $miejscowosc=$row['miejscowosc'];
    $selecty.='<option value="'.$id.'">'.$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer.'</option>';
}

echo ('Wybierz stację paliw:<br />');
echo ('<form method="post" action="samochodtankuj2.php"><input type="hidden" name="car_ID" value='.$car_ID.' /><select name="stacja_ID"> '.$selecty.' </select>&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>');
echo ('Brak stacji paliw?<form method="post" action="stacjadodaj.php"><input type="hidden" name="car_ID" value='.$car_ID.' />&nbsp;<input type="submit" value="Dodaj"/>&nbsp;</form>');


?>

<?php
include('template/footer.php');
?>