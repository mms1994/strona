<li><a class="menu" href="index.php">Strona Główna</a></li>
<li><a class="menu" href="samochod.php">Flota</a></li>
<li><a class="menu" href="pracownicy.php">Pracownicy</a></li>
<?php
if (user::isLogged()) {
    $user = user::getData('', '');
    $ide = mysqli_fetch_array(mysqli_query($mysqli, "SELECT login FROM uzytkownicy WHERE uzytkownik_id='$admin_id' LIMIT 1;"));
    $log=$ide['login'];
    if ($user['login']==$log) {
        ?>
        <li><a class="menu" href="admin.php">admin</a></li>
        <?php
    }
}
?>