<?php

    session_start();
    include_once("../sql/sql_functions.php");
    $username = "";
    $password = "";


    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = strtolower($_POST['username']);
        $password = strtolower($_POST['password']);

        //CHECKING THE USERNAME AND PASSWORD
        $result = users_check($username , $password);

        // HEADING BACK IF THERE IS AN ERROR
        if ($result['error'] === true) {
            $_SESSION['event'] = $result;
            header("Location: ../login.php");
            exit();
        }

        else{
            $_SESSION['user'] = array('admin' => $result['admin'], 'user_info' => $result['user']);

            if ($result['admin'] == false) {
                header("Location: ../index.php");
                exit();
            }
            //HEAD TO DASHBOARD IF THE USER IS AN ADMIN
            else{
                header("Location: ../admin/admin-dashboard.php");
                exit();
            }
        }
    }
    else{
        header("Location: ../login.php");
        exit();
    }

?>
