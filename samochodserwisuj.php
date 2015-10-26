<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];
$selecty='';
$zapytanie = mysql_query("SELECT * FROM serwis");
while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
    $id=$row['serwis_id'];
    $nazwa=$row['nazwa'];
    $numer=$row['numer'];
    $ulica=$row['ulica'];
    $miejscowosc=$row['miejscowosc'];
    $selecty.='<option value="'.$id.'">'.$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer.'</option>';
}

echo ('Wybierz stację serwisową:<br />');
echo ('<form method="post" action="samochodserwisuj2.php"><input type="hidden" name="car_ID" value='.$car_ID.' /><select name="stacja_ID"> '.$selecty.' </select>&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>');
echo ('Brak stacji serwisowej?<form method="post" action="serwisdodaj.php"><input type="hidden" name="car_ID" value='.$car_ID.' />&nbsp;<input type="submit" value="Dodaj"/>&nbsp;</form>');


?>

<?php
include('template/footer.php');
?>