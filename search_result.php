<?php
session_start();
$result = $_SESSION['result'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.css"> -->
    <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/fontawesome.css">
    <link href="fonts/fontawesome/css/brands.css" rel="stylesheet">
    <link href="fonts/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/search-result.css">
    <style type="text/css">

        html {
          scroll-behavior: smooth;
        }
        #backToTop{
            display: none;
            /*display: block;*/
            position: fixed;
            width: 40px;
            height: 40px;
            background-color: #ff6333;
            bottom: 30px;
            right: 20px;
            border-radius: 50%;
            text-align: center;
            color: #FFFFFF;
            font-weight: bold;
            opacity: .8;
        }
        #backToTop:hover{
            opacity: 1;

        }
    </style>
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
    <div class="listing-bg">
        <div class="container" style="background-color: transparent; min-height: 200px; padding-top: 20px;">
                    <!-- ECHOES THE RESULTS FETCHED FROM DATABASE -->
                    <!-- different and cleaner strategies could be used here as I did in other pages  -->

                <?php
                    if ($result['error'] === true) {
                        foreach ($result['errors_details'] as $this_error) {
                            echo $this_error;
                        }
                    }
                    else{
                        $counter = 0;
                        foreach ($result['result'] as $this_item) {
                            $counter += 1;
                            $this_class = "";
                            if ($counter > 4) {
                                $this_class = "limitShow";
                            }
                            echo "<div class=' listing row ".$this_class."'>";
                            echo "<div class='car-img'></div>";
                            echo "<br class='clear'>";
                            echo "<div class='img-counter'> <span>4 </span><i class='fas fa-camera'></i></div>";
                            echo "<br class='clear'>";
                            echo "<div class='car-details'>";
                            echo "<div class='row'>";
                            echo "<div class='col'>";
                            echo "<h3 class='car-name'>";
                            echo "<a href='#' style = 'text-transform:capitalize';>".$this_item['year']." ".$this_item['brand']." ".$this_item['model']." ".$this_item['transmission']."</a>";
                            echo "</h3>";
                            echo "</div>";
                            echo "<div class='col-12 text-right price'>";
                            echo "<span>Price: <strong>$".$this_item['price']."</strong></span>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='row'>";
                            echo "<div class='col details-col'>";
                            echo "<ul class='details-li' style = 'text-transform:capitalize'>";
                            echo "<li>".$this_item['kilometers']." km</li>";
                            echo "<li>".$this_item['body_type']."</li>";
                            echo "<li>".$this_item['transmission']."</li>";
                            echo "<li>".$this_item['fuel_type']."</li>";
                            echo "<br class='clear'>";
                            echo "</ul>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br class='clear'>";
                            echo "<div class='line'>";
                            echo "<hr>";
                            echo "</div>";
                            echo "<div class='listing-footer col-12 justify-content-end align-items-center text-right'>";
                            echo "<a href='./car-details.php?ID=".$this_item['ID']."' class='btn btn-primary'>Enquire</a>";
                            echo "<a href='./car-details.php?ID=".$this_item['ID']."' class='btn btn-primary'>View details</a>";
                            echo "</div>";
                            echo "</div>";

                        }
                    }
                 ?>
        </div>
        <br class="clear">
        <div class="seeMore" id="btnKeeper">
            <!--------- for hiding too much items -->
            <?php
                if ($result['error'] === false) {
                    if ($counter > 4) {
                        echo '<button id="tableLimiter">Show more <span id="more"></span></button>';
                    }
                }
             ?>
        </div>
    </div>
    <div><a href="#comeInTop" class="backToTop" id="backToTop"><i class="fa fa-chevron-up"></i></a></div>


<!------------------------------------------------ Footer ----------------------------------------------------------->
    <!-- <br style="clear: both;"> -->
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
                          <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                          <a href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-whatsapp"></i></a>
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
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript">
        // functions for show more and less button and hiding table info when needed
        $(document).ready(function() {
            $('.limitShow').hide();
        });

        $(document).ready(function(){
          $("#tableLimiter").click(function(){
            $(".limitShow").toggle();
            let name = document.getElementById("tableLimiter").innerHTML;
            if (name == 'Show more <span id="more"></span>') {
                console.log("ok")
                document.getElementById("tableLimiter").innerHTML = 'Show less <span id="less"></span>'
            }
            else{
                console.log(name)
                document.getElementById("tableLimiter").innerHTML = 'Show more <span id="more"></span>'
            }
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
</body>
</html>

