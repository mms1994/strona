<?php
include('template/header.php');
?>

<?php
if (user::isLogged()) {
    // Widok dla użytkownika zalogowanego

    // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
    $user = user::getData('', '');
    $nick=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['nick'])));
    $imie=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['imie'])));
    $nazwisko=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['nazwisko'])));
    $pesel=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['pesel'])));
    $ulica=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['ulica'])));
    $nr_dom=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['nr_dom'])));
    $nr_mieszkania=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['nr_mieszkania'])));
    $miejscowosc=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['miejscowosc'])));
    $kod_pocztowy=mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['kod_pocztowy'])));
    //walidacje zrób
    $valid=true;
    $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT uzytkownik_id FROM uzytkownicy WHERE login='$nick' LIMIT 1;"));
    $id=$ide['uzytkownik_id'];
    if($valid) {
        $zapytanie = "INSERT INTO pracownicy VALUES ('', '$imie', '$nazwisko', '$id', '$pesel', '$ulica', '$nr_dom', '$nr_mieszkania', '$miejscowosc', '$kod_pocztowy', '')";
        $wynik = mysqli_query($mysqli, $zapytanie);

        if ($wynik) {
            echo 'Wpis dodany prawidłowo<br />';
            echo '<a href="index.php">POWRÓT</a><br />';
        }
        echo 'Błąd spróbuj ponownie później <a href="index.php">POWRÓT</a><br />';
    }
else {
    echo "Formularz został błędnie wypełniony!<br />";
    echo 'Spróbuj ponownie <a href="index.php">POWRÓT</a><br />';
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