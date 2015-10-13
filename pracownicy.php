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
    pracownicy
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