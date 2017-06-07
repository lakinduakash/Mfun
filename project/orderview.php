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
$isCid = false;
$isOdn = false;
$isIdn = false;
$isSt;
$isAll = false;
$result;

if (isset($_POST["cids"])) {
    $cid = $_POST['cid'];
    $query = "SELECT oid,orderd_date,date_delivered,cid,
 paid_amount,status,astimate_d_date,item_c,qty,line_1,line_2,
  line_3,city,Notes,total FROM Orders WHERE cid='$cid'";
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct > 0) {
        $isCid = true;
    }

} else if (isset($_POST["idns"])) {

    $idn = $_POST['idn'];
    $query = "SELECT oid,orderd_date,date_delivered,cid,
 paid_amount,status,astimate_d_date,item_c,qty,line_1,line_2,
  line_3,city,Notes,total FROM Orders WHERE cid=(SELECT cid FROM Customer WHERE idn='$idn')";
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct > 0) {
        $isIdn = true;
    }

} else if (isset($_POST["odn"])) {

    $odn = $_POST['oid'];
    $query = "SELECT oid,orderd_date,date_delivered,cid,
 paid_amount,status,astimate_d_date,item_c,qty,line_1,line_2,
  line_3,city,Notes,total FROM Orders WHERE oid='$odn'";
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct > 0) {
        $isOdn = true;
    }

} else if (isset($_POST["stn"])) {

    $st = $_POST['st'];
    $query = "SELECT oid,orderd_date,date_delivered,cid,
 paid_amount,status,astimate_d_date,item_c,qty,line_1,line_2,
  line_3,city,Notes,total FROM Orders WHERE status='$st'";
    $result = mysqli_query($conn, $query) or die( "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>");
    $ct = mysqli_num_rows($result);
    if ($ct > 0) {
        $isSt = true;
    }

} else if (isset($_POST["vAll"])) {

    $query = "SELECT oid,orderd_date,date_delivered,cid,
 paid_amount,status,astimate_d_date,item_c,qty,line_1,line_2,
  line_3,city,Notes,total FROM Orders";
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
            <li class="active"><a href="orderview.php">View Orders</a></li>
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
            <li style="float:right"><a href="logout.php?logout"><b>Log out! </b><?php echo $_SESSION['name']?></a></li>
        </ul>

    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

<!-- Banner -->
<section id="banner">

</section>

<section id="four" class="wrapper style3 special">
<h3>View order(s)</h3>

<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="orderview.php" method="post">
        By customer ID number
        <input type="text" name="idn" placeholder="ID number" required>


        <input class="minib" type="submit" name="idns" value="Submit">
    </form>

    <div>
        <?php
        if ($isIdn){
        echo "<p>" . $query . " <br/></p>";
        ?>
        <table>
            <tr>
                <th>OID</th>
                <th>Odered Date</th>
                <th>Date Delivered</th>
                <th>CID</th>
                <th>Paid Amount</th>
                <th>Total</th>
                <th>Status</th>
                <th>Astimated Del. Date</th>
                <th>Item Code</th>
                <th>QTY</th>
                <th>Line1</th>
                <th>Line2</th>
                <th>Line3</th>
                <th>City</th>
                <th>Notes</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($result)) {
                $citc = $row[7];
                $cqty = $row[8];
                $query = "SELECT price FROM Item_p WHERE item_c='$citc'";

                $result0 = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count = mysqli_num_rows($result0);
                if ($count == 1) {
                    $row0 = mysqli_fetch_row($result0);
                    $total = $row0[0] * $cqty;
                }

                echo "<tr>" .
                    "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                   <td>" . $row[14] . "</td>
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    <td>" . $row[12] . "</td>
                    <td>" . $row[13] . "</td>
                    
                </tr>";
            }
            } ?>
        </table>
    </div>
</div>

    <?php if($_SESSION['ulevel']!=6){
    ?>

<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="orderview.php" method="post">
        By customer id
        <input type="number" name="cid" placeholder="Customer id" required>

        <input class="minib" type="submit" name="cids" value="Submit">
    </form>

<div>
    <?php
    if ($isCid){
    echo "<p>" . $query . " <br/></p>";
    ?>
    <table>
        <tr>
            <th>OID</th>
            <th>Odered Date</th>
            <th>Date Delivered</th>
            <th>CID</th>
            <th>Paid Amount</th>
            <th>Total</th>
            <th>Status</th>
            <th>Astimated Del. Date</th>
            <th>Item Code</th>
            <th>QTY</th>
            <th>Line1</th>
            <th>Line2</th>
            <th>Line3</th>
            <th>City</th>
            <th>Notes</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_row($result)) {
            $citc = $row[7];
            $cqty = $row[8];
            $query = "SELECT price FROM Item_p WHERE item_c='$citc'";

            $result0 = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result0);
            if ($count == 1) {
                $row0 = mysqli_fetch_row($result0);
                $total = $row0[0] * $cqty;
            }

            echo "<tr>" .
                "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[14] . "</td>
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    <td>" . $row[12] . "</td>
                    <td>" . $row[13] . "</td>
                    <td> </td>
                </tr>";
        }
        } ?>
    </table>
