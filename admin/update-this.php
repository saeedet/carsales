<?php
session_start();

//getting steaky infos
$result = $_SESSION['update_this'];
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
        <a class="navbar-brand" href="#">Logo</a>
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
                <li><a href="new-item.php">New Item Submission</a></li>
                <li><a href="edit-item.php" style="color:#ffffff;">Edit Item</a></li>
                <li><a href="log-show.php">Log File Summary</a></li>
            </ul>
        </div>
        <div class="col-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Update Item</h5>
                            <div class="card-body">
                                <form method="post" action="edit-item_ex.php">
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Brand</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="brand" required="" placeholder="Type something" class="form-control" value="<?php echo $result[0]['brand'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Model</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="model" required=""  placeholder="Type something" class="form-control" value="<?php echo $result[0]['model'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Body type</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="body_type" required=""  placeholder="Type something" class="form-control" value="<?php echo $result[0]['body_type'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Year</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="year" required="" placeholder="Type something" class="form-control" value="<?php echo $result[0]['year'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Kilometers</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="kilometers" required="" placeholder="Type something" class="form-control" value="<?php echo $result[0]['kilometers'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Color</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" name="color" required=""  placeholder="Type something" class="form-control" value="<?php echo $result[0]['color'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Seats</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input required="" name="seats" type="number" min="2" max="10" placeholder="Number of Seats" class="form-control" value="<?php echo $result[0]['seats'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Price</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="number" name="price" required=""  placeholder="Type something" class="form-control" value="<?php echo $result[0]['price'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-sm-right">Transmission</label>
                                        <div class="col-sm-6">
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-checkbox">
                                                    <input id="ck1" name="transmission" type="radio" required=""  value="automatic"   class="custom-control-input" <?php if ($result[0]['transmission'] == 'automatic') {echo "checked=''";} ?>><span class="custom-control-label">Automatic</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input id="ck2" name="transmission" type="radio" required=""  value="manual"  class="custom-control-input" <?php if ($result[0]['transmission'] == 'manual') {echo "checked=''";} ?>><span class="custom-control-label">Manual</span>
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
                                                    <input type="radio" required=""  name="fuel_type" id="e1"  class="custom-control-input" value="petrol" <?php if ($result[0]['fuel_type'] == 'petrol') {echo "checked=''";} ?>><span class="custom-control-label">Petrol</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="radio" required=""  name="fuel_type" id="e2"  class="custom-control-input" value="hybrid" <?php if ($result[0]['fuel_type'] == 'hybrid') {echo "checked=''";} ?>><span class="custom-control-label">Hybrid</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="radio" required=""  name="fuel_type" id="e3"  class="custom-control-input" value="diesel" <?php if ($result[0]['fuel_type'] == 'diesel') {echo "checked=''";} ?>><span class="custom-control-label">Diesel</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="radio" required=""  name="fuel_type" id="e4"  class="custom-control-input" value="diesel" <?php if ($result[0]['fuel_type'] == 'premium') {echo "checked=''";} ?>><span class="custom-control-label">Premium</span>
                                                </label>
                                                <div id="error-container2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Description</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <textarea name="description" class="form-control">
                                                    <?php
                                                        echo $result[0]['description'];
                                                     ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                            <button type="submit" name="update_this" class="btn btn-space btn-primary">Update</button>
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
