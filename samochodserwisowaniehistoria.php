<?php
include('template/header.php');
?>

<?php

$car_ID=$_POST['id'];

?>
    <table border="1">
        <tr>
            <td>&nbsp;Data oddania&nbsp;</td>
            <td>&nbsp;Przebieg przy oddaniu&nbsp;</td>
            <td>&nbsp;Data odbioru&nbsp;</td>
            <td>&nbsp;Przebieg przy odbiorze&nbsp;</td>
            <td>&nbsp;Koszt&nbsp;</td>
            <td>&nbsp;Zakres&nbsp;</td>
            <td>&nbsp;Serwis&nbsp;</td>
            <td>&nbsp;Potwierdzenie płatności&nbsp;</td>
        </tr>

        <?php
        $zapytanie = mysql_query("SELECT * FROM serwisowanie WHERE car_id='$car_ID'");
        while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
            $Data_start=$row['data_start'];
            $Przebieg_start=$row['przebieg_koniec'];
            $Data_koniec=$row['data_start'];
            $Przebieg_koniec=$row['przebieg_koniec'];
            $Koszt=$row['koszt'];
            $Serwis_id=$row['serwis_ID'];
            $Zakres=$row['zakres'];
            $zapytanie2 = mysql_query("SELECT * FROM serwis WHERE serwis_id='$Serwis_id'");
            $row2 = mysql_fetch_array($zapytanie2, MYSQL_ASSOC);
            $nazwa=$row2['nazwa'];
            $miejscowosc=$row2['miejscowosc'];
            $ulica=$row2['ulica'];
            $numer=$row2['numer'];
            $Serwis=$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer;
            $serwis_ID=$row['serwis_id'];
            $pk="pliki/potwierdzeniaplatnosci/serwis/".$car_ID."_".$serwis_ID.".pdf";
            ?>
            <tr>
                <td>&nbsp;<?php echo $Data_start; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Przebieg_start; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Data_koniec; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Przebieg_koniec; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Koszt; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Zakres; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Serwis; ?>&nbsp;</td>
                <td>&nbsp;<?php if(file_exists($pk))
                    {
                        echo '<a target="_blank" href="'.$pk.'"><button type="button">&nbsp;PODGLĄD&nbsp;</button></a>&nbsp;';
                        ?>
                        <form method="post" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');" action="samochodparagonusun.php"><input type="hidden" name="serwis_ID" value="<?php echo $serwis_ID ?>"/><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="submit" value="Usuń"/></form> <?php
                    }
                    else {
                        ?>
                        <form method="post" action="samochodparagon.php" enctype="multipart/form-data"><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="hidden" name="serwis_ID" value="<?php echo $serwis_ID ?>"/><input type="file" name="plik" accept="application/pdf" required/><input type="submit" value="Wyślij"/> </form>
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