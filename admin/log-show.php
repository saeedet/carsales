<?php
session_start();
include_once("../sql/sql_functions.php");

// fetching log data
$result = read_log();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>ET Car Sales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Links to required pages -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="./../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/admin-dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/log-show.css">
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
                    <a class="nav-link" href="../index.php" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../advanced-search.php"">Search</a>
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
                <li><a href="edit-item.php">Edit Item</a></li>
                <li><a href="#" style="color:#ffffff;">Log File Summary</a></li>
            </ul>
        </div>
        <div class="col-10 cont33">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Logs Details for the Last 7 Days</h5>
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">USER ID</th>
                                        <th scope="col">Operation</th>
                                        <th scope="col">Result</th>
                                        <th scope="col">Affected Table</th>
                                        <th scope="col">Affected Row</th>
                                        <th scope="col">Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsShow" style="text-transform: capitalize;">
                                        <!-- echoing  log information -->
                                    <?php

                                        foreach ($result as $this_item) {
                                            echo "<tr>";
                                            echo "<td>".$this_item['user_id']."</td>";
                                            echo "<td>".$this_item['operation']."</td>";
                                            if ($this_item['result'] == 'successfull') {
                                                $rowResult = 'suc';
                                            }
                                            else{
                                                $rowResult = 'fai';
                                            }
                                            echo "<td id='".$rowResult."'>".$this_item['result']."</td>";
                                            echo "<td>".$this_item['affected_table']."</td>";
                                            echo "<td>".$this_item['affected_row_id']."</td>";
                                            echo "<td>".$this_item['timestamp']."</td>";
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

    <div><a href="#comeInTop" class="backToTop" id="backToTop"><i class="fa fa-chevron-up"></i></a></div>

<!--------------------------- including javascript pages --------------------------->

    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
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
