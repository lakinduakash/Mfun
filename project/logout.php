<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/14/17
 * Time: 9:38 AM
 */
	session_start();

	if (!isset($_SESSION['name'])) {
        header("Location: login.php");
    } else if(isset($_SESSION['name'])!="") {
        header("Location: cusadd.php");
    }

	if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['name']);
        unset($_SESSION['ulevel']);
        header("Location: login.php");
        exit;
    }