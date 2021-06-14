
<?php
    session_start();

    // including steaky feature for the sign up form
    // values echoed in different parts of the form
    include("sticky.php");

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V7</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="animate/animate.css">
    <link rel="stylesheet" type="text/css" href="animate/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="animate/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util-login.css">
    <link rel="stylesheet" type="text/css" href="css/main-login.css">
    <style type="text/css">

        .incorrect{
            border-bottom:3px solid red;
        }
        .correct{
            border-bottom:3px solid green;
        }
    </style>
</head>
<body>


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
                    <a class="nav-link" href="index.php#contactMe">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contactMe">Contact</a>
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

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-90 p-b-30">
                <form class="login100-form validate-form" method="post" action="ex/sign_up_ex.php">
                    <span class="login100-form-title p-b-40">
                        Sign up using
                    </span>

                    <div>
                        <a href="#" class="btn-login-with bg1 m-b-10">
                            <i class="fa fa-facebook-official"></i>
                            Facebook
                        </a>

                        <a href="#" class="btn-login-with bg2">
                            <i class="fa fa-twitter"></i>
                            Twitter
                        </a>
                    </div>

                    <div class="text-center p-t-55 p-b-30">
                        <span class="txt1">
                            Or
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16 <?php give_the_class('incorrect'); ?>">
                        <input class="input100" type="email" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-16 <?php give_the_class('correct'); ?>">
                        <input class="input100" type="text" name="fname" placeholder="First Name" required value="<?php echo sticky_info('fname'); ?>">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-16 <?php give_the_class('correct'); ?>">
                        <input class="input100" type="text" name="lname" placeholder="Last Name" required value="<?php echo sticky_info('lname'); ?>">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-16 <?php give_the_class('correct'); ?>">
                        <input class="input100" type="tel" name="phone" placeholder="Phone Number" required value="<?php echo sticky_info('phone'); ?>">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="btn-show-pass">
                            <i class="fa fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Sign up
                        </button>
                    </div>
                    <!-- WHERE ERRORS AND ESSAGES SHOW UP -->
                    <?php include(__DIR__."/error_show.php"); unset($_SESSION['sticky']);?>
                    <div class="flex-col-c p-t-224">
                        <span class="txt2 p-b-10">
                            You have an account?
                        </span>

                        <a href="login.php" class="txt3 bo1 hov1">
                            Login here!
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="animate/animsition/js/animsition.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="animate/select2/select2.min.js"></script>
    <script src="js/main-login.js"></script>

</body>
</html>
