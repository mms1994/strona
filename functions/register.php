<?php
include ("base.php");
session_start();
$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
$userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login = '$login'"));
if ($userExists[0]>0) echo ('<b><font color="red">LOGIN ZAJĘTY</font></b>');
else echo '';
exit();
?>