<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/28/17
 * Time: 12:30 PM
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
$isItem = false;
$isAll = false;
$result;

if (isset($_POST["one"])) {
    $sid = $_POST['sid'];
    $query = "SELECT sid,distric FROM Showroom WHERE sid='$sid'";
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct == 1) {
        $isItem = true;
    }

} else if (isset($_POST["all"])) {

    $item_c = $_POST['itemc'];
    $query = "SELECT sid,distric FROM Showroom" ;
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct > 0) {
        $isAll = true;
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

<h3>View Showrooms</h3>

<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="showroomview.php" method="post">
        Showroom ID
        <input type="number" name="sid" placeholder="Showroom Id..." required>

        <input type="submit" name="one" value="Submit">
    </form>

<div>
    <?php
    if ($isItem){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>SID</th>
            <th>Distric</th>

        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>" .
                "<td>" . $row["sid"] . "</td>
                <td>" . $row["distric"] . "</td>
               </tr>";

        }
        } ?>
    </table>
</div>
</div>



<div class="form">

    <form action="showroomview.php" method="post">
        View all

        <input type="submit" name="all" value="Submit">
    </form>

<div>
    <?php
    if ($isAll){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>SID</th>
            <th>Distric</th>

        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>" .
                "<td>" . $row["sid"] . "</td> 
                <td>" . $row["distric"] . "</td> 
                
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
