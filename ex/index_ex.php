<?php
session_start();
include_once("../sql/sql_functions.php");

//ASSIGNING THE VARIABLES
if (isset($_POST['brand'])) {
    $brand = $_POST['brand'];
}
else{
    $brand = "any_brand";
}
if (isset($_POST['model'])) {
    $model = $_POST['model'];
}
else{
    $model = 'any_model';
}
if (isset($_POST['fuel_type'])) {
    $fuel_type = $_POST['fuel_type'];
}
else{
    $fuel_type = 'any_fuel';
}
if (isset($_POST['min_price'])) {
    if ($_POST['min_price'] == "no_min") {
        $min_price = 0;
    }
    else{
        $min_price = (int)$_POST['min_price'];
    }
}
else{
    $min_price = 0;
}
if (isset($_POST['max_price'])) {
    if ($_POST['max_price'] == "no_max") {
        $max_price = 2000000;
    }
    else{
        $max_price = (int)$_POST['max_price'];
    }
}
else{
    $max_price = 2000000;
}
if (isset($_POST['transmission'])) {
    $transmission = $_POST['transmission'];
}
else{
    $transmission = 'any_transmission';
}

//SEARCHING THE DATABASE AND HEADING TO RESULT SHOW PAGE
$result = search($brand, $model, $fuel_type, $min_price, $max_price, $transmission);
$_SESSION['result'] = $result;
header("Location: ../search_result.php");
exit();





 ?>
