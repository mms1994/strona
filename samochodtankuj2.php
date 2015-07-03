<?php
include('template/header.php');
?>
<script language="JavaScript">
    var blad=0;
    function przebiegCheck() {
        document.getElementById('bladprzebieg').innerHTML="";
        if(!document.formularz.przebieg.value) {
            blad++;
            document.getElementById('bladprzebieg').innerHTML="Uzupełnij pole przebieg<br />";
        }
    }
    function dystansCheck() {
        document.getElementById('bladdystans').innerHTML="";
        if(!document.formularz.dystans.value) {
            blad++
            document.getElementById('bladdystans').innerHTML="Uzupełnij pole dystans<br />";
        }
    }
    function cenaCheck() {
        document.getElementById('bladcena').innerHTML="";
        if(!document.formularz.cena.value) {
            blad++;
            document.getElementById('bladcena').innerHTML="Uzupełnij pole cena<br />";
        }
    }
    function kosztCheck() {
        document.getElementById('bladkoszt').innerHTML=="";
        if(!document.formularz.koszt.value) {
            blad++;
            document.getElementById('bladkoszt').innerHTML="Uzupełnij pole koszt<br />";
        }
    }
    function iloscCheck() {
        document.getElementById('bladilosc').innerHTML="";
        if(!document.formularz.ilosc.value) {
            blad++;
            document.getElementById('bladilosc').innerHTML="Uzupełnij pole ilość<br />";
        }
    }
    function check() {
        blad=0;
        przebiegCheck();
        dystansCheck();
        cenaCheck();
        kosztCheck();
        iloscCheck();
        if(blad==0)
        return true;
        else
        return false;
    }
</script>

<?php

$car_ID=$_POST['car_ID'];
$stacja_ID=$_POST['stacja_ID'];
$zapytanie = mysql_query("SELECT * FROM stacja WHERE id='$stacja_ID'");
$row = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
    $id=$row['id'];
    $nazwa=$row['nazwa'];
    $numer=$row['numer'];
    $ulica=$row['ulica'];
    $miejscowosc=$row['miejscowosc'];


echo ('Uzupełnij dane:<br />');
echo ('Stacja paliw: '.$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer.'<br />');
echo ('<form method="post" action="samochodtankuj3.php" name="formularz" id="formularz" onsubmit="return check()">
<input type="hidden" name="car_ID" value='.$car_ID.' />
<input type="hidden" name="stacja_ID" value='.$stacja_ID.' />
<b>Data tankowania</b>:<br /><input type="date" name="data" id="data" required /><br />
<b>Przebieg na koniec</b> (lub dystans):<br /><input type="number" name="przebieg" id="przebieg" onblur="przebiegCheck()" placeholder="Wpisz przebieg" /><br />
<div id="bladprzebieg" class="blad"></div>
<b>Dystans</b> (lub przebieg):<br /><input type="number" name="dystans" onblur="dystansCheck()" placeholder="Wpisz przebyty dystans" /><br />
<div id="bladdystans" class="blad"></div>
<b>Cena za litr</b>:<br /><input type="number" name="cena" onblur="cenaCheck()" placeholder="Wpisz cenę za litr" /><br />
<div id="bladcena" class="blad"></div>
<b>Koszt</b>:<br /><input type="number" name="koszt" onblur="kosztCheck()" placeholder="Wpisz koszt tankowania" /><br />
<div id="bladkoszt" class="blad"></div>
<b>Ilosc</b>:<br /><input type="number" name="ilosc" onblur="iloscCheck()" placeholder="Wpisz ilość zatankowanego paliwa" /><br />
<div id="bladilosc" class="blad"></div>
&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>');
?>
<?php
include('template/footer.php');
?>