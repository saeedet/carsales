<?php
include("./ex/advanced-search-header.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/main-ad-search.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/advanced-search.css">


</head>
<body>
<!--------------------------------- navbar ----------------------------------------------->
    <nav class="navbar navbar-expand-md" id="comeInTop">
        <a class="navbar-brand" href="#" style="color: #FF5733; font-weight: bold;">ET CARSALES</a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">Search</a>
                </li>
                <!-- Checking if the user is admin for a link to admin dashboard -->
                <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']['admin'] === true) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="admin/admin-dashboard.php">Dashboard</a>';
                        echo '</li>';
                    }
                 ?>
                <li class="nav-item">
                    <a class="nav-link" href="#contactMe">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactMe">Contact</a>
                </li>
                <li class="nav-item">
                    <!-- Checking if the user is loged in for the proper links -->
                    <?php
                        if (isset($_SESSION['user'])) {
                            echo "<a class='nav-link logOut' href='ex/logout_ex.php'>Logout</a>";
                        }
                        else{
                            echo "<a class='nav-link logIn' href='login.php'>Login</a>";
                        }
                     ?>

                </li>

            </ul>
        </div>
    </nav>
<!--------------------------------------------------- body -------------------------------------------->

    <div class="row cont22">
        <div class="col-2 opts1-list">
        <!---------------------------------- filter inputs form ---->
            <form method="post" action="ex/advanced-search_ex.php">
                <div class="dash-head" style=" padding-bottom: 3px;">
                <!---------------------------------------------------- AUTO COMPLETE KEYWORD SEARCH -->
                    <p style="margin-bottom: 5px; padding-top: 5px;"><b>SEARCH</b></p>
                    <input type="text" id="search-box" name="keyword" placeholder="keyword..." autocomplete="off" value="<?php if (!empty($selectedFilters)){ echo $selectedFilters['keyword']; } ?>">
                    <div id="suggesstion-box" class="autocomplete-items" style="width: 100%;  margin-top: opx;">
                    </div>
                </div>
                <hr>
                <!---------------------------------------------------- FIRST FILTER BRAND AND MODELS -->
                <p><b>BRANDS</b><b style="float: right;">Qty</b></p>
                <div id="brands">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['brand'];
                        }
                        else{
                            $sort = 'default';
                        }
                        give_me_sorted_inputs($sort,$initTable,'brand',$initQuery,$selectedFilters);
                     ?>
                </div>
                <select name="brandSorter">
                    <!-- fetching the sort options and their position -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['brand'];
                        }
                        else{
                            $sort = "";
                        }
                        echo_sorts($sort, 'brand');
                     ?>
                </select>
                <hr>
                <!---------------------------------------------------- SECOND FILTER COLORS -->
                <p><b>COLOR</b><b style="float: right;">Qty</b></p>
                <div id="colors">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['color'];
                        }
                        else{
                            $sort = 'default';
                        }
                        give_me_sorted_inputs($sort,$initTable,'color',$initQuery,$selectedFilters);
                     ?>
                </div>
                <select name="colorSorter">
                    <!-- fetching the sort options and their position -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['color'];
                        }
                        else{
                            $sort = "";
                        }
                        echo_sorts($sort, 'color');
                     ?>
                </select>
                <hr>
                <!---------------------------------------------------- THIRD FILTER BODY TYPE -->
                <p><b>BODY TYPE</b><b style="float: right;">Qty</b></p>
                <div id="body_type">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php

                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['body_type'];
                        }
                        else{
                            $sort = 'default';
                        }
                        give_me_sorted_inputs($sort,$initTable,'body_type',$initQuery,$selectedFilters);

                     ?>
                </div>
                <select name="bodySorter">
                    <!-- fetching the sort options and their position -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['body_type'];
                        }
                        else{
                            $sort = "";
                        }
                        echo_sorts($sort, 'body_type');
                     ?>
                </select>
                <hr>
                <!---------------------------------------------------- FOURTH FILTER FUEL TYPE -->
                <p><b>FUEL TYPE</b><b style="float: right;">Qty</b></p>
                <div id="fuel_type">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['fuel_type'];
                        }
                        else{
                            $sort = 'default';
                        }
                        give_me_sorted_inputs($sort,$initTable,'fuel_type',$initQuery,$selectedFilters);
                     ?>
                </div>
                <select name="fuelSorter">
                    <!-- fetching the sort options and their position -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['fuel_type'];
                        }
                        else{
                            $sort = "";
                        }
                        echo_sorts($sort, 'fuel_type');
                     ?>
                </select>
                <hr>
                <!---------------------------------------------------- FIFTH FILTER KILOMETERS -->
                <p><b>KILOMETERS</b><b style="float: right;">Qty</b></p>
                <div id="kilometers">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['kilometers'];
                        }
                        else{
                            $sort = 'default';
                        }
                        give_me_sorted_inputs($sort,$initTable,'kilometers',$initQuery,$selectedFilters);
                     ?>
                </div>
                <select name="kiloSorter">
                    <!-- fetching the sort options and their position -->
                    <?php
                        if (!empty($selectedFilters)) {
                            $sort = $selectedFilters['sort']['kilometers'];
                        }
                        else{
                            $sort = "";
                        }
                        echo_sorts($sort, 'kilometers');
                     ?>
                </select>
                <hr>
                <!---------------------------------------------------- SIXTH FILTER TRANSMISSION -->
                <p><b>TRANSMISSION</b><b style="float: right;">Qty</b></p>
                <div id="transmission">
                    <!-- Every time fetches the inputs with their select status and proper sorts -->
                    <?php give_me_sorted_inputs('default',$initTable,'transmission',$initQuery,$selectedFilters); ?>
                </div>
                <hr>
                <!---------------------------------------------------- SEVENTH FILTER YEAR -->
                <p><b>YEAR</b></p>
                <input type="number" name="yearMin" id="yearMin" placeholder="Min Year" value="<?php if (!empty($selectedFilters) && $selectedFilters['year'][0] != 0){ echo $selectedFilters['year'][0]; } ?>">
                <p></p>
                <input type="number" name="yearMax" id="yearMax" placeholder="Max Year" value="<?php if (!empty($selectedFilters) && $selectedFilters['year'][1] != 2030){ echo $selectedFilters['year'][1]; } ?>">
                <hr>
                <!---------------------------------------------------- EIGHTH FILTER SEATS -->
                <p><b>SEATS</b></p>
                <input type="number" name="seats" id="seats" placeholder="Number of Seats" value="<?php if (!empty($selectedFilters)){ echo $selectedFilters['seats']; } ?>">
                <hr>
                <!---------------------------------------------------- EIGHTH FILTER PRICE -->
                <p><b>PRICE</b></p>
                <input type="number" name="priceMin" id="priceMin" placeholder="Min Price" value="<?php if (!empty($selectedFilters) && $selectedFilters['price'][0] != 0){ echo $selectedFilters['price'][0]; } ?>">
                <p></p>
                <input type="number" name="priceMax" id="priceMax" placeholder="Max Price" value="<?php if (!empty($selectedFilters) && $selectedFilters['price'][1] != 3000000){ echo $selectedFilters['price'][1]; } ?>">
                <hr>
                <!---------------------------------------------------- BUTTONS -->
                <div class="btnSticky">
                    <button type="button"  onclick="reset_this()" id="reset">Reset</button>
                    <button type="submit" id="filter" name="filter" ><span>Filter </span></button>
                </div>
                <hr>
            </form>

 <!---------------------------------------------------- TABLE DESIGNE PART ---------------------------->
        </div>
        <div class="col-10 cont33">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Database Items <span style="float: right;"><span id="tb_count"></span> Items Found</span></h5>
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Body</th>
                                        <th scope="col">Transmission</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Kilometers</th>
                                        <th scope="col">Fuel</th>
                                        <th scope="col">Seats</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsShow" style="text-transform: capitalize;">
                                    <!-- Where Table shows info using PHP and JS. More info down in JavaScript part -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="seeMore" id="btnKeeper"></div>
                    <div><a href="#comeInTop" class="backToTop" id="backToTop"><i class="fa fa-chevron-up"></i></a></div>
                </div>
            </div>
        </div>
    </div>

