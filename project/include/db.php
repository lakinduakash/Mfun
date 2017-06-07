<?php
$servername = "localhost";
$username = "admin";
$password = "admin@123";
include 'dbselect.php';
$login;

// Create connection
$conn=mysqli_connect($servername,$username,$password,mfun);
if (!$conn){
    die("Connection failed".mysqli_error($conn));
    $login=false;
}
