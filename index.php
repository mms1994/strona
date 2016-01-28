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
    ?>
    <br /><hr><br />
    <?php
    $dane=false;
    $log=$user['login'];
    $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT uzytkownik_id FROM uzytkownicy WHERE login='$log' LIMIT 1;"));
    $id=$ide['uzytkownik_id'];
    $ide2=mysqli_fetch_array(mysqli_query($mysqli, "SELECT imie FROM pracownicy WHERE id_user='$id'"));
    if($ide2['imie']!="") $dane=true;
    if(!$dane) {
        ?>
        Musisz uzupełnić poniższe dane!<br />
        <form id="uzupelnianie" method="post" action="uzupelnij.php">
            <input type="hidden" name="nick" value="<?php echo $user['login'] ?>" />
            Imię: <input type="text" name="imie" required/><br />
            Nazwisko: <input type="text" name="nazwisko" required/><br />
            Pesel: <input type="text" name="pesel" maxlength="11" required/><br />
            Ulica: <input type="ulica" name="ulica" required/><br />
            Numer domu: <input type="number" name="nr_dom" required/><br />
            Numer mieszkania: <input type="number" name="nr_mieszkania" /><br />
            Miejscowość: <input type="text" name="miejscowosc" required/><br />
            Kod pocztowy: <input type="text" name="kod_pocztowy" maxlength="5" required/><br />
            <input type="submit" value="Wyślij" />
        </form>
        <?php
    }
}

else {
    // Widok dla użytkownika niezalogowanego
    echo '<p>Nie jesteś zalogowany.<br /><a href="login.php">Zaloguj</a> się lub <a href="register.php">zarejestruj</a> jeśli jeszcze nie masz konta.</p>';
}
?>

<?php
include('template/footer.php');
?>