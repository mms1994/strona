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

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE login='$login' LIMIT 1;"));
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
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;"));
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
