<?php
include('template/header.php');
?>
<?php
//*****************************************************
//skasować "!"
if(!((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
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
            $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT uzytkownik_id FROM uzytkownicy WHERE login='$login'"));
            $userId=$ide['uzytkownik_id'];
            // Przypisz pobrane dane do sesji
            $session=array();
            $session["ip"]=$_SERVER['REMOTE_ADDR'];
            $sessionData=md5($session["ip"]);
            $date=new DateTime();
            $session["key"]=md5($date->getTimestamp().$sessionData.rand());
            $session["userId"]=$userId;
            $session["dateTime"]=$date->format("Y-m-d H:i:s");
            $session["userAgent"]=$_SERVER['HTTP_USER_AGENT'];
            $key=$session["key"];
            $dateTime=$session["dateTime"];
            $userAgent=$session["userAgent"];
            $ip=$session["ip"];
            $to=$mysqli->query("SELECT id_user FROM sesja WHERE id_user='$userId'");
            if($to->num_rows>0)
                $to=$mysqli->query("DELETE FROM sesja WHERE id_user='$userId'");
            $zap="INSERT INTO sesja (id_user, session_key, date, user_ip, user_agent) VALUE ('$userId', '$key', '$dateTime', '$ip', '$userAgent')";
            $wynik = $mysqli->query($zap);
            if($wynik) {
                setcookie("login", $login, time() + 3600*4);
                $cookieData=array($session["key"], $userId);
                setcookie("sesja", implode(";", $cookieData), time()+3600*4);
                header("Location: index.php");
                echo '<p class="success">Zostałeś zalogowany. Możesz przejść na <a href="index.php">stronę główną</a></p>';
            }

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