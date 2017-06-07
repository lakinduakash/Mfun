<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/28/17
 * Time: 12:30 PM
 */
include 'include/chks.php';
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

$c_found=false;
$isAll=false;
$result;
if(isset($_POST['chk'])) {


    $idn=trim($_POST["idn"]);



    // check email exist or not
    $query = "SELECT cid,fname,lname,line_1,line_2,line_3,city,tel,email,idn,notes,uname FROM Customer WHERE idn='$idn'";
    $result=mysqli_query($conn,$query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $count=mysqli_num_rows($result);
    if ($count>0) {

        $c_found = true;

    }
    else {
        echo "<p>" . $query . " <br/></p>";
        echo "No customer found";
    }




}
if(isset($_POST['all'])) {





    $query = "SELECT cid,fname,lname,line_1,line_2,line_3,city,tel,email,idn,notes,uname FROM Customer";
    $result=mysqli_query($conn,$query)  or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $count=mysqli_num_rows($result);
    if ($count>0) {

        $isAll = true;

    }
    else {
        echo "<p>" . $query . " <br/></p>";
        echo "No customer found";
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

    <h3>View Customer</h3>

    <div class="form">
        <form action="cusview.php" METHOD="post">

            ID number
            <input type="text" id="idn" name="idn" placeholder="ID number..." required>


            <input class="minib" type="submit" name="chk" value="Submit">
        </form>


    <div>

            <?php

            if($c_found) {
                echo "<p>" . $query . " <br/></p>"; ?>
                <table>
                    <tr>
                        <th>CID</th>
                        <th>First Nmae</th>
                        <th>Last Name</th>
                        <th>Line1</th>
                        <th>Line2</th>
                        <th>Line3</th>
                        <th>City</th>
                        <th>Tel</th>
                        <th>email</th>
                        <th>IDN</th>
                        <th>notes</th>
                        <th>uname</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<tr>" .
                            "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td> 
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    
                </tr>";
                    } ?>
                </table>

            <?php }?>
    </div>
    </div>

    <?php ?>
    <div class="form">
        <?php if($_SESSION['ulevel']==1){?>
        <form action="cusview.php" METHOD="post">

           View all <br>

            <input class="minib" type="submit" name="all" value="Submit">
        </form>

    <div>
    <?php

    if($isAll) {
        echo "<p>" . $query . " <br/></p>"; ?>
        <table>
            <tr>
                <th>CID</th>
                <th>First Nmae</th>
                <th>Last Name</th>
                <th>Line1</th>
                <th>Line2</th>
                <th>Line3</th>
                <th>City</th>
                <th>Tel</th>
                <th>email</th>
                <th>IDN</th>
                <th>notes</th>
                <th>uname</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>" .
                    "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td> 
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    
                </tr>";
            } ?>
        </table>

    <?php }
        }?>
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

