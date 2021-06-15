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
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/admin-dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/edit-item.css">

</head>
<body>
<!--------------------------------- navbar ----------------------------------------------->

        <nav class="navbar navbar-expand-md" >
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
    <div class="row cont22" id="comeInTop">
        <div class="col-2 opts1-list">
            <div class="dash-head"><h4 style="color: #fff;">Menu</h4></div>
            <ul>
                <li><a href="admin-dashboard.php">General Tables</a></li>
                <li><a href="new-item.php">New Item Submission</a></li>
                <li><a href="#" style="color:#ffffff;">Edit Item</a></li>
                <li><a href="log-show.php">Log File Summary</a></li>
            </ul>
            <br>
            <br>
            <br>
            <hr>
            <form method="post" action="edit-item_ex.php">
                <p style="color: #ffffff; text-align: center;">Edit by ID</p>
                <input type="number" name="id" id="this_id" style="width: 100%;" placeholder="ID...">
                <br><br>
                <div id="butt">
                    <input id="edit1" type="submit" name="edit" value="Edit">
                    <input id="delete1" type="submit" name="delete" value="Delete">
                </div>
            </form>
            <br>
            <br>

            <!-- SHOWING THE FETCHED MESSAGES -->
            <div class="err-show">
             <?php
                if (isset($_SESSION['op_result']) && $_SESSION['op_result']['error'] === true) {
                    echo $_SESSION['op_result']['msg'];
                    unset($_SESSION['op_result']);
                }
             ?>
            </div>
            <div class="msg-show">
             <?php
                if (isset($_SESSION['op_result']) && $_SESSION['op_result']['error'] === false) {
                    echo $_SESSION['op_result']['msg'];
                    unset($_SESSION['op_result']);
                }
             ?>
            </div>

        </div>
        <div class="col-10 cont33">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Database Items <span style="float: right;"></h5>
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
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsShow" style="text-transform: capitalize;">

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

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript">
        //functions for LIVE search
        $(document).ready(function(){
            if($("#this_id").val() == ""){
                $.ajax({
                    type: "POST",
                    url: "autoSearch.php",
                    data:'show=all',

                    success: function(data){
                        $("#itemsShow").html(data);
                    }
                });
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "autoSearch.php",
                    data:'id='+$("#this_id").val(),

                    success: function(data){
                        $("#itemsShow").html(data);
                    }
                });
            }
            $("#this_id").keyup(function(){
                if($("#this_id").val() == ""){
                    $.ajax({
                        type: "POST",
                        url: "autoSearch.php",
                        data:'show=all',

                        success: function(data){
                            $("#itemsShow").html(data);
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "autoSearch.php",
                        data:'id='+$(this).val(),

                        success: function(data){
                            $("#itemsShow").html(data);
                        }
                    });
                }

            });
        });
        window.onscroll = function()
        {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
            {
                document.getElementById('backToTop').style.display= "block";
            }else
            {
                document.getElementById('backToTop').style.display= "none";
            }
        };
    </script>
</body>
</html>
