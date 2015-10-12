<?php
include('template/header.php');
?>

<?php
$max_rozmiar = 1024*1024*10;
if($_POST['tankowanie_ID']!="") {
    $nazwa = $_POST['car_ID'] . '_' . $_POST['tankowanie_ID'] . '.pdf';
    $car_ID = $_POST['car_ID'];
    $sc = dirname($_SERVER['REQUEST_URI']);
    if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
        if ($_FILES['plik']['size'] > $max_rozmiar) {
            echo 'Błąd! Plik jest za duży! Maksymalny rozmiar to 10MB';
        } else {
            if (isset($_FILES['plik']['type'])) {
            }
            move_uploaded_file($_FILES['plik']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $sc . '/pliki/potwierdzeniaplatnosci/paliwo/' . $nazwa);
            echo 'Operacja dodania pliku zakończona pomyślnie.<br />';
            echo '<form method="post" action="samochodtankowaniehistoria.php"><input type="hidden" name="id" value=' . $car_ID . ' />&nbsp;<input type="submit" value="Powrót"/>&nbsp;</form>';

        }
    } else {
        echo 'Błąd przy przesyłaniu danych!';
    }
}
if($_POST['serwis_ID']!="") {
    $nazwa = $_POST['car_ID'] . '_' . $_POST['serwis_ID'] . '.pdf';
    $car_ID = $_POST['car_ID'];
    $sc = dirname($_SERVER['REQUEST_URI']);
    if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
        if ($_FILES['plik']['size'] > $max_rozmiar) {
            echo 'Błąd! Plik jest za duży! Maksymalny rozmiar to 10MB';
        } else {
            if (isset($_FILES['plik']['type'])) {
            }
            move_uploaded_file($_FILES['plik']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $sc . '/pliki/potwierdzeniaplatnosci/serwis/' . $nazwa);
            echo 'Operacja dodania pliku zakończona pomyślnie.<br />';
            echo '<form method="post" action="samochodserwisowaniehistoria.php"><input type="hidden" name="id" value=' . $car_ID . ' />&nbsp;<input type="submit" value="Powrót"/>&nbsp;</form>';

        }
    } else {
        echo 'Błąd przy przesyłaniu danych!';
    }
}

?>

<?php
include('template/footer.php');
?>