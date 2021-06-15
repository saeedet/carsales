<?php
session_start();
include("sql/sql_functions.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">

</head>
<body>
<!--------------------------------- navbar ----------------------------------------------->
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#" style="color: #FF5733; font-weight: bold;">ET CARSALES</a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="advanced-search.php">Search</a>
                </li>
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
    <!--------------------------------------------------- header -------------------------------------------->
    <header class=" header container-fluid">
        <div class="overlay"></div>
        <div class="search-container">
            <div class="search-box">
                <form method="post" action="ex/index_ex.php">
                    <div class="search-form-header">
                        <h2>Find your dream Car!</h2>
                    </div>
                    <div class="search-form-box">
                        <div class="search-form-box-item search-form-box-item-inner-new">
                            <div class="search-form-box-item-inner">
                                <select name="brand" onchange="filter(this.value)">
                                    <option value="" disabled selected hidden>Brand</option>
                                    <option value="any_brand">Any Brand</option>
                                    <?php
                                        $brand_result = brand_options();
                                        foreach ($brand_result as $option1) {
                                            echo "<option value='$option1' style = 'text-transform:capitalize'>$option1</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="search-form-box-item">
                            <div class="search-form-box-item-inner">
                                <select name="model" id="model1">
                                    <option value="" disabled selected hidden id="demo">Model</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-form-box-item">
                            <div class="search-form-box-item-inner">
                                <select name="fuel_type">
                                    <option value="" disabled selected hidden>Fuel Type</option>
                                    <option value="any_fuel">Any Fuel Type</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>

                            </div>
                        </div>
                        <div class="search-form-box-item search-form-box-item-inner-new">
                            <div class="search-form-box-item-inner">
                                <select name="min_price">
                                    <option value="" disabled selected hidden>Price Min</option>
                                    <option value="no_min">No Minimum</option>
                                    <option value="3000">3000</option>
                                    <option value="5000">5000</option>
                                    <option value="7500">7500</option>
                                    <option value="10000">10000</option>
                                    <option value="15000">15000</option>
                                    <option value="20000">20000</option>
                                    <option value="25000">25000</option>
                                    <option value="30000">30000</option>
                                    <option value="35000">35000</option>
                                    <option value="40000">40000</option>
                                    <option value="45000">45000</option>
                                    <option value="50000">50000</option>
                                    <option value="60000">60000</option>
                                    <option value="70000">70000</option>
                                    <option value="80000">80000</option>
                                    <option value="90000">90000</option>
                                    <option value="100000">100000</option>
                                </select>
                            </div>
                        </div>
                        <div class="search-form-box-item">
                            <div class="search-form-box-item-inner">
                                <select name="max_price">
                                    <option value="" disabled selected hidden>Price Max</option>
                                    <option value="no_max">No Maximum</option>
                                    <option value="3000">3000</option>
                                    <option value="5000">5000</option>
                                    <option value="7500">7500</option>
                                    <option value="10000">10000</option>
                                    <option value="15000">15000</option>
                                    <option value="20000">20000</option>
                                    <option value="25000">25000</option>
                                    <option value="30000">30000</option>
                                    <option value="35000">35000</option>
                                    <option value="40000">40000</option>
                                    <option value="45000">45000</option>
                                    <option value="50000">50000</option>
                                    <option value="60000">60000</option>
                                    <option value="70000">70000</option>
                                    <option value="80000">80000</option>
                                    <option value="90000">90000</option>
                                    <option value="100000">100000</option>
                                </select>
                            </div>
                        </div>
                        <div class="search-form-box-item">
                            <div class="search-form-box-item-inner">
                                <select name="transmission">
                                    <option value="" disabled selected hidden id="demo">Transmission</option>
                                    <option value="any_transmission">Any Transmission</option>
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>
                        </div>
                        <div class="search-form-box-footer">
                            <a href="advanced-search.php">Advanced Search+</a>
                        </div>
                    </div>
                    <div class="search-form-submit">
                        <button type="submit" class="submit-button" id="searchBtn">
                            <span>Search!</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <div class="ad-container">
        <div class="overlay2"></div>
        <div class="search-container">
            <h2 class="ad-h">Sell your Old one!</h2>
            <div class="search-box2">
                <form method="post" action="ad_insert.php">
                    <div class="ad-boxx">
                        <div class="ad-submit">
                            <button type="submit" class="submit-button" id="sellBtn">
                                <span>Sell my car</span>
                            </button>
                        </div>
                    </div>

                </form>
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
    <!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->
    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>
