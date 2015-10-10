<?php
include('template/header.php');
?>
<script language ="javascript">
    function checkLogin(){
        var login = document.getElementById("login").value;
        var errorResult = document.getElementById("loginDiv");
        if(login=='')
            errorResult.innerHTML = 'Błąd: Nie podano <b>Loginu</b>';
        errorResult.innerHTML = '';
        var myAjax = new Ajax.Request('functions/register.php', {
            method: 'post',
            parameters: "login=" + login,
            onSuccess: function(showResponse){
                errorResult.innerHTML  = showResponse.responseText;
            }
        });
    }
    function checkPass() {
        var pass1 = document.getElementById("pass").value;
        var pass2 = document.getElementById("pass_again").value;
        var errorResultPass = document.getElementById("passDiv");
        if((pass1!=pass2) && (pass1!="") && (pass2!=""))
            errorResultPass.innerHTML = '<b><font color="red">Hasła się od siebie różnią</font></b>';
        else
            errorResultPass.innerHTML = '';
    }
    function checkMail() {
        var mail1 = document.getElementById("email").value;
        var mail2 = document.getElementById("email_again").value;
        var errorResultMail = document.getElementById("mailDiv");
        if((mail1!=mail2) && (mail1!="") && (mail2!=""))
            errorResultMail.innerHTML = '<b><font color="red">Maile się od siebie różnią</font></b>';
        else
            errorResultMail.innerHTML = '';
    }
</script>
<?php

/**
 * Sprawdź czy formularz został wysłany
 */
if ($_POST['send'] == 1) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
    $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $email_v = mysql_real_escape_string(htmlspecialchars($_POST['email_v']));

    /**
     * Sprawdź czy podany przez użytkownika email lub login już istnieje
     */
    $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login='$login' LIMIT 1"));
    $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='$email' LIMIT 1"));

    $errors = ''; // Zmienna przechowująca listę błędów które wystąpiły


    // Sprawdź, czy nie wystąpiły błędy
    if (!$login || !$email || !$pass || !$pass_v || !$email_v ) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($existsLogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    if ($existsEmail[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';
    if ($email != $email_v) $errors .= '- E-maile się nie zgadzają<br />';
    if ($pass != $pass_v)  $errors .= '- Hasła się nie zgadzają<br />';

    /**
     * Jeśli wystąpiły jakieś błędy, to je pokaż
     */
    if ($errors != '') {
        echo '<p class="error">Rejestracja nie powiodła się, popraw następujące błędy:<br />'.$errors.'</p>';
    }

    /**
     * Jeśli nie ma żadnych błędów - kontynuuj rejestrację
     */
    else {

        // Posól i zasahuj hasło
        $pass = user::passSalter($pass);
        // Zapisz dane do bazy
        mysql_query("INSERT INTO users (login, email, pass) VALUES('$login','$email','$pass');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');

        echo '<p class="success">'.$login.', zostałeś zarejestrowany.
        <br /><a href="login.php">Logowanie</a></p>';
    }
}
?>

    <form method="post" action="">
        <label for="login">Login:</label>
        <input maxlength="32" type="text" name="login" id="login" onblur="checkLogin()" required />
        <div id="loginDiv"></div>
        <label for="pass">Hasło:</label>
        <input maxlength="32" type="password" name="pass" id="pass" required onblur="checkPass()" />

        <label for="pass_again">Hasło (ponownie):</label>
        <input maxlength="32" type="password" name="pass_v" id="pass_again" required onblur="checkPass()" />
        <div id="passDiv"></div>
        <label for="email">Email:</label>
        <input type="text" name="email" maxlength="50" id="email" required onblur="checkMail()" />

        <label for="email_again">Email (ponownie):</label>
        <input type="text" maxlength="255" name="email_v" id="email_again" required onblur="checkMail()" /><br />

        <div id="mailDiv"></div>
        <input type="hidden" name="send" value="1" />
        <input type="submit" value="Zarejestruj" />
    </form>

<?php
include('template/footer.php');
?>