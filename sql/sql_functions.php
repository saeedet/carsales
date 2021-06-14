<?php

include_once(__DIR__."/connection_string.php");


// Function for making sql query regarding the selected filters by the user integrated with keyword
function make_query_condition($keyword,$brand, $model,$color,$body_type, $fuel_type,$kilometers,$transmission,$seats,$year, $price,$kilo=false){

    $search_query = " WHERE `price` BETWEEN $price[0] AND $price[1] AND ";

    if (empty($brand) && empty($model) && !empty($keyword)) {
        $search_query .= " ( `brand` LIKE '". $keyword ."%' OR `model` LIKE '". $keyword ."%' ) AND ";
    }
    elseif (!empty($brand) && empty($model) && empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($brand) ; $i++) {
            $search_query .= " `brand` = '$brand[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }
    elseif (empty($brand) && !empty($model) && empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($model) ; $i++) {
            $search_query .= " `model` = '$model[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }
    elseif (!empty($brand) && empty($model) && !empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($brand) ; $i++) {
            $search_query .= "`brand` LIKE '". $keyword ."%' AND `brand` = '$brand[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }
    elseif (empty($brand) && !empty($model) && !empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($model) ; $i++) {
            $search_query .= "`model` LIKE '". $keyword ."%' AND `model` = '$model[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }
    elseif (!empty($brand) && !empty($model) && empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($brand) ; $i++) {
            $search_query .= " `brand` = '$brand[$i]' OR ";
        }
        for ($i=0; $i < count($model) ; $i++) {
            $search_query .= " `model` = '$model[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }
    elseif (!empty($brand) && !empty($model) && !empty($keyword)) {
        $search_query .= " (";
        for ($i=0; $i < count($brand) ; $i++) {
            $search_query .= "`brand` LIKE '". $keyword ."%' AND `brand` = '$brand[$i]' OR ";
        }
        for ($i=0; $i < count($model) ; $i++) {
            $search_query .= "`model` LIKE '". $keyword ."%' AND `model` = '$model[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= " ) AND";
    }

    //for color
    if (!empty($color)) {
        $search_query .= "(";
        for ($i=0; $i < count($color) ; $i++){
            $search_query .= "`color` = '$color[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= ") AND ";
    }

    // for body type
    if (!empty($body_type)) {
        $search_query .= "(";
        for ($i=0; $i < count($body_type) ; $i++){
            $search_query .= "`body_type` = '$body_type[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= ") AND ";
    }

    //for fuel type
    if (!empty($fuel_type)) {
        $search_query .= "(";
        for ($i=0; $i < count($fuel_type) ; $i++){
            $search_query .= "`fuel_type` = '$fuel_type[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= ") AND ";
    }

    //for fuel transmission
    if (!empty($transmission)) {
        $search_query .= "(";
        for ($i=0; $i < count($transmission) ; $i++){
            $search_query .= "`transmission` = '$transmission[$i]' OR ";
        }
        $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
        $search_query .= ") AND ";
    }
    if (!empty($seats)) {
        $search_query .= "`seats` = '$seats' AND ";
    }

    // Going for normal operation
    if (!$kilo) {
        if (!empty($kilometers)) {
            $search_query .= "(";
            for ($i=0; $i < count($kilometers) ; $i++){
                $kilo1 = $kilometers[$i][0];
                $kilo2 = $kilometers[$i][1]-1;
                $search_query .= "`kilometers` BETWEEN $kilo1 AND $kilo2 OR ";
            }
            $search_query = preg_replace('/\W\w+\s*(\W*)$/', '$1', $search_query);
            $search_query .= ") AND ";
        }
        $search_query .= "`year` BETWEEN $year[0] AND $year[1]";
    }

    // For range count operation
    else{
        $search_query .= "`year` BETWEEN $year[0] AND $year[1] AND ";
        $kilo1 = $kilometers[0];
        $kilo2 = $kilometers[1];
        $search_query .= "`kilometers` BETWEEN $kilo1 AND $kilo2";
    }
    return $search_query;
}

// Getting all the Items For the first time visit
function initTable(){
    GLOBAL $link;
    $result = array();

    $sql = mysqli_query($link, "SELECT * FROM `car_info` ORDER BY ID DESC");

    while ($row = mysqli_fetch_array($sql)) {

        $this_item = array(
                            'ID' => $row['ID'],
                            'brand' => $row['brand'],
                            'model' => $row['model'],
                            'body_type' => $row['body_type'],
                            'year' => $row['year'],
                            'kilometers' => $row['kilometers'],
                            'fuel_type' => $row['fuel_type'],
                            'transmission' => $row['transmission'],
                            'color' => $row['color'],
                            'seats' => $row['seats'],
                            'price' => $row['price']
        );
        array_push($result, $this_item);
    }

    return $result;
}

//Function for autocomplete AJAX response
function searches($keyword){
    GLOBAL $link;
    $result = array();

    $query = "SELECT * FROM `keywords` WHERE `keyword` LIKE '". $keyword ."%' ORDER BY `count` DESC LIMIT 3";
    $sql = mysqli_query($link,$query);
    while ($row = mysqli_fetch_array($sql)) {
        array_push($result, $row['keyword']);
    }
    return $result;
}

// Updating keyword count
function search_count_update($item){
   GLOBAL $link;

   $query = "UPDATE `keywords` SET `count` = `count`+1 WHERE `keyword` = '$item'";
   mysqli_query($link,$query);
}

// Function for returning an Item information by its ID
function get_this_item($ID){
    GLOBAL $link;
    $result = array();

    $sql = mysqli_query($link, "SELECT * FROM `car_info` WHERE `ID` = $ID");
    while ($row = mysqli_fetch_array($sql)){
        $this_item = array(
                            'ID' => $row['ID'],
                            'brand' => $row['brand'],
                            'model' => $row['model'],
                            'body_type' => $row['body_type'],
                            'year' => $row['year'],
                            'kilometers' => $row['kilometers'],
                            'fuel_type' => $row['fuel_type'],
                            'transmission' => $row['transmission'],
                            'color' => $row['color'],
                            'seats' => $row['seats'],
                            'price' => $row['price'],
                            'description' => $row['description']
        );
        array_push($result, $this_item);
    }

    return $result;
}

// Getting DISTINCT models regarding the brand
function get_models($brand){
    GLOBAL $link;
    $result = array();

    $sql = mysqli_query($link, "SELECT DISTINCT `model` FROM `car_info` WHERE `brand` = '$brand'");
    while ($row = mysqli_fetch_array($sql)){
        array_push($result, $row[0]);
    }
    return $result;
}

// Getting distinct item in a category
function get_distinct($name){
    GLOBAL $link;
    $result= array();

    $sql = mysqli_query($link, "SELECT DISTINCT `$name` FROM `car_info`");
    while ($row = mysqli_fetch_array($sql)){
        array_push($result, $row[0]);
    }
    return $result;
}

// Checking the selected filters by the user and make required adjustment for the further usage
function check_filters($cat){
    switch ($cat) {
        case 'brand':
            $selectedBrands = array();
            $selectedModels = array();
            $result = get_distinct('brand');
            foreach ($result as $key) {
                if (isset($_POST[$key])) {
                    array_push($selectedBrands, $key);
                }
                else{
                    $modelResult = get_models($key);
                    foreach ($modelResult as $key2) {
                        if (isset($_POST[$key2])) {
                            array_push($selectedModels,$key2);
                        }
                    }
                }
            }
            return array($selectedBrands,$selectedModels);
            break;
        case 'color':
        case 'body_type':
        case 'fuel_type':
        case 'transmission':
            $selectedCat = array();
            $result = get_distinct($cat);
            foreach ($result as $key) {
                if (isset($_POST[$key])) {
                    array_push($selectedCat, $key);
                }
            }
            return $selectedCat;
            break;
        case 'kilometers':
            $selectedRange = array();
            $ranges = [[0,10000],[10000,40000],[40000,100000],[100000,1000000]];
            foreach ($ranges as $key) {
                $name = strval($key[0])."-".strval($key[1]);
                if (isset($_POST[$name])) {
                    array_push($selectedRange, $key);
                }
            }
            return $selectedRange;
            break;
        case 'year':
            $selectedRange = array();
            if (!empty($_POST['yearMin'])) {
                array_push($selectedRange, $_POST['yearMin']);
            }
            else{
                array_push($selectedRange, 0);
            }
            if (!empty($_POST['yearMax'])) {
                array_push($selectedRange, $_POST['yearMax']);
            }
            else{
                array_push($selectedRange, 2030);
            }
            return $selectedRange;
            break;
        case 'price':
            $selectedRange = array();
            if (!empty($_POST['priceMin'])) {
                array_push($selectedRange, $_POST['priceMin']);
            }
            else{
                array_push($selectedRange, 0);
            }
            if (!empty($_POST['priceMax'])) {
                array_push($selectedRange, $_POST['priceMax']);
            }
            else{
                array_push($selectedRange, 3000000);
            }
            return $selectedRange;
            break;
        case 'seats':
            $seatNumber = "";
            if (!empty($_POST['seats'])) {
                $seatNumber = $_POST['seats'];
            }
            return $seatNumber;
            break;
    }
}

//Getting the new table with new query
function get_this_table($searchQuery){
    GLOBAL $link;
    $result = array();
    $query = "SELECT * FROM `car_info`";
    $query .= $searchQuery;
    $sql = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($sql)) {

        $this_item = array(
                            'ID' => $row['ID'],
                            'brand' => $row['brand'],
                            'model' => $row['model'],
                            'body_type' => $row['body_type'],
                            'year' => $row['year'],
                            'kilometers' => $row['kilometers'],
                            'fuel_type' => $row['fuel_type'],
                            'transmission' => $row['transmission'],
                            'color' => $row['color'],
                            'seats' => $row['seats'],
                            'price' => $row['price']
        );
        array_push($result, $this_item);
    }

    return $result;
}

// Function used for showing the user the inputs with previous selected filters and appropriate sorts
function give_me_sorted_inputs($sort,$database,$category,$query,$selectedFilters){

    switch ($sort) {
        case 'default':
        switch ($category) {
            case 'brand':

                $result = get_unique($database,$category); # bayad be tartib biad ---> tartib ya count ya name ya default
                echo "<ul>";
                foreach ($result as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $count = get_this_count2($query,$key,$category);
                    echo "<li>";
                        echo "<input type='checkbox' name='$key' class='brand' id='$key' $checked>";
                        echo "<label for='$key'>$key</label>";
                        echo "<span class='qnt'>".$count."</span>";
                        echo "<ul class='pl-4'>";
                        $modelResult = get_unique_models($database,$key);
                        foreach ($modelResult as $key2) {
                            $checked2 = "";
                            if (!empty($selectedFilters)) {
                                if (in_array($key2, $selectedFilters['model'])){
                                    $checked2 = "checked=''";
                                }
                            }
                            $count = get_this_count2($query,$key2,'model');
                            echo "<li>";
                                echo "<input type='checkbox' name='$key2' class='model' id='$key2' $checked2>";
                                echo "<label for='$key2'>$key2</label>";
                                echo "<span class='qnt2'>".$count."</span>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    echo "</li>";
                    echo "</ul>";
                }
                break;
            case 'color':
            case 'body_type':
            case 'fuel_type':
            case 'transmission':
                $cat_inputs = get_unique($database,$category);
                echo "<ul>";
                foreach ($cat_inputs as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $count = get_this_count2($query,$key,$category);
                    echo "<li>";
                        echo "<input type='checkbox' name='$key' class='".$category."' id='$key' $checked>";
                        echo "<label for='$key'>$key</label>";
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
            case 'kilometers':
                $ranges = [[0,10000],[10000,40000],[40000,100000],[100000,1000000]];
                $queryRanges = [[0,9999],[10000,39999],[40000,99999],[100000,1000000]];
                echo "<ul>";
                $qr = 0;
                foreach ($ranges as $key) {
                    $checked = "";
                    if (!empty($selectedFilters[$category])) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                            $count = get_kilo_count($queryRanges[$qr],$selectedFilters);
                        }
                        else{
                            $count = 0;
                        }
                    }
                    else{
                        $count = get_kilo_count($queryRanges[$qr],$selectedFilters);

                    }
                    $qr += 1;
                    echo "<li>";
                        echo "<input type='checkbox' name='".$key[0]."-".$key[1]."' class='".$category."' id='".$key[0]."-".$key[1]."' $checked>";
                        if ($key[1]>100000) {
                            echo "<label for='".$key[0]."-".$key[1]."'>+".$key[0]." KM</label>";
                        }
                        else{
                            echo "<label for='".$key[0]."-".$key[1]."'>".$key[0]."-".$key[1]." KM</label>";
                        }
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
        }

            break;
        case 'name':
        switch ($category) {
            case 'brand':
                $result = get_unique($database,$category);
                sort($result);
                echo "<ul>";
                foreach ($result as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $count = get_this_count2($query,$key,$category);
                    echo "<li>";
                        echo "<input type='checkbox' name='$key' class='brand' id='$key' $checked>";
                        echo "<label for='$key'>$key</label>";
                        echo "<span class='qnt'>".$count."</span>";
                        echo "<ul class='pl-4'>";
                        $modelResult = get_unique_models($database,$key);
                        sort($modelResult);
                        foreach ($modelResult as $key2) {
                            $count = get_this_count2($query,$key2,'model');
                            echo "<li>";
                                echo "<input type='checkbox' name='$key2' class='model' id='$key2'>";
                                echo "<label for='$key2'>$key2</label>";
                                echo "<span class='qnt2'>".$count."</span>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    echo "</li>";
                    echo "</ul>";
                }
                break;
            case 'color':
            case 'body_type':
            case 'fuel_type':
            case 'transmission':
                $cat_inputs = get_unique($database,$category);
                sort($cat_inputs);
                echo "<ul>";
                foreach ($cat_inputs as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $count = get_this_count2($query,$key,$category);
                    echo "<li>";
                        echo "<input type='checkbox' name='$key' class='".$category."' id='$key' $checked>";
                        echo "<label for='$key'>$key</label>";
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
            case 'kilometers':
                $ranges = [[0,10000],[10000,40000],[40000,100000],[100000,1000000]];
                $queryRanges = [[0,9999],[10000,39999],[40000,99999],[100000,1000000]];
                echo "<ul>";
                $qr = 0;
                foreach ($ranges as $key) {
                    $checked = "";
                    if (!empty($selectedFilters[$category])) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                            $count = get_kilo_count($queryRanges[$qr],$selectedFilters);
                        }
                        else{
                            $count = 0;
                        }
                    }
                    else{
                        $count = get_kilo_count($queryRanges[$qr],$selectedFilters);
                    }
                    $qr += 1;
                        echo "<li>";
                        echo "<input type='checkbox' name='".$key[0]."-".$key[1]."' class='".$category."' id='".$key[0]."-".$key[1]."' $checked>";
                        if ($key[1]>100000) {
                            echo "<label for='".$key[0]."-".$key[1]."'>+".$key[0]." KM</label>";
                        }
                        else{
                            echo "<label for='".$key[0]."-".$key[1]."'>".$key[0]."-".$key[1]." KM</label>";
                        }
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
        }
            break;
        case 'count':
        switch ($category) {
            case 'brand':
                $result = sort_this_by_count($category,$database,$query);
                echo "<ul>";
                foreach ($result as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $brand = $key['brand'];
                    $count = $key['count'];
                    echo "<li>";
                        echo "<input type='checkbox' name='$brand' class='brand' id='$brand' $checked>";
                        echo "<label for='$brand'>$brand</label>";
                        echo "<span class='qnt'>".$count."</span>";
                        echo "<ul class='pl-4'>";
                        $modelResult = sort_this_by_count_model($brand,$database,$query);
                        foreach ($modelResult as $key2) {
                            // $count = get_this_count($query,$key2,'model');
                            $model = $key2['model'];
                            $count = $key2['count'];
                            echo "<li>";
                                echo "<input type='checkbox' name='$model' class='model' id='$model'>";
                                echo "<label for='$model'>$model</label>";
                                echo "<span class='qnt2'>".$count."</span>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    echo "</li>";
                    echo "</ul>";
                }
                break;
            case 'color':
            case 'body_type':
            case 'fuel_type':
            case 'transmission':
                $cat_inputs = sort_this_by_count($category,$database,$query);
                echo "<ul>";
                foreach ($cat_inputs as $key) {
                    $checked = "";
                    if (!empty($selectedFilters)) {
                        if (in_array($key, $selectedFilters[$category])){
                            $checked = "checked=''";
                        }
                    }
                    $name = $key[$category];
                    $count = $key['count'];
                    // $count = get_this_count($query,$key,$category);
                    echo "<li>";
                        echo "<input type='checkbox' name='$name' class='".$category."' id='$name' $checked>";
                        echo "<label for='$name'>$name</label>";
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
            case 'kilometers':

                $ranges = sort_kilo_by_count($selectedFilters);
                echo "<ul>";
                foreach ($ranges as $key) {
                    $checked = "";
                    if (!empty($selectedFilters[$category])) {
                        // it means user has chosen one or more of the ranges
                        if (in_array($key['range'], $selectedFilters[$category])){
                            $checked = "checked=''";
                            $count = $key['count'];
                        }
                        else{
                            $count = 0;
                        }
                    }
                    else{
                        $count = $key['count'];
                    }
                    $name = $key['range'];
                    echo "<li>";
                        echo "<input type='checkbox' name='".$name[0]."-".$name[1]."' class='".$category."' id='".$name[0]."-".$name[1]."' $checked>";
                        if ($name[1]>100000) {
                            echo "<label for='".$name[0]."-".$name[1]."'>+".$name[0]." KM</label>";
                        }
                        else{
                            echo "<label for='".$name[0]."-".$name[1]."'>".$name[0]."-".$name[1]." KM</label>";
                        }
                        echo "<span class='qnt'>".$count."</span>";
                    echo "</li>";
                }
                echo "</ul>";
                break;
        }
            break;

    }
}

// Sorting fetched arrays only for models used in above function
function sort_this_by_count_model($brand,$database,$query){
    $sorted_array = array();
    $modelResult = get_unique_models($database,$brand);
    foreach ($modelResult as $key) {
        $count = get_this_count2($query,$key,'model');
        array_push($sorted_array, array('model' => $key ,'count' => $count));
    }
    $sorted_array = array_sort($sorted_array, 'count', SORT_DESC);
    return $sorted_array;
}

// Sorting fetched arrays for all categories used in above function
function sort_this_by_count($category,$database,$query){
    $sorted_array = array();
    $uniqItems = get_unique($database,$category);

    foreach ($uniqItems as $key) {
        $count = get_this_count2($query,$key,$category);
        array_push($sorted_array, array($category => $key ,'count' => $count));
    }
    $sorted_array = array_sort($sorted_array, 'count', SORT_DESC);
    return $sorted_array;
}
// Sorting kilo ranges result
function sort_kilo_by_count($selectedFilters){
    $sorted_array = array();
    $queryRanges = [[0,9999],[10000,39999],[40000,99999],[100000,1000000]];
    $ranges = [[0,10000],[10000,40000],[40000,100000],[100000,1000000]];
    $i =0 ;
    foreach ($queryRanges as $key) {
        $count = get_kilo_count($key,$selectedFilters);
        array_push($sorted_array, array('range' => $ranges[$i] ,'count' => $count));
        $i +=1;
    }
    $sorted_array = array_sort($sorted_array, 'count', SORT_DESC);
    return $sorted_array;
}
// getting the item counts for numberic ranges intervals
function get_kilo_count($item,$selectedFilters){
    GLOBAL $link;
    $final_result = 0;
    $res = array();
    if (!empty($selectedFilters)) {
        $newQuery = make_query_condition($selectedFilters['keyword'],$selectedFilters['brand'], $selectedFilters['model'],$selectedFilters['color'],$selectedFilters['body_type'], $selectedFilters['fuel_type'],$item,$selectedFilters['transmission'],$selectedFilters['seats'],$selectedFilters['year'], $selectedFilters['price'],true);
        $qr = "SELECT * FROM `car_info`". $newQuery;
        $sql = mysqli_query($link, $qr);
        while ($row = mysqli_fetch_array($sql)) {
            array_push($res, $row);
        }
    }
    else{
        $initQuery = make_query_condition("","", "","","", "",$item,"","",[0,2030],[0,10000000],true);
        $qr = "SELECT * FROM `car_info`". $initQuery;
        $sql = mysqli_query($link, $qr);
        while ($row = mysqli_fetch_array($sql)) {
            array_push($res, $row);
        }
    }
    $final_result = count($res);
    return $final_result;
}
// getting the item counts from the database
function get_this_count2($query,$item,$category){
    GLOBAL $link;
    $result= array();
    $final_result = 0;
    $qr = "SELECT $category,COUNT($category) AS count FROM `car_info`". $query . " GROUP BY $category";
    $sql = mysqli_query($link, $qr);
    while ($row = mysqli_fetch_array($sql)){
        $this_item = array($category => $row[0], 'count' => $row[1]);
        array_push($result, $this_item);
    }

    foreach ($result as $thisItem) {
        if ($thisItem[$category] == $item) {
            $final_result = $thisItem['count'];
        }
    }


    return $final_result;
}

// Getting DISTINCT items from database regarding the category
function get_unique($database,$category){
    $this_cat = array();
    foreach ($database as $key) {
        array_push($this_cat, $key[$category]);
    }
    $uniq_arr = array_unique($this_cat);
    $uniq_this = array();
    foreach ($uniq_arr as $key) {
        array_push($uniq_this, $key);
    }
    return $uniq_this;
}

// Getting DISTINCT models from database regarding the brand
function get_unique_models($database,$brand){
    $this_cat = array();
    foreach ($database as $key) {
        if ($key['brand'] == $brand) {
            array_push($this_cat, $key['model']);
        }
    }
    $uniq_arr = array_unique($this_cat);
    $uniq_this = array();
    foreach ($uniq_arr as $key) {
        array_push($uniq_this, $key);
    }
    return $uniq_this;
}

//function for sorting array with arrays inside
function array_sort($array, $on, $order=SORT_ASC){
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

// function for echoing sort select options used in search page
function echo_sorts($selectedSorts, $category){
    $allSorts = ['default', 'name', 'count'];
    if (!empty($selectedSorts)) {
        echo '<option value="'.$selectedSorts.'" id="brandSort">Sort by '.$selectedSorts.'</option>';
        foreach ($allSorts as $key) {
            if ($key != $selectedSorts) {
                echo '<option value="'.$key.'" id="brandSort">Sort by '.$key.'</option>';
            }
        }
    }
    else{
        foreach ($allSorts as $key) {
            echo '<option value="'.$key.'" id="brandSort">Sort by '.$key.'</option>';
        }
    }
}

// Function for regular search in the landing page
function search($brand, $model, $fuel_type, $min_price, $max_price,$transmission){

    GLOBAL $link;
    $error = false;
    $errors_details = array();
    $result = array();

    $search_query = "SELECT * FROM `car_info` WHERE ";

    if ($brand != "any_brand") {
        $search_query .= "`brand` = '$brand' AND ";
    }
    if ($model != "any_model") {
        $search_query .= "`model` = '$model' AND ";
    }
    if ($transmission != "any_transmission") {
        $search_query .= "`transmission` = '$transmission' AND ";
    }
    if ($fuel_type != "any_fuel") {
        $search_query .= "`fuel_type` = '$fuel_type' AND ";
    }

    $search_query .= "`price` BETWEEN $min_price AND $max_price";

    $sql = mysqli_query($link, $search_query);

        while ($row = mysqli_fetch_array($sql)) {

            $this_item = array(
                                'ID' => $row['ID'],
                                'brand' => $row['brand'],
                                'model' => $row['model'],
                                'body_type' => $row['body_type'],
                                'year' => $row['year'],
                                'kilometers' => $row['kilometers'],
                                'fuel_type' => $row['fuel_type'],
                                'transmission' => $row['transmission'],
                                'color' => $row['color'],
                                'seats' => $row['seats'],
                                'price' => $row['price']
            );
            array_push($result, $this_item);
        }


    if(!$result){
        $error = true;
        array_push($errors_details, "NO MATCHED ITEM");
    }

    return array(
            'result' => $result,
            'error' => $error,
            'errors_details' => $errors_details

    );
}

// Function for inserting NEW ITEMS
function add_item($brand, $model , $price, $body_type, $transmission, $year, $seats, $color, $fuel_type, $kilometers, $description, $user_id){

    GLOBAL $link;
    $msg = "";
    $error = false;

    mysqli_query($link , "INSERT INTO `car_info`(`member_id`, `brand`, `model`, `body_type`, `year`, `kilometers`, `fuel_type`, `transmission`, `color`, `seats`, `price`, `description`)
                                        VALUES ($user_id,'$brand','$model','$body_type',$year,$kilometers,'$fuel_type','$transmission','$color',$seats,$price, '$description')");



    if (mysqli_affected_rows($link) == -1) {
        log_this("admin", "insert", "failed", "car_info", "");
        $msg = "Insert Failed!";
        $error = true;
    }
    else{
        $sql = mysqli_query($link , "SELECT ID FROM `car_info` WHERE ID = (SELECT MAX(ID) FROM `car_info`)");
        $row = mysqli_fetch_array($sql);
        log_this("admin", "insert", "successfull", "car_info", $row[0]);
        $msg = "Successfully inserted.";
    }
    return $result = array('msg' => $msg, 'error' => $error);
}

// User validation function
function users_check($username, $password){
    GLOBAL $link;
    $user = array();
    $admin = false;
    $error = false;
    $errors_details = array();

    $sql = mysqli_query($link , "SELECT * FROM `admins`
                                                        WHERE
                                                                `username` = '$username' AND `password` = '$password'");
    if ($row = mysqli_fetch_array($sql))
    {
        $user = array(
                        'ID' => $row['ID'],
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name']
                        );
        $admin = true;
    }

    if ($admin === false) {

        $sql = mysqli_query($link , "SELECT * FROM `member_info`
                                                                WHERE
                                                                        `email` = '$username' AND `password` = '$password'");

        if ($row = mysqli_fetch_array($sql))
        {
            $user = array(
                            'ID' => $row['ID'],
                            'fname' => $row['fname'],
                            'lname' => $row['lname']
                            );
        }
        else
        {
            $error = true;
            array_push($errors_details, "Wrong username or password!");
        }

    }
    return array(
                    'admin' => $admin,
                    'error' => $error ,
                    'errors_details' => $errors_details ,
                    'user' => $user
                    );
}

//Member insert function
function insert_member($email, $fname, $lname, $phone, $password){
    GLOBAL $link;
    $error = false;
    $errors_details = array();
    $messages = array();
    $sql = mysqli_query($link , "SELECT `email` FROM `member_info`");
    $emails = array();
    while ($row = mysqli_fetch_array($sql)){
        array_push($emails, $row);
    }
    // echo var_dump($emails);
    // exit();
    foreach ($emails as $key) {
        if ($key[0] == $email) {
            $error = true;
            array_push($errors_details, "This email is already a member!");
            break;
        }
    }
    if ($error === false) {
        mysqli_query($link , "INSERT INTO `member_info`(`fname`, `lname`, `email`, `password`, `phone_no`)
                                    VALUES ('$fname', '$lname', '$email', '$password', $phone)");
        array_push($messages, "Signed up successfully!");
    }


    return array(
                    'error' => $error ,
                    'errors_details' => $errors_details ,
                    'messages' => $messages
                    );
}

// Getting distinct brands for the landing page
function brand_options(){
    GLOBAL $link;
    $result = array();

    $sql = mysqli_query($link , "SELECT DISTINCT `brand` FROM `car_info`");


    while ($row = mysqli_fetch_array($sql)){
        $this_item = $row['brand'];
        array_push($result, $this_item);
    }



    return $result;
}

// Getting distinct models for the landing page
function model_options($brand){
    GLOBAL $link;
    $result = array();


    $sql = mysqli_query($link, "SELECT DISTINCT `model` FROM `car_info` WHERE `brand` = '$brand'");


    while ($row = mysqli_fetch_array($sql)){
        $this_item = $row['model'];
        array_push($result, $this_item);
    }


    return $result;
}

// for admin general tables
function general_tables(){
    GLOBAL $link;
    $car_result = array();
    $member_result = array();

    $sql1 = mysqli_query($link, "SELECT * FROM `car_info` ORDER BY ID DESC LIMIT 5");
    $sql2 = mysqli_query($link, "SELECT * FROM `member_info` ORDER BY ID DESC LIMIT 5");


    while ($row = mysqli_fetch_array($sql1)){

        $this_item = array(
                            'ID' => $row['ID'],
                            'brand' => $row['brand'],
                            'model' => $row['model'],
                            'year' => $row['year'],
                            'price' => $row['price']
        );
        array_push($car_result, $this_item);
    }

    while ($row = mysqli_fetch_array($sql2)){

        $this_item = array(
                            'ID' => $row['ID'],
                            'fname' => $row['fname'],
                            'lname' => $row['lname'],
                            'email' => $row['email'],
                            'phone' => $row['phone_no']
        );
        array_push($member_result, $this_item);
    }

    return array(
            'car_result' => $car_result,
            'member_result' => $member_result

    );
}

// Function for logging the information
function log_this($us_id, $op, $res, $table, $row){

    date_default_timezone_set('Australia/Sydney');
    $t = time();
    $timeRecord = date("Y-m-d h:i:s A", $t);

    $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/logs.txt", "a") or die("Unable to open file!");
    $txt = "$us_id,$op,$res,$table,$row,$timeRecord";
    fwrite($myfile, "\n". $txt);
    fclose($myfile);
}

//Function for reading logs to the admin dashboard
function read_log(){
    $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/logs.txt", "r") or die("Unable to open file!");
    $fp = file($_SERVER['DOCUMENT_ROOT'].'/logs.txt');
    $lineCount = count($fp);
    $result = array();
    date_default_timezone_set('Australia/Sydney');


    for ($i=0; $i < $lineCount; $i++) {
        $th = fgetcsv($myfile);
        if(strtotime($th[5]) > strtotime('-7 days')) {
            $this_item = array(
                                'user_id' => $th[0],
                                'operation' => $th[1],
                                'result' => $th[2],
                                'affected_table' => $th[3],
                                'affected_row_id' => $th[4],
                                'timestamp' => $th[5]
            );
            array_push($result,$this_item);
        }
    }
    fclose($myfile);
    return array_reverse($result);
}

//for general tables
function last_items(){
    GLOBAL $link;
    $result = array();

    $sql = mysqli_query($link, "SELECT * FROM `car_info` ORDER BY ID DESC LIMIt 5");

    while ($row = mysqli_fetch_array($sql)){

        $this_item = array(
                            'ID' => $row['ID'],
                            'brand' => $row['brand'],
                            'color' => $row['color'],
                            'year' => $row['year'],
                            'price' => $row['price']
        );
        array_push($result, $this_item);
    }

    return $result;
}

//Function for updating Items
function update_item($ID,$brand,$model,$body_type,$year,$kilometers,$fuel_type,$transmission,$color,$seats,$price){
    GLOBAL $link;
    $msg = "";
    $error = false;

    mysqli_query($link , "UPDATE `car_info` SET `brand`='$brand',`model`='$model',
                                        `body_type`='$body_type',`year`=$year,`kilometers`=$kilometers,
                                            `fuel_type`='$fuel_type',`transmission`='$transmission',`color`='$color',
                                                `seats`=$seats,`price`=$price WHERE `ID` = $ID");
    if (mysqli_affected_rows($link) == -1) {
        log_this("admin", "update", "failed", "car_info", "");
        $msg = "Update Failed!";
        $error = true;
    }
    else{
        log_this("admin", "update", "successfull", "car_info", $ID);
        $msg = "Successfully updated.";
    }
    return $result = array('msg' => $msg, 'error' => $error);
}

//Function for deleting item
function delete_item($ID){
    GLOBAL $link;
    $msg = "";
    $error = false;

    mysqli_query($link , "DELETE FROM `car_info` WHERE `ID` = $ID");
    if (mysqli_affected_rows($link) == -1) {
        log_this("admin", "delete", "failed", "car_info", $ID);
        $msg = "Delete Failed!";
        $error = true;
    }
    else{
        log_this("admin", "delete", "successfull", "car_info", $ID);
        $msg = "Successfully deleted.";
    }
    return $result = array('msg' => $msg, 'error' => $error);
}

 ?>
