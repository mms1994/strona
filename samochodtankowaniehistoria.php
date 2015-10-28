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
            <td>&nbsp;Potwierdzenie płatności&nbsp;</td>
        </tr>

    <?php
    $zapytanie = mysqli_query($mysqli, "SELECT * FROM tankowanie WHERE car_id='$car_ID'");
    while ($row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC)) {
        $Data=$row['data'];
        $Przebieg=$row['przebieg'];
        $Ilosc=$row['ilosc'];
        $Koszt=$row['koszt'];
        $Dystans=$row['dystans'];
        $Cena=$row['cena'];
        $Stacja_id=$row['stacja_id'];
        $zapytanie2 = mysqli_query($mysqli, "SELECT * FROM stacja WHERE stacja_id='$Stacja_id'");
        $row2 = mysqli_fetch_array($zapytanie2, MYSQLI_ASSOC);
        $nazwa=$row2['nazwa'];
        $miejscowosc=$row2['miejscowosc'];
        $ulica=$row2['ulica'];
        $numer=$row2['numer'];
        $Stacja=$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer;
        $tankowanie_ID=$row['tankowanie_id'];
        $pk="pliki/potwierdzeniaplatnosci/paliwo/".$car_ID."_".$tankowanie_ID.".pdf";
        ?>
        <tr>
            <td>&nbsp;<?php echo $Data; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Przebieg; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Ilosc; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Koszt; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Dystans; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Cena; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Stacja; ?>&nbsp;</td>
            <td>&nbsp;<?php if(file_exists($pk))
                {
                    echo '<a target="_blank" href="'.$pk.'"><button type="button">&nbsp;PODGLĄD&nbsp;</button></a>&nbsp;';
                    ?>
                    <form method="post" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');" action="samochodparagonusun.php"><input type="hidden" name="tankowanie_ID" value="<?php echo $tankowanie_ID ?>"/><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="submit" value="Usuń"/></form> <?php
                }
                else {
                    ?>
                    <form method="post" action="samochodparagon.php" enctype="multipart/form-data"><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="hidden" name="tankowanie_ID" value="<?php echo $tankowanie_ID ?>"/><input type="file" name="plik" accept="application/pdf" required/><input type="submit" value="Wyślij"/> </form>
                    &nbsp;
                    <?php
                }
                    ?></td>
        </tr>
        <?php
    }
    ?>
</table>
Dopuszczalne rozszerzenie plików z paragonem/fakturą to PDF!
<?php
include('template/footer.php');
?>