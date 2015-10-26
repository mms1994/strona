<?php
include('template/header.php');
?>
<?php
// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
$login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
$pass = htmlspecialchars(mysql_real_escape_string($_POST['pass']));

if ($_POST['send'] == 1) {
    // Sprawdź, czy wszystkie pola zostały uzupełnione
    if (!$login or empty($login)) {
        die ('<p class="error">Wypełnij pole z loginem!</p>');
    }

    if (!$pass or empty($pass)) {
        die ('<p class="error">Wypełnij pole z hasłem!</p>');
    }

    $pass = user::passSalter($pass); // Posól i zahashuj hasło

    // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
    $userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login' AND pass = '$pass'"));

    if ($userExists[0] == 0) {
        // Użytkownik nie istnieje w bazie
        echo '<p class="error">Użytkownik o podanym loginie i haśle nie istnieje.</p>';
    }

    else {
        // Użytkownik istnieje
        $user = user::getData($login, $pass); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

        // Przypisz pobrane dane do sesji
        setcookie("login",$login,time()+3600*4);
        //setcookie("pass", $pass);

        echo '<p class="success">Zostałeś zalogowany. Możesz przejść na <a href="index.php">stronę główną</a></p>';
    }
}

else {
    /**
     * FORMULARZ LOGOWANIA
     */
    ?>

    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" maxlength="32" id="login"/>

        <label for="pass">Hasło:</label>
        <input type="password" name="pass" maxlength="32" id="pass"/><br/>

        <input type="hidden" name="send" value="1"/>
        <input type="submit" value="Zaloguj"/>
    </form>

<?php
}
include('template/footer.php');
?>