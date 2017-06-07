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

$o_found = false;
$oid;
$cid;
$fname;
$itemc;
$pa;

if (isset($_POST['chk'])) {


    $oid = trim($_POST["oid"]);


    // check email exist or not
    $query = "SELECT oid,Orders.cid,Customer.fname,item_c,paid_amount FROM Orders INNER JOIN Customer ON Orders.cid=Customer.cid WHERE oid='$oid'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $row = mysqli_fetch_row($result);
        $oid = $row[0];
        $cid = $row[1];
        $fname = $row[2];
        $itemc = $row[3];
        $pa = $row[4];
        $o_found = true;

    } else {
        echo "<p>" . $query . " <br/></p>";
        echo "No Order found";
    }


}

if (isset($_POST['del'])) {
    $oid = $_POST['oid'];
    $query = "DELETE FROM Orders WHERE oid='$oid'";
    if (mysqli_query($conn, $query)) {
        echo "<p>" . $query . " <br/></p>";
        echo "Succsess <br>";
        echo "<a href=\"orderdel.php\">Back</a>";

    } else {
        echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
    }
} else {
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

    <h3>Remove Order</h3>

    <div class="form">
        <form action="orderdel.php" METHOD="post">

            Order ID
            <input type="text" id="idn" name="oid" placeholder="Order ID..." required>


            <input class="minib" type="submit" name="chk" value="Submit">
        </form>
    </div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderdel.php" METHOD="post">
            <?php
            echo "<p>" . $query . " <br/></p>";
            if ($o_found) {
                ?>

                <table>
                    <tr>
                        <th>OID</th>
                        <th>CID</th>
                        <th>First Name</th>
                        <th>Item Code</th>
                        <th>Paid Amount</th>
                    </tr>

                    <tr>
                        <td><?php echo $oid ?></td>
                        <td><?php echo $cid ?></td>
                        <td><?php echo $fname ?></td>
                        <td><?php echo $itemc ?></td>
                        <td><?php echo $pa ?></td>
                    </tr>
                </table>
                <input type="hidden" name="oid" value="<?php echo $oid ?>">
                <input class="minib" type="submit" name="del" value="Delete">
            <?php } ?>
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

<?php } ?>
