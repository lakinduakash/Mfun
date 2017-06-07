<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/14/17
 * Time: 10:14 AM
 */
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}