<?php
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
$query;

if (isset($_POST["one"])) {
    $item_c = $_POST['itemc'];
    if ($_SESSION['ulevel'] == 6) {
        $query = "SELECT item_c,price,description FROM Item_p WHERE item_c='$item_c'";
    } else {
        $query = "SELECT item_c,price,qty,description FROM Items WHERE item_c='$item_c'";
    }

    $result = mysqli_query($conn, $query) or die("<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct == 1) {
        $isItem = true;
    }

} else if (isset($_POST["all"])) {

    $item_c = $_POST['itemc'];
    if ($_SESSION['ulevel'] == 6) {
        $query = "SELECT item_c,price,description FROM Item_p";
    } else {
        $query = "SELECT item_c,price,qty,description FROM Items";
    }
    $result = mysqli_query($conn, $query) or die("<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
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
            <li class="active"><a href="itemview.php">View Items</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Admin</a>
                <div class="dropdown-content">
                    <a href="register.php">Add user</a><br>
                    <a href="showroomadd.php">Add show room </a><br>
                    <a href="cusdel.php">Remove Customer</a><br>
                    <a href="cusview.php">View Customers </a><br>
                    <a href="cusup.php">Update customer info</a><br>
                    <a href="orderdel.php">Delete order</a><br>
                    <a href="orderview.php">View Orders</a><br>
                    <a href="itemdel.php">Delete Item</a><br>
                    <a href="showroomview.php">View Showrooms</a><br>
                    <a href="reports.php">Reports</a>


                </div>
            <li style="float:right"><a href="logout.php?logout"><b>Log out </b><?php echo $_SESSION['name']?></a></li>
        </ul>

    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

<!-- Banner -->
<section id="banner">

</section>

<section id="four" class="wrapper style3 special">
<h3>View Items</h3>

<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="itemview.php" method="post">
        Item code
        <input type="text" name="itemc" placeholder="Item code..." required>

        <input type="submit" name="one" value="Submit">
    </form>

<div>
    <?php

    if ($isItem){
    echo "<p>" . $query . " <br/></p>";

    if ($_SESSION['ulevel'] != 6){
    ?>

    <table>
        <tr>
            <th>Item Code</th>
            <th>Price</th>
            <th>qty</th>
            <th>description</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>" .
                "<td>" . $row["item_c"] . "</td>
                <td>" . $row["price"] . "</td> 
                <td>" . $row["qty"] . "</td>
                <td>" . $row["description"] . "</td>
                  </tr>";

        }
    }
    else{

        ?>

        <table>
            <tr>
                <th>Item Code</th>
                <th>Price</th>

                <th>description</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>" .
                    "<td>" . $row["item_c"] . "</td>
                <td>" . $row["price"] . "</td> 
                
                <td>" . $row["description"] . "</td>
                  </tr>";

            } ?>


 <?php   }
} ?>
    </table>
</div>
</div>


<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="itemview.php" method="post">
        View all

        <input type="submit" name="all" value="Submit">
    </form>

<div>
    <?php

    if ($isAll){
    echo "<p>" . $query . " <br/></p>";

    if ($_SESSION['ulevel'] != 6){
    ?>

    <table>
        <tr>
            <th>Item Code</th>
            <th>Price</th>
            <th>qty</th>
            <th>description</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>" .
                "<td>" . $row["item_c"] . "</td>
                <td>" . $row["price"] . "</td> 
                <td>" . $row["qty"] . "</td>
                <td>" . $row["description"] . "</td>
                  </tr>";

        }
        }
        else{

        ?>

        <table>
            <tr>
                <th>Item Code</th>
                <th>Price</th>

                <th>description</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>" .
                    "<td>" . $row["item_c"] . "</td>
                <td>" . $row["price"] . "</td> 
                
                <td>" . $row["description"] . "</td>
                  </tr>";

            } ?>


            <?php   }
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
