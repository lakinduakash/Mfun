<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 6/3/17
 * Time: 1:04 AM
 */
$servername = "localhost";
$username = "customer";
$password = "customer@123";
include 'dbselect.php';
$login;

// Create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);
if (!$conn){
    die("Connection failed".mysqli_error($conn));
    $login=false;
}