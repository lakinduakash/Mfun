<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/13/17
 * Time: 10:28 AM
 */
if($_SESSION['ulevel']==1){
    include 'include/db1.php';
}
elseif ($_SESSION['ulevel']==2){
    include 'include/db2.php';
}
elseif ($_SESSION['ulevel']==3){
    include 'include/db3.php';
}
elseif ($_SESSION['ulevel']==4){
    include 'include/db4.php';
}
elseif ($_SESSION['ulevel']==5){
    include 'include/db5.php';
}
else {
    include 'include/db6.php';
}