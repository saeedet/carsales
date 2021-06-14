<?php
// defining needed variables
session_start();
include_once("../sql/sql_functions.php");
$email = "";
$fname = "";
$lname = "";
$phone = "";
$password = "";


//checking if this is an actual request
if (isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['password'])) {

    $email = strtolower($_POST['email']);
    $fname = strtolower($_POST['fname']);
    $lname = strtolower($_POST['lname']);
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // inserting the member info
    $result = insert_member($email, $fname, $lname, $phone, $password);



    // possible error -> the email already exists
    if ($result['error'] === true) {
        //sending back the user with error details
        $_SESSION['event'] = $result;
        $_SESSION['sticky'] = array('fname'=>$fname,'lname'=>$lname,'phone'=>$phone);
        header("Location: ../sign-up.php");
        exit();
    }
    else{
        // no error go to sign in page with success message
        $_SESSION['messages'] = $result['messages'];
        header("Location: ../login.php");
        exit();
        }

}
else{
    header("Location: ../sign_up.php");
    exit();
}










 ?>
