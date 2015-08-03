<?php
include('template/header.php');
?>

<?php
$max_rozmiar = 1024*1024*10;
$nazwa=$_POST['car_ID'].'_'.$_POST['tankowanie_ID'].'.pdf';
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if ($_FILES['plik']['size'] > $max_rozmiar) {
        echo 'Błąd! Plik jest za duży! Maksymalny rozmiar to 10MB';
    } else {
        if (isset($_FILES['plik']['type'])) {
        }
        move_uploaded_file($_FILES['plik']['tmp_name'],
            $_SERVER['DOCUMENT_ROOT'].'/strona/pliki/potwierdzeniaplatnosci/paliwo/'.$nazwa);
    }
} else {
    echo 'Błąd przy przesyłaniu danych!';
}

?>

<?php
include('template/footer.php');
?>