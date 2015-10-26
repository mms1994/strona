<?php
include('template/header.php');
?>
    <script language="JavaScript">
        var blad=0;
        function polisaCheck() {
            document.getElementById('bladpolisa').innerHTML="";
            if(!document.formularz.nr_polisy.value) {
                blad++;
                document.getElementById('bladpolisa').innerHTML="Uzupełnij pole nr polisy<br />";
            }
        }
        function uwagiCheck() {
            document.getElementById('bladuwagi').innerHTML="";
            if(!document.formularz.uwagi.value) {
                blad++;
                document.getElementById('bladuwagi').innerHTML="Uzupełnij pole uwagi<br />";
            }
        }
        function kosztCheck() {
            document.getElementById('bladkoszt').innerHTML=="";
            if(!document.formularz.koszt.value) {
                blad++;
                document.getElementById('bladkoszt').innerHTML="Uzupełnij pole koszt<br />";
            }
        }
        function check() {
            blad=0;
            polisaCheck();
            uwagiCheck();
            kosztCheck();
            if(blad==0)
                return true;
            else
                return false;
        }
    </script>
<?php
$car_ID=$_POST['id'];
?>
    <form method="post" name="formularz" action="samochodubezpieczeniedodaj.php"><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/>
        <b>DODAJ NOWE UBEZPIECZENIE</b><br />
        <b>Rodzaj</b>:<br />
        <select name="rodzaj"><option value="OC">OC</option><option value="AC">AC</option><option value="NNW">NNW</option><option value="Assistance">Assistance</option><option value="inne">inne</option></select><br />
        W przypadku wyboru "inne" w polu uwagi opisz ubezpieczenie!<br />
        <b>Nr polisy</b>:<br /><input type="text" name="nr_polisy" id="nr_polisy" onblur="polisaCheck()" placeholder="Wpisz nr polisy" required /><br />
        <div id="bladpolisa" class="blad"></div>
        <b>Początek okresu ubezpieczenia</b>:<br /><input type="date" name="data_start" id="data_start" required placeholder="YYYY-MM-DD" pattern="^((?:20)\d\d)[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$" /><br />
        <b>Koniec okresu ubezpieczenia</b>:<br /><input type="date" name="data_koniec" id="data_koniec" required placeholder="YYYY-MM-DD" pattern="^((?:20)\d\d)[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$" /><br />
        <b>Koszt ubepiczenia</b>:<br /><input type="number" name="koszt" onblur="kosztCheck()" placeholder="Wpisz koszt ubezpieczenia" required /><br />
        <div id="bladkoszt" class="blad"></div>
        <b>Uwagi</b>:(wielkość pola możesz sobie zmieniać w zależności od potrzeb)<br /><textarea name="uwagi" onblur="uwagiCheck()" placeholder="Wpisz dodatkowe uwagi lub informacje" required ></textarea><br />
        <div id="bladuwagi" class="blad"></div>
        <input type="submit" value="Dodaj"/> </form>
<br /><br />
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
        $zapytanie = mysql_query("SELECT * FROM ubezpieczenia WHERE car_id='$car_ID'");
        while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
            $Data_start=$row['data_start'];
            $Data_koniec=$row['data_koniec'];
            $Rodzaj=$row['rodzaj'];
            $Koszt=$row['koszt'];
            $Uwagi=$row['uwagi'];
            $Nr_polisy=$row['polisa'];
            $ubezpieczenie_ID=$row['ubezpieczenie_id'];
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
                        <form method="post" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');" action="samochodubezpieczenieusun.php"><input type="hidden" name="rodzaj" value="potwierdzenie" /><input type="hidden" name="ubezpieczenie_ID" value="<?php echo $ubezpieczenie_ID ?>"/><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/><input type="submit" value="Usuń"/></form> <?php
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