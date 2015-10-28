<?php
/**
 * Klasa wykonująca wszystkie podstawowe operacje
 * @author Sobak
 * @package User System
 */


class user {


    public static $user = array();

    /**
     * Zwraca tablicę ze wszystkimi danymi o użytkowniku.
     * Indeksy tablicy odpowiadają nazwom pól w bazie danych (login, pass etc...)
     * @param string $login
     * @param string $pass
     * @return array
     */
    public static function getData ($login, $pass) {
        if ($login == '') $login = $_COOKIE['login'];
        //if ($pass == '') $pass = $_COOKIE['pass'];
        $cfg['db_server'] = 'localhost'; // Serwer bazy danych
        $cfg['db_user'] = 'root'; // Nazwa użytkownika
        $cfg['db_pass'] = ''; // Hasło
        $cfg['db_name'] = 'strona'; // Nazwa bazy danych
        $mysqli = new mysqli($cfg['db_server'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);

        if (mysqli_connect_errno()) {
            printf("<p class='error'>Nie udało się połączyc z bazą danych: %s\n</p>", mysqli_connect_error());
            exit();
        }

        $as=$mysqli->query("SET CHARSET utf8");
        $es=$mysqli->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

        self::$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM uzytkownicy WHERE login='$login' LIMIT 1;"));
        return self::$user;
    }


    /**
     * Zwraca tablicę ze wszystkimi danymi o użytkowniku, tak jak powyższa metoda klasy,
     * ale rozpoznaje użytkownika nie po podaniu loginu i hasła tylko po podaniu ID.
     * Używana np. do wyświetlania strony profilu.
     * @param int $id
     * @return array
     */
    public function getDataById ($id) {
        $cfg['db_server'] = 'localhost'; // Serwer bazy danych
        $cfg['db_user'] = 'root'; // Nazwa użytkownika
        $cfg['db_pass'] = ''; // Hasło
        $cfg['db_name'] = 'strona'; // Nazwa bazy danych
        $mysqli = new mysqli($cfg['db_server'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);

        if (mysqli_connect_errno()) {
            printf("<p class='error'>Nie udało się połączyc z bazą danych: %s\n</p>", mysqli_connect_error());
            exit();
        }

        $as=$mysqli->query("SET CHARSET utf8");
        $es=$mysqli->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
        $user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM uzytkownicy WHERE uzytkownik_id='$id' LIMIT 1;"));
        return $user;
    }

    /**
     * Jeśli użytkownik jest zalogowany - zwraca true, w przeciwnym wypadku - false
     * @return bool
     */
    public static function isLogged () {
        if (empty($_COOKIE['login'])) {
            return false;
        }

        else {
            return true;
        }
    }

    /**
     * "Soli" hasło przed jego zahashowaniem funkcją md5()
     * @param string $pass
     * @return string
     */
    public static function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}
