<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/20/17
 * Time: 11:47 PM
 */
include 'include/chks.php';
if ($_SESSION['ulevel'] == 1) {
    include 'include/db1.php';
} elseif ($_SESSION['ulevel'] == 2) {
    include 'include/db2.php';
} elseif ($_SESSION['ulevel'] == 3) {
    include 'include/db3.php';
} elseif ($_SESSION['ulevel'] == 4) {
    include 'include/db4.php';
} elseif ($_SESSION['ulevel'] == 5) {
    include 'include/db5.php';
} else {
    include 'include/db6.php';
}
$tsales=false;
$csales=false;
$nsales=false;
$result;

if(isset($_POST['csales'])){
    $query="SELECT sid,total FROM c_sales_by_sid ";
    $result=mysqli_query($conn,$query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $csales=true;

}
elseif(isset($_POST['nsales'])) {
    $query="SELECT sid,total FROM n_sales_by_sid ";
    $result=mysqli_query($conn,$query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $nsales=true;

}
elseif(isset($_POST['tsales'])){
    $query="SELECT item_c,total_qty FROM item_sold ";
    $result=mysqli_query($conn,$query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $tsales=true;

}



?>
<!DOCTYPE HTML>

<html>
<head>
    <title>Moratuwa Funiturers</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main1.css" />
    <link rel="stylesheet" href="css/forms.css" />

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
            <li class="dropdown active">
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
            <li style="float:right"><a href="logout.php?logout"><b>Log out! </b><?php echo $_SESSION['name']?></a></li>
        </ul>

    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

<!-- Banner -->
<section id="banner">

</section>

<section id="four" class="wrapper style3 special">
<h3>Reports</h3>

<div class="form">

    <form action="reports.php" method="post">
        Currunt total Sales<br>
        <input class="minib" type="submit" name="csales" value="Submit">
    </form>


<div>
    <?php
    if ($csales){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>SID</th>
            <th>Total</th>

        </tr>
        <?php
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>" .
                "<td>" . $row[0] . "</td> 
                <td>" . $row[1] . "</td> 
                
            </tr>";

        }
        } ?>
    </table>
</div>
</div>



<div class="form">

    <form action="reports.php" method="post">
        Net total Sales<br>
        <input class="minib" type="submit" name="nsales" value="Submit">
    </form>


<div>
    <?php
    if ($nsales){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>SID</th>
            <th>Total</th>

        </tr>
        <?php
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>" .
                "<td>" . $row[0] . "</td> 
                <td>" . $row[1] . "</td> 
                
            </tr>";

        }
        } ?>
    </table>
</div>
</div>
<div class="form">

    <form action="reports.php" method="post" >
        Total Item Solds<br>
        <input class="minib" type="submit" name="tsales" value="Submit">
    </form>

<div>
    <?php
    if ($tsales){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>item_c</th>
            <th>Total</th>

        </tr>
        <?php
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>" .
                "<td>" . $row[0] . "</td> 
                <td>" . $row[1] . "</td> 
                
            </tr>";

        }
        } ?>
    </table>
</div>
</div>
</section>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
