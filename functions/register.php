<?php
include ("base.php");
session_start();
$login = mysqli_real_escape_string($mysqli, (htmlspecialchars($_POST['login'])));
$userExists = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login'"));
if ($userExists[0]>0) echo ('<b><font color="red">LOGIN ZAJĘTY</font></b>');
else echo '';

//exit();
?>