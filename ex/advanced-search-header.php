<?php
// ALL THE VARIABLES ARE USED IN DIFFERENT PARTS OF THE ADVANCED SEARCH PAGE

session_start();
include_once("sql/sql_functions.php");

// Initial table with no selected filter
$initTable = initTable();

//CHecking for autocomplete part
if (isset($_SESSION['keyword'])) {
    $selectedFilters = "";
    $initQuery = $_SESSION['keyword'][1];
    $pageTable = $_SESSION['keyword'][0];
    unset($_SESSION['keyword']);
}
//CHECK IF THIS IS THE RESPOND TO THE FILTER
elseif (isset($_SESSION['newDatabase'])) {
    $initQuery = $_SESSION['searchQuery'];
    $selectedFilters = $_SESSION['selectedFilters'];
    $pageTable = $_SESSION['newDatabase'];
    unset($_SESSION['newDatabase']);
    unset($_SESSION['selectedFilters']);
}
// IF ALL THE ABOVE ARE WRONG THEN THIS IS THE INITIAL VISIT
else{
    $selectedFilters = "";
    $initQuery = make_query_condition("","", "","","", "","","","",[0,2030],[0,10000000]);
    $pageTable = $initTable;
}

 ?>