</div>
</div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderview.php" method="post">
            By order number
            <input type="number" name="oid" placeholder="Order id" required>


            <input class="minib" type="submit" name="odn" value="Submit">
        </form>

    <div>
        <?php
        if ($isOdn){
        echo "<p>" . $query . " <br/></p>";
        ?>
        <table>
            <tr>
                <th>OID</th>
                <th>Odered Date</th>
                <th>Date Delivered</th>
                <th>CID</th>
                <th>Paid Amount</th>
                <th>Total</th>
                <th>Status</th>
                <th>Astimated Del. Date</th>
                <th>Item Code</th>
                <th>QTY</th>
                <th>Line1</th>
                <th>Line2</th>
                <th>Line3</th>
                <th>City</th>
                <th>Notes</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($result)) {
                $citc = $row[7];
                $cqty = $row[8];
                $query = "SELECT price FROM Item_p WHERE item_c='$citc'";

                $result0 = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count = mysqli_num_rows($result0);
                if ($count == 1) {
                    $row0 = mysqli_fetch_row($result0);
                    $total = $row0[0] * $cqty;
                }

                echo "<tr>" .
                    "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[14] . "</td>
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    <td>" . $row[12] . "</td>
                    <td>" . $row[13] . "</td>
                    <td> </td>
                </tr>";
            }
            } ?>
        </table>
    </div>
    </div>
    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderview.php" method="post">
            By Status
            <input type="number" name="st" placeholder="Status ID" required>


            <input class="minib" type="submit" name="stn" value="Submit">
        </form>


    <div>
        <?php
        if ($isSt){
        echo "<p>" . $query . " <br/></p>";
        ?>
        <table>
            <tr>
                <th>OID</th>
                <th>Odered Date</th>
                <th>Date Delivered</th>
                <th>CID</th>
                <th>Paid Amount</th>
                <th>Total</th>
                <th>Status</th>
                <th>Astimated Del. Date</th>
                <th>Item Code</th>
                <th>QTY</th>
                <th>Line1</th>
                <th>Line2</th>
                <th>Line3</th>
                <th>City</th>
                <th>Notes</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($result)) {
                $citc = $row[7];
                $cqty = $row[8];
                $query = "SELECT price FROM Item_p WHERE item_c='$citc'";

                $result0 = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count = mysqli_num_rows($result0);
                if ($count == 1) {
                    $row0 = mysqli_fetch_row($result0);
                    $total = $row0[0] * $cqty;
                }

                echo "<tr>" .
                    "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[14] . "</td>
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    <td>" . $row[12] . "</td>
                    <td>" . $row[13] . "</td>
                    <td> </td>
                </tr>";
            }
            } ?>
        </table>
    </div>
    </div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderview.php" method="post">
            Viev All<br>


            <input class="minib" type="submit" name="vAll" value="Submit">
        </form>
        <div>
            <?php
            if ($isAll){
            echo "<p>" . $query . " <br/></p>";
            ?>
            <table>
                <tr>
                    <th>OID</th>
                    <th>Odered Date</th>
                    <th>Date Delivered</th>
                    <th>CID</th>
                    <th>Paid Amount</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Astimated Del. Date</th>
                    <th>Item Code</th>
                    <th>QTY</th>
                    <th>Line1</th>
                    <th>Line2</th>
                    <th>Line3</th>
                    <th>City</th>
                    <th>Notes</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_row($result)) {
                    $citc = $row[7];
                    $cqty = $row[8];
                    $query = "SELECT price FROM Item_p WHERE item_c='$citc'";

                    $result0 = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    $count = mysqli_num_rows($result0);
                    if ($count == 1) {
                        $row0 = mysqli_fetch_row($result0);
                        $total = $row0[0] * $cqty;
                    }

                    echo "<tr>" .
                        "<td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[14] . "</td>
                    <td>" . $row[5] . "</td>
                    <td>" . $row[6] . "</td> 
                    <td>" . $row[7] . "</td>
                    <td>" . $row[8] . "</td> 
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>" . $row[11] . "</td>
                    <td>" . $row[12] . "</td>
                    <td>" . $row[13] . "</td>
                    <td> </td>
                </tr>";
                }
                } ?>
            </table>
        </div>
<?php } ?>

        <div class="tblock">

            <h5>Order Status</h5>
            <p>
            (1)Added<br>
            (2)Added For manufacturing<br>
            (3)Delevering to customer<br>
            (4)Manufacturaing item(s)<br>
            (5)Manufacter completed<br>
            (6)Completed
            </p>

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
