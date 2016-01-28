<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 2015-07-02
 * Time: 17:18
 */
$cfg['db_server'] = 'localhost'; // Serwer bazy danych
$cfg['db_user'] = 'root'; // Nazwa użytkownika
$cfg['db_pass'] = ''; // Hasło
$cfg['db_name'] = 'strona'; // Nazwa bazy danych


// POŁĄCZ Z BAZĄ DANYCH
try {
    $mysqli = new mysqli($cfg['db_server'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
}
catch (mysqli_sql_exception $e) {
    echo "Wystapił błąd: ".$e->getMessage();
}
if (mysqli_connect_errno()) {
    printf("<p class='error'>Nie udało się połączyc z bazą danych: %s\n</p>", mysqli_connect_error());
    exit();
}

$as=$mysqli->query("SET CHARSET utf8");
$es=$mysqli->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
?>