<!------------------------------------------------ Footer ----------------------------------------------------------->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Project Information</h6>
                    <p>This carsales website is designed from the scratch for the final project of the subject MTS9307.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12" id="contactMe">
                    <h6 class="text-uppercase font-weight-bold">Contact</h6>
                    <p>18 Binda street, Keiraville, NSW, Australia
                    <br/>SSSSS@uowmail.edu.au
                    <br/>+ 61 444 244 444
                    <br/>+ 61 444 244 444
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 footer-icons">
                    <h6 class="text-uppercase font-weight-bold">Follow us</h6>
                    <ul>
                        <li>
                          <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                          <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-whatsapp"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright text-center">© 2020 Copyright. All rights reserved!<br>Designed by: <a href="#">Saeed ET</a></div>
        </div>
    </footer>
<!--------------------------- including javascript pages --------------------------->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
        // fetching the Filtered Database into Json
        var database = <?php  echo  json_encode($pageTable);  ?>;
        makeTable(database)

        // Function for making proper table
        function makeTable(database){
            var myTable = ""
            var tableLimit = 0;
            var rowClass = "";
            var manyItems = false;
            for(x in database){
                tableLimit += 1

                if (tableLimit > 20) {
                    rowClass = "limitShow";
                    manyItems = true;
                }
                myTable += "<tr class='"+rowClass+"'>"+
                            "<td>"+database[x].ID+"</td>"+
                            "<td>"+database[x].brand+"</td>"+
                            "<td>"+database[x].model+"</td>"+
                            "<td>"+database[x].color+"</td>"+
                            "<td>"+database[x].body_type+"</td>"+
                            "<td>"+database[x].transmission+"</td>"+
                            "<td>"+database[x].year+"</td>"+
                            "<td>"+database[x].kilometers+"</td>"+
                            "<td>"+database[x].fuel_type+"</td>"+
                            "<td>"+database[x].seats+"</td>"+
                            "<td>$"+database[x].price+"</td>"+
                            "<td>"+"<a href='car-details.php?ID="+database[x].ID+"'>See more</a></td>"+
                            "</tr>";
            }
            if (manyItems === true) {
                document.getElementById("btnKeeper").innerHTML = '<button id="tableLimiter">Show more <span id="more"></span></button>'
                manyItems = false
                rowClass = ""
            }


            document.getElementById("itemsShow").innerHTML = myTable;
            document.getElementById("tb_count").innerHTML = tableLimit;
        }
        // function for reset button
        function reset_this(){
            location.reload();
            return false;
        }

        // Hide too much information in the table
        $(document).ready(function() {
            $('.limitShow').hide();
        });

        // Functioning of the Show more/less button for table
        $(document).ready(function(){
          $("#tableLimiter").click(function(){
            $(".limitShow").toggle();
            let name = document.getElementById("tableLimiter").innerHTML;
            if (name == 'Show more <span id="more"></span>') {
                document.getElementById("tableLimiter").innerHTML = 'Show less <span id="less"></span>'
            }
            else{
                console.log(name)
                document.getElementById("tableLimiter").innerHTML = 'Show more <span id="more"></span>'
            }
          });
        });
        ////////// AJAX for autocomplete
        $(document).ready(function(){
            $("#search-box").keyup(function(){
                $.ajax({
                type: "POST",
                url: "./ex/autocomplete.php",
                data:'keyword='+$(this).val(),

                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background","#FFF");
                }
                });
            });
        });
        function selectText(val) {
            $("#search-box").val(val);
            $("#suggesstion-box").hide();
        }
        $(document).ready(function(){
            $('#filter').click(function(){
                $.ajax({
                    type:"POST",
                    url:"./ex/advanced_ex.php",
                    data:'keyword='+ document.getElementById("search-box").value.toLowerCase(),

                    success: function(data){
                    }
                });
            });
        });
        window.onscroll = function()
        {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
            {
                document.getElementById('backToTop').style.display= "block"
            }else
            {
                document.getElementById('backToTop').style.display= "none";
            }
        };
    </script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>

