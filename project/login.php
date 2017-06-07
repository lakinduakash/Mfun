<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/14/17
 * Time: 2:25 AM
 */
session_start();
if (isset($_SESSION['name'])){
    header("Location:cusadd.php");
    exit();
}

if (isset($_POST['loginc'])){
    $_SESSION['name']="customer";
    $_SESSION['ulevel']=6;
    $_SESSION['sid']=0;
    header("Location:orderview.php");
    exit();
}

include 'include/db1.php';
$login=true;
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["pass"]);

    $uname = strip_tags($uname);
    $upass = strip_tags($upass);

    // password encrypt using SHA256();
    $password = hash('sha256', $upass);

    // check email exist or not
    $query = "SELECT uname,ulevel,sid FROM Users WHERE uname='$uname' and password='$password'";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $count=mysqli_num_rows($result);

    if ($count==1){
        $row=mysqli_fetch_row($result);

        $_SESSION['name']=$row[0];
        $_SESSION['ulevel']=$row[1];
        $_SESSION['sid']=$row[2];

        echo "Hi".$row['uname'];

            echo $_SESSION['name'];
            header("Location:cusadd.php");

    }
    else{
        $login=false;

    }
}

    ?>

<!DOCTYPE HTML>

<html>
<head>
    <title>Moratuwa Funiturers</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="assets/css/main1.css" />

</head>
<body class="landing">

<!-- Header -->
<header id="header" class="alt">
    <nav id="nav">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="cusadd.php">New Customer</a></li>
            <li><a href="orderadd.php" >Add Order</a></li>
            <li><a href="orderup.php">Update Order</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Stock</a>
                <div class="dropdown-content">
                    <a href="itemup.php">New stock</a>
                    <a href="itemadd.php">New Item</a>
                </div>
            <li><a href="orderview.php">View Orders</a></li>
            <li><a href="itemview.php">View Items</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Admin</a>
                <div class="dropdown-content">
                    <a href="register.php">Add user</a>
                    <a href="showroomadd.php">Add show room </a>
                    <a href="cusdel.php">Remove Customer</a>
                    <a href="cusview.php">View Customers </a>
                    <a href="cusup.php">Update customer info</a>
                    <a href="orderdel.php">Delete order</a>
                    <a href="orderview.php">View Orders</a>
                    <a href="itemdel.php">Delete Item</a>
                    <a href="showroomview.php">View Showrooms</a>
                    <a href="reports.php">Reports</a>


                </div>
        </ul>

    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

<!-- Banner -->
<section id="banner">

</section>

<section id="four" class="wrapper style3 special">
    <h3>Login</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>?a" >
            <?php
            if($login==false){
                echo '';
                ?>
                <p style="color: #f21040">Invalid login! Enter again</p><br>
            <?php }
            ?>
            Username
            <input type="text"  name="uname" placeholder="username..." required>
            Password
            <input type="password"  name="pass" placeholder="New Password..." required>

            <input type="submit" name="login" value="Login">
        </form>
    </div>
    <div class="form">
        <form method="post" action="login.php">
        <h3>Customer?</h3> <br>
        <input class="minib" type="submit" name="loginc" value="login">
        </form>

    </div>

</section>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

    </body>
    </html>