<?php
include('template/header.php');
?>

<?php
if (user::isLogged()) {
    // Widok dla użytkownika zalogowanego

    // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
    $user = user::getData('', '');
    $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT login FROM uzytkownicy WHERE uzytkownik_id='$admin_id' LIMIT 1;"));
    $log=$ide['login'];
    if ($user['login']==$log) {
        ?><center><?php
        //lista pracowników
        ?>
        <div id="pracownicy_pokaz" style="display: ;" >
            <button onclick="div_show('pracownicy'), div_hide('pracownicy_pokaz')">POKAŻ PRACOWNIKÓW</button>
        </div>
        <div id="pracownicy" style="display: none;">
        <button onclick="div_hide('pracownicy'), div_show('pracownicy_pokaz')">UKRYJ PRACOWNIKÓW</button>
        <?php
        //lista samochodów
        ?>
        </div>
        <div id="samochody_pokaz" style="display: ;" >
            <button onclick="div_show('samochody'), div_hide('samochody_pokaz')">POKAŻ SAMOCHODY</button>
        </div>
        <div id="samochody" style="display: none;">
        <button onclick="div_hide('samochody'), div_show('samochody_pokaz')">UKRYJ SAMOCHODY</button>
        <?php
        //lista stacji
        ?>
        </div>
        <div id="stacje_pokaz" style="display: ;" >
            <button onclick="div_show('stacje'), div_hide('stacje_pokaz')">POKAŻ STACJE</button>
        </div>
        <div id="stacje" style="display: none;">
        <button onclick="div_hide('stacje'), div_show('stacje_pokaz')">UKRYJ STACJE</button>
        <?php
        //lista serwisów
        ?>
        </div>
        <div id="serwisy_pokaz" style="display: ;" >
            <button onclick="div_show('serwisy'), div_hide('serwisy_pokaz')">POKAŻ SERWISY</button>
        </div>
        <div id="serwisy" style="display: none;">
        <button onclick="div_hide('serwisy'), div_show('serwisy_pokaz')">UKRYJ SERWISY</button>
        <?php
        //lista tankowań
        ?>
        </div>
        <div id="tankowania_pokaz" style="display: ;" >
            <button onclick="div_show('tankowania'), div_hide('tankowania_pokaz')">POKAŻ TANKOWANIA</button>
        </div>
        <div id="tankowania" style="display: none;">
        <button onclick="div_hide('tankowania'), div_show('tankowania_pokaz')">UKRYJ TANKOWANIA</button>
        <?php
        //lista serwisowań
        ?>
        </div>
        <div id="serwisowania_pokaz" style="display: ;" >
            <button onclick="div_show('serwisowania'), div_hide('serwisowania_pokaz')">POKAŻ SERWISOWANIA</button>
        </div>
        <div id="serwisowania" style="display: none;">
            <button onclick="div_hide('serwisowania'), div_show('serwisowania_pokaz')">UKRYJ SERWISOWANIA</button>
        <table border="1">
            <tr>
                <td>&nbsp;Data oddania&nbsp;</td>
                <td>&nbsp;Przebieg przy oddaniu&nbsp;</td>
                <td>&nbsp;Data odbioru&nbsp;</td>
                <td>&nbsp;Przebieg przy odbiorze&nbsp;</td>
                <td>&nbsp;Koszt&nbsp;</td>
                <td>&nbsp;Zakres&nbsp;</td>
                <td>&nbsp;Serwis&nbsp;</td>
                <td>&nbsp;Id samochodu&nbsp;</td>
                <td>&nbsp;Potwierdzenie płatności&nbsp;</td>
            </tr>

            <?php

            $zapytanie = mysqli_query($mysqli, "SELECT * FROM serwisowanie");
            while ($row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC)) {
                $Data_start=$row['data_start'];
                $Przebieg_start=$row['przebieg_koniec'];
                $Data_koniec=$row['data_start'];
                $Przebieg_koniec=$row['przebieg_koniec'];
                $Koszt=$row['koszt'];
                $Serwis_id=$row['serwis_ID'];
                $Zakres=$row['zakres'];
                $car_ID=$row['car_ID'];
                $zapytanie2 = mysqli_query($mysqli, "SELECT * FROM serwis WHERE serwis_id='$Serwis_id'");
                $row2 = mysqli_fetch_array($zapytanie2, MYSQLI_ASSOC);
                $nazwa=$row2['nazwa'];
                $miejscowosc=$row2['miejscowosc'];
                $ulica=$row2['ulica'];
                $numer=$row2['numer'];
                $Serwis=$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer;
                $serwis_ID=$row['serwis_ID'];
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
                    <td>&nbsp;<?php echo $car_ID; ?>&nbsp;</td>
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
        </div>
        <?php
        //lista ubezpieczeń
        ?>
        <div id="ubezpieczenia_pokaz" style="display: ;" >
            <button onclick="div_show('ubezpieczenia'), div_hide('ubezpieczenia_pokaz')">POKAŻ UBEZPIECZENIA</button>
        </div>
        <div id="ubezpieczenia" style="display: none;">
            <button onclick="div_hide('ubezpieczenia'), div_show('ubezpieczenia_pokaz')">UKRYJ UBEZPIECZENIA</button>
            <table border="1">
                <tr>
                    <td>&nbsp;Rodzaj&nbsp;</td>
                    <td>&nbsp;Początek okresu ubezpieczenia&nbsp;</td>
                    <td>&nbsp;Koniec okresu ubezpieczenia&nbsp;</td>
                    <td>&nbsp;Koszt&nbsp;</td>
                    <td>&nbsp;Uwagi&nbsp;</td>
                    <td>&nbsp;Nr polisy&nbsp;</td>
                    <td>&nbsp;Id samochodu&nbsp;</td>
                    <td>&nbsp;Polisa&nbsp;</td>
                    <td>&nbsp;Potwierdzenie płatności&nbsp;</td>
                </tr>
        <?php
        $zapytanie = mysqli_query($mysqli, "SELECT * FROM ubezpieczenia");
        while ($row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC)) {
        $Data_start=$row['data_start'];
        $Data_koniec=$row['data_koniec'];
        $Rodzaj=$row['rodzaj'];
        $Koszt=$row['koszt'];
        $Uwagi=$row['uwagi'];
        $Nr_polisy=$row['polisa'];
        $car_ID=$row['car_ID'];
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
            <td>&nbsp;<?php echo $car_ID;?>&nbsp;</td>
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
        </div>
        <?php
    }
}

else {
    // Widok dla użytkownika niezalogowanego
    echo '<p>Nie jesteś zalogowany.<br /><a href="login.php">Zaloguj</a> się lub <a href="register.php">zarejestruj</a> jeśli jeszcze nie masz konta.</p>';
}
?>
</center>
<?php
include('template/footer.php');
?>