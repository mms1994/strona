<?php
include('template/header.php');
?>

<?php
if (user::isLogged()) {
    // Widok dla użytkownika zalogowanego

    // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
    $user = user::getData('', '');

    echo '<p>Jesteś zalogowany, witaj '.$user['login'].'!</p>';
    echo 'Aby się <a href="logout.php">wylogować</a></p>';
    $log=$user['login'];
    $ide = mysql_fetch_array(mysql_query("SELECT uzytkownik_id FROM uzytkownicy WHERE login='$log' LIMIT 1;"));
    $id=$ide['uzytkownik_id'];
    ?>
    <br /><hr><br />
    Lista Twoich samochodów:<form method="post" action="samochoddodaj.php"><input type="hidden" name="id" value='<?php echo $id; ?>' />&nbsp;<input type="submit" value="Dodaj pojazd"/>&nbsp;</form><br />
    <table border="1">
        <tr>
            <td>&nbsp;NR REJESTRACYJNY&nbsp;</td>
            <td>&nbsp;Marka&nbsp;</td>
            <td>&nbsp;Model&nbsp;</td>
            <td>&nbsp;Rocznik&nbsp;</td>
            <td>&nbsp;Przebieg&nbsp;</td>
            <td>&nbsp;VIN&nbsp;</td>
            <td colspan="6">&nbsp;Opcje&nbsp;</td>
        </tr>
    <?php
    // pobranie ID użytkownika
    $zapytanie = mysql_query("SELECT * FROM samochody WHERE wl='$id'");
    while ($row = mysql_fetch_array($zapytanie, MYSQL_ASSOC)) {
        $NrRej=$row['nrrej'];
        $Marka=$row['marka'];
        $Model=$row['model'];
        $Rocznik=$row['rocznik'];
        $Przebieg=$row['przebieg'];
        $VIN=$row['vin'];
        $idek=$row['car_id'];
        $status=$row['status'];
        $Usun='<form method="post" action="samochodusun.php" onsubmit="return confirm(\'Czy na pewno chcesz skasować?\');"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Zamknij"/>&nbsp;</form>';
        $Tankowanie='<form method="post" action="samochodtankuj.php"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Tankowanie"/>&nbsp;</form>';
        $Serwis='<form method="post" action="samochodserwisuj.php"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Serwis"/>&nbsp;</form>';
        $HistoriaTankowanie='<form method="post" action="samochodtankowaniehistoria.php"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Historia tankowania"/>&nbsp;</form>';
        $HistoriaSerwis='<form method="post" action="samochodserwisowaniehistoria.php"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Historia serwisowania"/>&nbsp;</form>';
        $Ubezpieczenie='<form method="post" action="samochodubezpieczenie.php"><input type="hidden" name="id" value='.$idek.' />&nbsp;<input type="submit" value="Ubezpieczenie"/>&nbsp;</form>';
        ?>
        <tr>
            <td>&nbsp;<?php echo $NrRej; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Marka; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Model; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Rocznik; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Przebieg; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $VIN; ?>&nbsp;</td>
            <?php if($status==0) {
                ?>
                <td>&nbsp;<?php echo $Usun; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Tankowanie; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $Serwis; ?>&nbsp;</td>
                <?php
            }
            else  {
                ?>
                <td colspan="3"> &nbsp; POJAZD SPRZEDANY &nbsp;</td>
                <?php
            }
            ?>
            <td>&nbsp;<?php echo $HistoriaTankowanie; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $HistoriaSerwis; ?>&nbsp;</td>
            <td>&nbsp;<?php echo $Ubezpieczenie; ?>&nbsp;</td>
        </tr>
    <?php
    }
        ?>
    </table>
    <?php
}

else {
    // Widok dla użytkownika niezalogowanego
    echo '<p>Nie jesteś zalogowany.<br /><a href="login.php">Zaloguj</a> się lub <a href="register.php">zarejestruj</a> jeśli jeszcze nie masz konta.</p>';
}
?>

<?php
include('template/footer.php');
?>