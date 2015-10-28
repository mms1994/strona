<?php
include('template/header.php');
?>
<?php
//*****************************************************
if(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443)){
//*****************************************************
// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection


    if (isset($_POST['send']) == 1) {
        $login = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['login']));
        $pass = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['pass']));
        // Sprawdź, czy wszystkie pola zostały uzupełnione
        if (!$login or empty($login)) {
            die ('<p class="error">Wypełnij pole z loginem!</p>');
        }

        if (!$pass or empty($pass)) {
            die ('<p class="error">Wypełnij pole z hasłem!</p>');
        }

        $pass = user::passSalter($pass); // Posól i zahashuj hasło

        // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
        $userExists = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login' AND pass = '$pass'"));

        if ($userExists[0] == 0) {
            // Użytkownik nie istnieje w bazie
            echo '<p class="error">Użytkownik o podanym loginie i haśle nie istnieje.</p>';
        } else {
            // Użytkownik istnieje
            $user = user::getData($login, $pass); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

            // Przypisz pobrane dane do sesji
            setcookie("login", $login, time() + 3600 * 4);
            //setcookie("pass", $pass);

            echo '<p class="success">Zostałeś zalogowany. Możesz przejść na <a href="index.php">stronę główną</a></p>';
        }
    } else {
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
}
else {
    echo "Połączenie nie jest szyfrowane. Ze względów bezpieczeństwa logowanie nie będzie dozwolone!<br />";
}
include('template/footer.php');
?>