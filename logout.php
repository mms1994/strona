<?php
include('template/header.php');
?>

<?php

session_destroy();
$_SESSION = array ();
echo '<p class="success">Zostałeś wylogowany! Możesz przejść na <a href="index.php">stronę główną</a></p>';

?>

<?php
include('template/footer.php');
?>