<?php
include('template/header.php');
?>

<?php
$cookieData=explode(";", $_COOKIE["sesja"]);
unset($_COOKIE["login"]);
setcookie("login", "", time()-3600);
$sesja=explode(";", $_COOKIE["sesja"]);
$mysqli->query("DELETE FROM sesja WHERE session_key='$cookieData[0]'");
unset($_COOKIE["sesja"]);
setcookie("sesja", "", time()-3600);
header("Location: index.php");
echo '<p class="success">Zostałeś wylogowany! Możesz przejść na <a href="index.php">stronę główną</a></p>';

?>

<?php
include('template/footer.php');
?>