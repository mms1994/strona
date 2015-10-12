<?php
include('template/header.php');
?>

<?php
$car_ID=$_POST['id'];
?>
    <table border="1">
        <tr>
            <td>&nbsp;Rodzaj&nbsp;</td>
            <td>&nbsp;Początek okresu ubezpieczenia&nbsp;</td>
            <td>&nbsp;Koniec okresu ubezpieczenia&nbsp;</td>
            <td>&nbsp;Koszt&nbsp;</td>
            <td>&nbsp;Uwagi&nbsp;</td>
            <td>&nbsp;Nr polisy&nbsp;</td>
            <td>&nbsp;Polisa&nbsp;</td>
            <td>&nbsp;Potwierdzenie płatności&nbsp;</td>
        </tr>

        <?php
        $zapytanie = mysql_query("SELECT * FROM assurance WHERE car_id='$car_ID'");
        while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
            $Data_start=$row['data_start'];
            $Data_koniec=$row['data_koniec'];
            $Rodzaj=$row['rodzaj'];
            $Koszt=$row['koszt'];
            $Uwagi=$row['uwagi'];
            $Nr_polisy=$row['polisa'];
            $ubezpieczenie_ID=$row['id'];
            $pk="pliki/potwierdzeniaplatnosci/ubezpieczenie/".$car_ID."_".$ubezpieczenie_ID.".pdf";
            $pp="pliki/polisy/komunikacyjne/".$car_ID."_".$ubezpieczenie_ID.".pdf";
            ?>
            <tr>
                <td>&nbsp;<?php echo $Rodzaj; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Data_start; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Data_koniec; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Koszt; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Uwagi; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Nr_polisy; ?>&nbsp;</td>
                <td>&nbsp;<?php if(file_exists($pp))
                    {
                        echo '<a target="_blank" href="'.$pp.'"><button type="button">&nbsp;PODGLĄD&nbsp;</button></a>&nbsp;';
                        ?>
                        <form method="post" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');" action="samochodubezpieczenieusun.php"><input type="hidden" name="rodzaj" value="polisa" /><input type="hidden" name="ubezpieczenie_ID" value="<?php echo $ubezpieczenie_ID ?>"/><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="submit" value="Usuń"/></form> <?php
                    }
                    else {
                        ?>
                        <form method="post" action="samochodubezpieczenieplik.php" enctype="multipart/form-data"><input type="hidden" name="rodzaj" value="polisa" /><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="hidden" name="ubezpieczenie_ID" value="<?php echo $ubezpieczenie_ID ?>"/><input type="file" name="plik" accept="application/pdf" required/><input type="submit" value="Wyślij"/> </form>
                        &nbsp;
                        <?php
                    }
                    ?></td>
                <td>&nbsp;<?php if(file_exists($pk))
                    {
                        echo '<a target="_blank" href="'.$pk.'"><button type="button">&nbsp;PODGLĄD&nbsp;</button></a>&nbsp;';
                        ?>
                        <form method="post" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');" action="samochodubezpieczenieusun.php"><input type="hidden" name="rodzaj" value="potwierdzenie" /><input type="hidden" name="ubepieczenie_ID" value="<?php echo $ubezpieczenie_ID ?>"/><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="submit" value="Usuń"/></form> <?php
                    }
                    else {
                        ?>
                        <form method="post" action="samochodubezpieczenieplik.php" enctype="multipart/form-data"><input type="hidden" name="rodzaj" value="potwierdzenie" /><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="hidden" name="ubezpieczenie_ID" value="<?php echo $ubezpieczenie_ID ?>"/><input type="file" name="plik" accept="application/pdf" required/><input type="submit" value="Wyślij"/> </form>
                        &nbsp;
                        <?php
                    }
                    ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    Dopuszczalne rozszerzenie plików z paragonem/fakturą/polisą to PDF!
<?php
include('template/footer.php');
?>