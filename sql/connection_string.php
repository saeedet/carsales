<?php
//CONNECTION TO THE DATABASE
$link = mysqli_connect("localhost","root","","carsales");

if (mysqli_connect_errno())
{
    echo mysqli_connect_error();
    exit();
}

?>
