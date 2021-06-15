<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../fonts/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/brands.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/solid.css">
    <link rel="stylesheet" type="text/css" href="../css/admin-dashboard.css">

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
                    <a class="nav-link" href="../index.php" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../advanced-search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">

                    <?php
                        if (isset($_SESSION['user'])) {
                            echo "<a class='nav-link logOut' href='../ex/logout_ex.php'>Logout</a>";
                        }
                        else{
                            echo "<a class='nav-link logIn' href='../login.php'>Login</a>";
                        }
                     ?>
                </li>
            </ul>
        </div>
    </nav>


<!--------------------------------------------------- body -------------------------------------------->
    <div class="row cont22">
        <div class="col-2 opts1-list">
            <div class="dash-head"><h4 style="color: #fff;">Menu</h4></div>
            <ul>
                <li><a href="admin-dashboard.php">General Tables</a></li>
                <li><a href="#" style="color:#ffffff;">New Item Submission</a></li>
                <li><a href="edit-item.php">Edit Item</a></li>
                <li><a href="log-show.php">Log File Summary</a></li>
            </ul>
        </div>
        <div class="col-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Adding New Item</h5>
                            <div class="card-body">
                                <form method="post" action="edit-item_ex.php">
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Brand</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="brand" required="" placeholder="Brand..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Model</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="model" required="" placeholder="Model..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Body type</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="body_type" required="" placeholder="Sedan..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Color</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="color" required="" placeholder="White..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Year</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="year" required="" placeholder="2018..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Kilometers</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="kilometers" required="" placeholder="40,000..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Seats</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input required="" name="seats" type="number" min="2" max="10"  class="form-control"  placeholder="4...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Price</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="price" required="" class="form-control"  placeholder="$...">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-sm-right">Transmission</label>
                                        <div class="col-sm-6">
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-checkbox">
                                                    <input id="ck1" name="transmission" required="" type="radio" value="automatic" class="custom-control-input"><span class="custom-control-label">Automatic</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input id="ck2" name="transmission" required="" type="radio" value="manual" class="custom-control-input"><span class="custom-control-label">Manual</span>
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
                                                    <input type="radio" required=""  name="fuel_type"  class="custom-control-input" value="petrol"><span class="custom-control-label">Petrol</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="radio" required=""  name="fuel_type"  class="custom-control-input" value="hybrid"><span class="custom-control-label">Hybrid</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="radio" required=""  name="fuel_type"  class="custom-control-input" value="diesel"><span class="custom-control-label">Diesel</span>
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
                                            <button type="submit" name="new_item" class="btn btn-space btn-primary">Submit</button>
                                            <button class="btn btn-space btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!--------------------------- including javascript pages --------------------------->

    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
