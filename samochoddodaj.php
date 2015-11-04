<?php
include('template/header.php');
?>
<script language="JavaScript">
    function Check() {
        document.getElementById('blad').innerHTML="";
        if(!check(document.formularz.vin.value)) {
            blad++;
            document.getElementById('blad').innerHTML="Uzupełnij pole VIN poprawnie<br />";
        }
    }
    function check(vin) {
        // Reject based on bad pattern match
        no_ioq = '[a-hj-npr-z0-9]';  // Don't allow characters I,O or Q
        matcher = new RegExp("^" + no_ioq + "{8}[0-9xX]" + no_ioq + "{8}$", 'i'); // Case insensitive
        if(vin.match(matcher) == null)
            return false;

        // Reject base on bad check digit
        return check_digit_check(vin);
    };

    check_digit_check = function(vin) {
        cleaned_vin = vin.toUpperCase();

        letter_map = {A : 1, B : 2, C : 3, D : 4, E : 5, F : 6, G : 7, H : 8,
            J : 1, K : 2, L : 3, M : 4, N : 5,        P : 7,        R : 9,
            S : 2, T : 3, U : 4, V : 5, W : 6, X : 7, Y : 8, Z : 9,
            1 : 1, 2 : 2, 3 : 3, 4 : 4, 5 : 5, 6 : 6, 7 : 7, 8 : 8, 9 : 9, 0 : 0
        };
        weights = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2];

        products = 0;
        for(var i = 0; i < cleaned_vin.length; i++) {
            // alert('adding ' + letter_map[vin[i]] + ' * ' + weights[i] + ' to ' + products);
            products += letter_map[cleaned_vin[i]] * weights[i];
        }
        check_digit_should_be = products % 11;
        if(check_digit_should_be == 10) check_digit_should_be = 'X';

        return check_digit_should_be == cleaned_vin[8];
    }
</script>
<?php
$id=$_POST['id'];
echo ('Uzupełnij dane:(zamiast spacji użyj podkreślników "_")<br />');
echo ('<form method="post" action="samochoddodaj2.php" name="formularz" id="formularz">
<input type="hidden" name="wl" value="'.$id.'" />
<b>Marka</b>:<br /><input type="text" name="marka" placeholder="Wpisz markę" pattern="[A-Z][A-Za-z0-9\-\._]{0,48}" required /><br />
<b>Model</b>:<br /><input type="text" name="model" placeholder="Wpisz model" pattern="[A-Z][A-Za-z0-9\-\._]{0,48}" required /><br />
<b>Rocznik</b>:<br /><input type="text" name="rocznik" placeholder="Wpisz rocznik" pattern="[1-2][0-9]{3}" required /><br />
<b>Przebieg</b>:<br /><input type="text" name="przebieg" placeholder="Wpisz przebieg" pattern="[1-9][0-9]{0,18}" required /><br />
<b>VIN</b>:<br /><input type="text" name="vin" maxlength="17" placeholder="Wpisz VIN" required onblur="Check()" /><br />
<div id="blad" class="blad"></div>
<b>Numer rejestracyjny</b>:<br /><input type="text" name="nrrej" maxlength="7" pattern="[BCDEFGKLNOPRSTWZ][A-Z]{1,2}[A-Z0-9]{4,5}" placeholder="Wpisz numer rejestracyjny" required /><br />
&nbsp;<input type="submit" value="Zapisz"/>&nbsp;</form>');
?>
<?php
include('template/footer.php');
?>