<?php
session_start();
include_once("../sql/sql_functions.php");


//fetching and sending info by ID to the update page
if (isset($_POST['edit'])) {
    $ID = $_POST['id'];
    $result = get_this_item($ID);
    $_SESSION['update_this'] = $result;
    header("Location: update-this.php");
    exit();
}
if (isset($_GET['edit'])) {
    $ID = $_GET['ID'];
    $result = get_this_item($ID);
    $_SESSION['update_this'] = $result;
    header("Location: update-this.php");
    exit();
}

//deleting the item using ID
if (isset($_GET['delete'])) {
    $ID = $_GET['ID'];
    $result = delete_item($ID);
    $_SESSION['op_result'] = $result;
    header("Location: edit-item.php");
    exit();
}
if (isset($_POST['delete'])) {
    $ID = $_POST['id'];
    $result = delete_item($ID);
    $_SESSION['op_result'] = $result;
    header("Location: edit-item.php");
    exit();
}

//UPDATING THE CHANGED INFORMATION
if (isset($_POST['update_this'])) {
    $ID = $_SESSION['update_this'][0]['ID'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $body_type = $_POST['body_type'];
    $year = $_POST['year'];
    $kilometers = $_POST['kilometers'];
    $fuel_type = $_POST['fuel_type'];
    $transmission = $_POST['transmission'];
    $color = $_POST['color'];
    $seats = $_POST['seats'];
    $price = $_POST['price'];
    $result = update_item($ID,$brand,$model,$body_type,$year,$kilometers,$fuel_type,$transmission,$color,$seats,$price);
    $_SESSION['op_result'] = $result;
    header("Location: edit-item.php");
    exit();
}

//INSERTING THE NEW ITEM TO THE DATABASE
if (isset($_POST['new_item'])) {
    $user_id = 1;
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $body_type = $_POST['body_type'];
    $year = $_POST['year'];
    $kilometers = $_POST['kilometers'];
    $fuel_type = $_POST['fuel_type'];
    $transmission = $_POST['transmission'];
    $color = $_POST['color'];
    $seats = $_POST['seats'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $result = add_item($brand, $model , $price, $body_type, $transmission, $year, $seats, $color, $fuel_type, $kilometers, $description, $user_id);
    $_SESSION['op_result'] = $result;
    header("Location: edit-item.php");
    exit();
}

 ?>
