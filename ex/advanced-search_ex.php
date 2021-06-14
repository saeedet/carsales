<?php
session_start();
include_once("../sql/sql_functions.php");

// checking if it is a request by the form
if (isset($_POST['filter'])) {
    //assigning variables
    $brandSorter = $_POST['brandSorter'];
    $colorSorter = $_POST['colorSorter'];
    $bodySorter = $_POST['bodySorter'];
    $fuelSorter = $_POST['fuelSorter'];
    $kiloSorter = $_POST['kiloSorter'];
    $selectedSorts = array(
        'brand' => $brandSorter,
        'color' => $colorSorter,
        'body_type' => $bodySorter,
        'fuel_type' => $fuelSorter,
        'kilometers' => $kiloSorter
    );

    //CHECKING selected filters and adjusting the result in a proper formation for further use
    $brandResult = check_filters('brand');
    $selectedBrands = $brandResult[0];
    $selectedModels = $brandResult[1];
    $selectedColors = check_filters('color');
    $selectedBody = check_filters('body_type');
    $selectedFuel = check_filters('fuel_type');
    $selectedTrans = check_filters('transmission');
    $selectedKiloRanges = check_filters('kilometers');
    $selectedYearRanges = check_filters('year');
    $selectedPriceRanges = check_filters('price');
    $seatNumbers = check_filters('seats');
    $keyword = $_POST['keyword'];
    $selectedFilters = array(
        'keyword' => $keyword,
        'brand' => $selectedBrands,
        'model' => $selectedModels,
        'color' => $selectedColors,
        'body_type' => $selectedBody,
        'fuel_type' => $selectedFuel,
        'transmission' => $selectedTrans,
        'kilometers' => $selectedKiloRanges,
        'year' => $selectedYearRanges,
        'seats' => $seatNumbers,
        'price' => $selectedPriceRanges,
        'sort' => $selectedSorts
    );

    //UPDATING KEYWORD COUNT
    search_count_update($keyword);

    // MAKING THE SQL QUERY ACCORDING TO THE USER SELECTED FILTERS
    $search_query = make_query_condition($keyword,$selectedBrands, $selectedModels,$selectedColors,$selectedBody, $selectedFuel,$selectedKiloRanges,$selectedTrans,$seatNumbers,$selectedYearRanges, $selectedPriceRanges);

    // FETCHING NEW DATABASE ACCORDING NEW SQL QUERY
    $newDatabase = get_this_table($search_query);

    // HEADING BACK TO SEARCH PAGE FOR SHOWING THE RESULT
    $_SESSION['newDatabase'] = $newDatabase;
    $_SESSION['searchQuery'] = $search_query;
    $_SESSION['selectedFilters'] = $selectedFilters;
    header("Location:../advanced-search.php");
    exit();
}





 ?>
