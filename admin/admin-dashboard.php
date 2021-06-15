<?php
session_start();
include_once("../sql/sql_functions.php");

// fetching data for general tables
$result = general_tables();
$result2 = last_items();
$members_table = $result['member_result'];
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
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.css">
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
                <li><a href="#" style="color:#ffffff;">General Tables</a></li>
                <li><a href="new-item.php">New Item Submission</a></li>
                <li><a href="edit-item.php">Edit Item</a></li>
                <li><a href="log-show.php">Log File Summary</a></li>
            </ul>
        </div>

        <div class="col-10 cont33">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">General Tables </h2>
                            <hr>
                            <br>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <!------------------------------------------------------------ TABLE 1 -->
                                <h5 class="card-header">Last Added Items</h5>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Brand</th>
                                                <th scope="col">Color</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($result2 as $this_item) {
                                                    echo "<tr>";
                                                    echo "<th>".$this_item['ID']."</th>";
                                                    echo "<td>".$this_item['brand']."</td>";
                                                    echo "<td>".$this_item['color']."</td>";
                                                    echo "<td>".$this_item['year']."</td>";
                                                    echo "<td>$".$this_item['price']."</td>";
                                                    echo "</tr>";
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">New Members</h5>
                                <div class="card-body">
                                <!------------------------------------------------------------ TABLE 2 -->
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">F Name</th>
                                                <th scope="col">L Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                foreach ($members_table as $this_item) {
                                                    echo "<tr>";
                                                    echo "<th>".$this_item['ID']."</th>";
                                                    echo "<td>".$this_item['fname']."</td>";
                                                    echo "<td>".$this_item['lname']."</td>";
                                                    echo "<td>".$this_item['email']."</td>";
                                                    echo "<td>".$this_item['phone']."</td>";
                                                    echo "</tr>";
                                                }
                                             ?>
                                        </tbody>
                                    </table>
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
