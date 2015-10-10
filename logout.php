<?php
include('template/header.php');
?>

<?php

setcookie("login","");
setcookie("pass","");
echo '<p class="success">Zostałeś wylogowany! Możesz przejść na <a href="index.php">stronę główną</a></p>';

?>

<?php
include('template/footer.php');
?>