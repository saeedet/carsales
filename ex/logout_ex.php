<?php
session_start();

// LOGING OUT BY UNSETING THE USER SESSION
unset($_SESSION['user']);
header("Location: ../index.php");
exit();


 ?>
