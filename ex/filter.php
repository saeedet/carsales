<?php
session_start();
include("../sql/sql_functions.php");

// FILTERING OPTIONS IN SELECT TAG USED IN THE LANDING PAGE (index.php)

$fieldname = $_POST['value'];

if ($fieldname == 'any_brand') {
    $model_result = array('Any Model');
    echo json_encode($model_result);
}
else{
    $model_result = model_options($fieldname);
    array_unshift($model_result , 'Any Model');
    echo json_encode($model_result);
}

 ?>
