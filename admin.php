<?php
include('template/header.php');
?>

<?php
if (user::isLogged()) {
    // Widok dla użytkownika zalogowanego

    // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
    $user = user::getData('', '');
    $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT login FROM uzytkownicy WHERE uzytkownik_id='$admin_id' LIMIT 1;"));
    $log=$ide['login'];
    if ($user['login']==$log) {
        //coś
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