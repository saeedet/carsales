<?php
session_start();
include_once("./sql/sql_functions.php");
//getting the car information
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];
}
$car_id = $_GET['ID'];
$this_item = get_this_item($car_id);
?>
<!-- The fetched information then echoed in differend parts of pre-designed CARD -->

<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/fontawesome.css">
    <link href="fonts/fontawesome/css/brands.css" rel="stylesheet">
    <link href="fonts/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/car-details.css">

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

    <div class="container cont1">
        <div class="row">
            <div class="col-12 car-details-header">
                <h1 style = 'text-transform:capitalize'><?php echo $this_item[0]['brand']." ".$this_item[0]['model']." ".$this_item[0]['year']; ?></h1>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="images/11.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="images/2323.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="images/ch1.jpg" alt="Third slide">
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                    </div>
                </div>
                <div class="row info-sec">
                    <div class="col-3">
                        <div class="row">
                            <div class="col-3 ppp-icon">
                                <i class="fas fa-tachometer-alt " style="color: #6e6e6e;"></i>
                            </div>
                            <div class="col-9 inf1">
                                <span style = 'text-transform:capitalize'><?php echo $this_item[0]['kilometers']; ?></span>
                                <p>Odometer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-3 ppp-icon">
                                <i class="fas fa-car" style="color: #6e6e6e;"></i>
                            </div>
                            <div class="col-9 inf1">
                                <span style = 'text-transform:capitalize'><?php echo $this_item[0]['body_type']; ?></span>
                                <p>Body Type</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-3 ppp-icon">
                                <i class="fas fa-gas-pump" style="color: #6e6e6e;"></i>
                            </div>
                            <div class="col-9 inf1">
                                <span style = 'text-transform:capitalize'><?php echo $this_item[0]['fuel_type']; ?></span>
                                <p>Fuel Type</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-3 ppp-icon">
                                <i class="fas fa-cogs" style="color: #6e6e6e;"></i>
                            </div>
                            <div class="col-9 inf1">
                                <span style = 'text-transform:capitalize'><?php echo $this_item[0]['transmission']; ?></span>
                                <p>Transmission</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <br>
                        <h5>Seller Comment</h5>
                        <p style="color: #6e6e6e;">
                            <?php echo $this_item[0]['description']; ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <br>
                        <h5><strong>Overview</strong></h5>
                        <br>
                    </div>
                    <div class="col-4 car-overview">
                        <ul>
                            <li>Vehicle</li>
                            <li>Price</li>
                            <li>Kilometers</li>
                            <li>Color</li>
                            <li>Transmission</li>
                            <li>Fuel Type</li>
                            <li>Seats</li>
                            <li>Body Type</li>
                        </ul>
                    </div>
                    <div class="col-8 car-overview-answers">
                        <ul style = 'text-transform:capitalize'>
                            <li>Toyota Yaris 2006</li>
                            <li>$<?php echo $this_item[0]['price']; ?></li>
                            <li><?php echo $this_item[0]['kilometers']; ?></li>
                            <li><?php echo $this_item[0]['color']; ?></li>
                            <li><?php echo $this_item[0]['transmission']; ?></li>
                            <li><?php echo $this_item[0]['fuel_type']; ?></li>
                            <li><?php echo $this_item[0]['seats']; ?></li>
                            <li><?php echo $this_item[0]['body_type']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4 enquiry-card">
                <div class="this-price">
                    <span><strong>$<?php echo $this_item[0]['price'] ?></strong></span>
                </div>
                <hr>
                <div class="enquiry-form">
                    <h4>Enquiry on this car</h4>
                    <form class="form-style-7">
                        <ul>
                            <li>
                                <label for="name">Name</label>
                                <input type="text" name="name" maxlength="100">
                                <span>Enter your full name here</span>
                            </li>
                            <li>
                                <label for="email">Email</label>
                                <input type="email" name="email" maxlength="100">
                                <span>Enter a valid email address</span>
                            </li>
                            <li>
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" maxlength="100">
                                <span>Enter your phone number</span>
                            </li>
                            <li>
                                <label for="message">Message</label>
                                <textarea name="msg" onkeyup="adjust_textarea(this)"></textarea>
                                <span>Comment or Message for the seller</span>
                            </li>
                            <li>
                                <input type="submit" value="Send Enquiry" >
                            </li>
                        </ul>
                    </form>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8"><h3 style="margin-bottom: 4px;">Call the seller</h3></div>
                    <div class="col-4 pp-icon"><i class="fas fa-phone-alt"></i></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8 pp-address">
                        <h3 style="margin-bottom: 10px;">Location</h3>
                        <span>Australia, </span>
                        <span>NSW, Keiraville, 2500</span>
                    </div>
                    <div class="col-4 pp-icon"><i class="fas fa-map-marker-alt"></i></div>
                </div>
                <div>
                    <h3>       <i class=""></i></h3>
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
                <div class="col-lg-4 col-md-4 col-sm-12" id="contactMe">
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
    <script type="text/javascript">
    //auto expand textarea
        function adjust_textarea(h) {
            h.style.height = "20px";
            h.style.height = (h.scrollHeight)+"px";
        }
    </script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/carousel.js" ></script>
    <script type="text/javascript" src="js/util.js" ></script>
</body>
</html>
