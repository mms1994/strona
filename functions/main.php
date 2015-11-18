<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 2015-07-02
 * Time: 16:52
 */
date_default_timezone_set("Europe/Warsaw");
// includes
include("base.php");
require_once ('user.class.php');
include("names_pl.php");
include("functions.js");
//////////////////////////////////////////////////////////////
/* TUTAJ MA BYĆ ID ADMINA */
$admin_id=2;
//////////////////////////////////////////////////////////////
function validate_vin($vin) {

    $vin = strtolower($vin);
    if (!preg_match('/^[^\Wioq]{17}$/', $vin)) {
        return false;
    }

    $weights = array(8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2);

    $transliterations = array(
        "a" => 1, "b" => 2, "c" => 3, "d" => 4,
        "e" => 5, "f" => 6, "g" => 7, "h" => 8,
        "j" => 1, "k" => 2, "l" => 3, "m" => 4,
        "n" => 5, "p" => 7, "r" => 9, "s" => 2,
        "t" => 3, "u" => 4, "v" => 5, "w" => 6,
        "x" => 7, "y" => 8, "z" => 9
    );

    $sum = 0;

    for($i = 0 ; $i < strlen($vin) ; $i++ ) { // loop through characters of VIN
        // add transliterations * weight of their positions to get the sum
        if(!is_numeric($vin{$i})) {
            $sum += $transliterations[$vin{$i}] * $weights[$i];
        } else {
            $sum += $vin{$i} * $weights[$i];
        }
    }

    // find checkdigit by taking the mod of the sum

    $checkdigit = $sum % 11;

    if($checkdigit == 10) { // checkdigit of 10 is represented by "X"
        $checkdigit = "x";
    }

    return ($checkdigit == $vin{8});
}
?>
