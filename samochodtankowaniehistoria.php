<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];

?>
<table border="1">
        <tr>
            <td>&nbsp;Data&nbsp;</td>
            <td>&nbsp;Przebieg&nbsp;</td>
            <td>&nbsp;Ilość&nbsp;</td>
            <td>&nbsp;Koszt&nbsp;</td>
            <td>&nbsp;Dystans&nbsp;</td>
            <td>&nbsp;Cena za litr&nbsp;</td>
            <td>&nbsp;Stacja paliw&nbsp;</td>
        </tr>

    <?php
    $zapytanie = mysql_query("SELECT * FROM fuel WHERE car_id='$car_ID'");
    while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
        $Data=$row['data'];
        $Przebieg=$row['przebieg'];
        $Ilosc=$row['ilosc'];
        $Koszt=$row['koszt'];
        $Dystans=$row['dystans'];
        $Cena=$row['cena'];
        $Stacja_id=$row['stacja_id'];
        $zapytanie2 = mysql_query("SELECT * FROM stacja WHERE id='$Stacja_id'");
        $row2 = mysql_fetch_array($zapytanie2, MYSQL_ASSOC);
        $nazwa=$row2['nazwa'];
        $miejscowosc=$row2['miejscowosc'];
        $ulica=$row2['ulica'];
        $numer=$row2['numer'];
        $Stacja=$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer;
        ?>
        <tr>
            <td>&nbsp;<?php echo $Data; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Przebieg; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Ilosc; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Koszt; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Dystans; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Cena; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Stacja; ?>&nbsp;</td>
        </tr>
        <?php
    }
    ?>
</table>

<?php
include('template/footer.php');
?>