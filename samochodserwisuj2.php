<?php
include('template/header.php');
?>
    <script language="JavaScript">
        var blad=0;
        function przebiegCheck() {
            document.getElementById('bladprzebieg').innerHTML="";
            if(!document.formularz.przebieg_start.value) {
                blad++;
                document.getElementById('bladprzebieg').innerHTML="Uzupełnij pole przebieg<br />";
            }
        }
        function przebieg2Check() {
            document.getElementById('bladprzebieg2').innerHTML="";
            if(!document.formularz.przebieg_koniec.value) {
                blad++;
                document.getElementById('bladprzebieg2').innerHTML="Uzupełnij pole przebieg<br />";
            }
        }
        function kosztCheck() {
            document.getElementById('bladkoszt').innerHTML=="";
            if(!document.formularz.koszt.value) {
                blad++;
                document.getElementById('bladkoszt').innerHTML="Uzupełnij pole koszt<br />";
            }
        }
        function zakresCheck() {
            document.getElementById('bladzakres').innerHTML=="";
            if(!document.formularz.zakres.value) {
                blad++;
                document.getElementById('bladzakres').innerHTML="Uzupełnij pole zakres<br />";
            }
        }
        function check() {
            blad=0;
            przebiegCheck();
            przebieg2Check();
            kosztCheck();
            zakresCheck();
            if(blad==0)
                return true;
            else
                return false;
        }
    </script>

<?php

$car_ID=$_POST['car_ID'];
$stacja_ID=$_POST['stacja_ID'];
$zapytanie = mysqli_query($mysqli, "SELECT * FROM stacja WHERE stacja_id='$stacja_ID'");
$row = mysqli_fetch_array($zapytanie, MYSQLI_ASSOC);
$id=$row['id'];
$nazwa=$row['nazwa'];
$numer=$row['numer'];
$ulica=$row['ulica'];
$miejscowosc=$row['miejscowosc'];


echo ('Uzupełnij dane:<br />');
echo ('Stacja paliw: '.$nazwa.', '.$miejscowosc.', '.$ulica.' '.$numer.'<br />');
echo ('<form method="post" action="samochodserwisuj3.php" name="formularz" id="formularz" onsubmit="return check()">
<input type="hidden" name="car_ID" value='.$car_ID.' />
<input type="hidden" name="stacja_ID" value='.$stacja_ID.' />
<b>Data oddania do serwisu</b>:<br /><input type="date" name="data_start" id="data_start" required placeholder="YYYY-MM-DD" pattern="^((?:20)\d\d)[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$" /><br />
<b>Podaj przebieg przy oddaniu</b>:<br /><input type="number" name="przebieg_start" id="przebieg_start" onblur="przebiegCheck()" pattern="[1-9][0-9]{0,18}" placeholder="Wpisz przebieg" required /><br />
<div id="bladprzebieg" class="blad"></div>
<b>Data odebrania z serwisu</b>:<br /><input type="date" name="data_koniec" id="data_koniec" required placeholder="YYYY-MM-DD" pattern="^((?:20)\d\d)[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$" /><br />
<b>Podaj przebieg przy odebraniu</b>:<br /><input type="text" name="przebieg_koniec" id="przebieg_koniec" onblur="przebieg2Check()" pattern="[1-9][0-9]{0,18}" placeholder="Wpisz przebieg" required /><br />
<div id="bladprzebieg2" class="blad"></div>
<b>Koszt serwisu</b>:(minimum jedno miejsce po przecinku)<br /><input type="text" name="koszt" onblur="kosztCheck()" pattern="[0-9]{1,7}\.[0-9]{1,2}" placeholder="Wpisz koszt serwisu" required /><br />
<div id="bladkoszt" class="blad"></div>
<b>Zakres serwisu</b>:(wielkość pola możesz sobie zmieniać w zależności od potrzeb)<br /><textarea name="zakres" onblur="zakresCheck()" placeholder="Wpisz zakres serwisu, dokonane naprawy, czynności itp" required ></textarea><br />
<div id="bladzakres" class="blad"></div>
&nbsp;<input type="submit" value="Dalej"/>&nbsp;</form>');
?>
<?php
include('template/footer.php');
?>