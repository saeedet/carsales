<?php
session_start();

##Checking if the user is sined IN ---> user has to be a member in order to insert information
if (!isset($_SESSION['user'])){
    $_SESSION['event']['error'] = true;
    $_SESSION['event']['errors_details'] = array("You need to login first!");
    header("Location: login.php");
    exit();
}
include("sql/sql_functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <style type="text/css">
        option{
            text-transform: capitalize;
        }
        select{
            text-transform: capitalize;

        }
    </style>

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
                    <a class="nav-link" href="index.php">Home</a>
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
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
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
    <div class="container">
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Your car Information</h5>
                    <div class="card-body">
                        <form method="post" action="ex/ad_insert_ex.php">
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Brand</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select name="brand" onchange="filter(this.value)" class="form-control" required="">
                                        <option value="" disabled selected hidden>Brand</option>
                                        <!-- fetching brands and models from database ---- members can not insert new brands Only Admin has the ability to do so -->
                                        <?php
                                            $brand_result = brand_options();
                                            foreach ($brand_result as $option1) {
                                                echo "<option value='$option1' style = 'text-transform:capitalize'>$option1</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Model</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select name="model" id="model1" class="form-control" required="">
                                        <option value="" disabled selected hidden id="demo">Model</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Body type</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" name="body_type" required="" placeholder="Type something" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Year</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" name="year" required="" placeholder="Type something" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Kilometers</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" name="kilometers" required="" placeholder="Type something" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Color</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" name="color" required="" placeholder="Type something" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Seats</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input required="" name="seats" type="number" min="2" max="10" placeholder="Number of Seats" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Price</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" name="price" required="" placeholder="Type something" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-sm-right">Transmission</label>
                                <div class="col-sm-6">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                            <input id="ck1" name="transmission" type="radio" required="" value="automatic" class="custom-control-input"><span class="custom-control-label">Automatic</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input id="ck2" name="transmission" type="radio" required="" value="manual" class="custom-control-input"><span class="custom-control-label">Manual</span>
                                        </label>
                                        <div id="error-container1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-sm-right">Feul type</label>
                                <div class="col-sm-6">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                            <input type="radio" required=""  name="fuel_type" id="e1" class="custom-control-input" value="petrol"><span class="custom-control-label">Petrol</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="radio" required=""  name="fuel_type" id="e2" class="custom-control-input" value="hybrid"><span class="custom-control-label">Hybrid</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="radio" required=""  name="fuel_type" id="e3" class="custom-control-input" value="diesel"><span class="custom-control-label">Diesel</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="radio" required=""  name="fuel_type" id="e4" class="custom-control-input" value="diesel"><span class="custom-control-label">Premium</span>
                                        </label>
                                        <div id="error-container2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Description</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <textarea name="description" class="form-control" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                    <p>This carsales website is designed from the scratch for the final project of the subject MTS9307 undertaken by Saeed ET for the course of Master of Information Technology.</p>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Contact</h6>
                    <p>18 Binda street, Keiraville, NSW, Australia
                    <br/>Se383@uowmail.edu.au
                    <br/>+ 61 423 274 765
                    <br/>+ 61 423 274 765
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
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">


        // JavaScript for checkboxes
        $('input[type="checkbox"]').on('change', function() {
            $(this).siblings('input[type="checkbox"]').prop('checked', false);
        });
        // Windows height adjustment
        $(document).ready(function(){
          $('.header').height($(window).height());
        })


        // used in filter dropdown
        function removeOption(){
            $('#model1').find('option').remove()
        }
        // used in filter dropdown
        function addOption(it1) {
            optionText = it1;
            optionValue = it1;
            $('#model1').append(`<option value="${optionValue}"> ${optionText} </option>`);

        }
        // filter dropdown for fetching the database distinct brands and models
        function filter(item){

            $.ajax({
                type: "POST",
                url: "ex/filter.php",
                data: { value: item},
                success:function(data){

                    removeOption();
                    for (var i=0; i<data.length-1; i++){
                        addOption(data[i+1])
                    }

                },
                dataType:"json"
            });
        }

    </script>
</body>
</html>
