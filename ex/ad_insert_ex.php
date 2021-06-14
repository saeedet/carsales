<?php
session_start();
include_once("../sql/sql_functions.php");

//CHEKING if it is a real request
if (isset($_POST['brand']) && isset($_POST['model']) && isset($_POST['kilometers'])
         && isset($_POST['price']) && isset($_POST['body_type']) && isset($_POST['transmission'])
            && isset($_POST['year']) && isset($_POST['fuel_type']) && isset($_POST['color'])
                && isset($_POST['seats'])) {
    //Assigning the variables
    $brand = strtolower($_POST['brand']);
    $model = strtolower($_POST['model']);
    $price = $_POST['price'];
    $body_type = strtolower($_POST['body_type']);
    $transmission = $_POST['transmission'];
    $year = $_POST['year'];
    $seats = $_POST['seats'];
    $color = strtolower($_POST['color']);
    $fuel_type = $_POST['fuel_type'];
    $kilometers = $_POST['kilometers'];
    $description = strtolower($_POST['description']);
    $user_id = $_SESSION['user']['user_info']['ID'];


    //ADDING THE NEW ITEM
    $result = add_item($brand, $model, $price, $body_type, $transmission, $year, $seats, $color, $fuel_type, $kilometers, $description, $user_id);

    header("Location: ../advanced-search.php");
    exit();

}
else{
    echo "404!";
}


 ?>
