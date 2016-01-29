<?php
include('template/header.php');
?>

<?php
if (user::isLogged()) {
    $car_ID=$_POST['id'];
    //dodawanie
    ?>
    <form method="post" name="formularz" action="wiecejdodaj.php"><input type="hidden" name="car_ID" value="<?php echo $car_ID; ?>"/>
        <b>DODAJ NOWA INFORMACJE</b><br />
        <b>Nazwa</b>:<br /><input type="text" name="nazwa" id="nazwa" placeholder="Wpisz nazwe" required /><br />
        <b>Opis</b>:<br /><input type="text" name="opis" id="opis" placeholder="Wpisz nazwe" required /><br />
        <input type="submit" value="Dodaj"/> </form>
<br /><br />
    <table border="1">
        <tr>
            <td>&nbsp;Nazwa&nbsp;</td>
            <td>&nbsp;Opis&nbsp;</td>
        </tr>
    <?php
    // pobranie ID użytkownika
    $zapytanie = mysqli_query($mysqli, "SELECT * FROM samochodydod WHERE samochod_id='$car_ID'");
    while ($row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC)) {
        $nazwa=$row['nazwa'];
        $opis=$row['opis'];
        ?>
        <tr>
                <td>&nbsp;<?php echo $nazwa; ?>&nbsp;</td>
                <td>&nbsp;<?php echo $opis; ?>&nbsp;</td>
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