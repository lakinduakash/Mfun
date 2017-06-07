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
if(isset($_POST['oid'])){
    $oid = $_POST['oid'];
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
$pa;
$st;
$item_c;
$qty;
$l1;
$l2;
$l3;
$city;
$fname;
$na;
$idn;
$total;}

$ofound = false;


if (isset($_POST['chk'])) {


    $query = "SELECT Orders.paid_amount,Orders.status,Orders.item_c,
 Orders.qty, Orders.line_1,Orders.line_2,Orders.line_3,Orders.city,Customer.fname,Customer.idn,Orders.total
   FROM  Orders INNER JOIN Customer ON Customer.cid=Orders.cid WHERE Orders.oid='$oid'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $row = mysqli_fetch_row($result);

        $pa = $row[0];
        $st = $row[1];
        $item_c = $row[2];
        $qty = $row[3];
        $l1 = $row[4];
        $l2 = $row[5];
        $l3 = $row[6];
        $city = $row[7];
        $fname = $row[8];
        $idn = $row[9];
        $total=$row[10];
        $ofound = true;
    }


}

if (isset($_POST['submit'])) {

    $pa = trim($_POST["amount"]);
    $l1 = trim($_POST['line1']);
    $l2 = trim($_POST['line2']);
    $l3 = trim($_POST['line3']);
    $city = trim($_POST['city']);
    $st = trim($_POST['status']);


    if ($st == 1 | $st == 3 | $st == 5) {
        $query = "UPDATE Orders SET status='$st',line_1='$l1',line_2='$l2',line_3='$l3',city='$city',paid_amount='$pa'
WHERE Orders.oid=$oid";

        if ($_POST["ofound"]) {
            if (mysqli_query($conn, $query)) {

                echo "<p>" . $query . " <br/></p>";
                echo "Succsess <br/>";
                echo "<a href='orderup.php'>Back</a>";
            } else {
                echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";

            }
        } else {
            echo "<p>" . $query . " <br/></p>";
            echo "Failed Wrong id <br/>";
            echo "<a href='orderup.php'>Back</a>";
        }

    }

    if ($st == 6) {
        $query = "UPDATE Orders SET date_delivered=CURRENT_TIMESTAMP,status='$st',line_1='$l1',line_2='$l2',line_3='$l3',city='$city',paid_amount='$pa'
WHERE Orders.oid=$oid";
        if ($_POST["ofound"]) {
            if (mysqli_query($conn, $query)) {
                echo "<p>" . $query . " <br/></p>";
                echo "Succsess <br/>";
                echo "<a href='orderup.php'>Back</a>";
            } else {
                echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p><br>";
            }
        } else {
            echo $query . " <br/>";
            echo "Failed Wrong id <br/>";
            echo "<a href='orderup.php'>Back</a>";
        }

    } else {
        $query = "UPDATE Orders SET status='$st',line_1='$l1',line_2='$l2',line_3='$l3',city='$city',paid_amount='$pa'
WHERE Orders.oid=$oid";
        if ($_POST["ofound"]) {
            if (mysqli_query($conn, $query)) {
                echo $query . " <br/>";
                echo "Succsess <br/>";
                echo "<a href='orderup.php'>Back</a>";
            } else {
                echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
            }
        } else {
            echo $query . " <br/>";
            echo "Failed Wrong id <br/>";
            echo "<a href='orderup.php'>Back</a>";
        }
    }


} else {
    ?>
    <!DOCTYPE HTML>

    <html>
    <head>
        <title>Moratuwa Funitures</title>
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
                <li class="active"><a href="orderup.php">Update Order</a></li>
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
                <li style="float:right"><a href="logout.php?logout"><b>Log out! </b><?php echo $_SESSION['name']?></a></li>
            </ul>

        </nav>
    </header>

    <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

    <!-- Banner -->
    <section id="banner">

    </section>

    <section id="four" class="wrapper style3 special">

    <h3>Update order</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderup.php" method="post">
            Order No.
            <input class="mini" type="number" value="<?php echo $oid ?>" name="oid" placeholder="Enter Order ID"
                   required><br>
            <?php if (isset($_POST['chk']) & !$ofound) { ?>
                <p>Invalid Order No</p>
            <?php } ?>

            <input class="minib0" type="submit" name="chk" value="Submit">
        </form>
    </div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderup.php" method="post">
            Order No.
            <input class="mini" type="number" name="oid" value="<?php if (isset($_POST['chk']) & $ofound) {
                echo $oid;
            } ?>" placeholder="Enter Order ID" required disabled><br>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" value="<?php if (isset($fname)){echo $fname;} ?>"
                   placeholder="Customer's first name..." required disabled>
            ID number
            <input type="text" id="idn" name="idn" value="<?php echo $idn ?>" placeholder="ID number..." required
                   disabled>

            Delivery Address
            <input type="text" id="add" name="line1" value="<?php if (isset($l1)){echo $l1;} ?>" placeholder="Address line 1"<?php if(($_SESSION['ulevel']==2) or ($_SESSION['ulevel']==4)){echo ' disabled ';}  ?> required>
            <input type="text" id="add" name="line2" value="<?php if (isset($l2)){echo $l2;} ?>" placeholder="Address line 2"<?php if(($_SESSION['ulevel']==2) or ($_SESSION['ulevel']==4)){echo ' disabled ';}  ?>>
            <input type="text" id="add" name="line3" value="<?php if (isset($l3)){echo $l3;} ?>" placeholder="Address line 3"<?php if(($_SESSION['ulevel']==2) or ($_SESSION['ulevel']==4)){echo ' disabled ';}  ?>>
            <input type="text" id="add" name="city" value="<?php if (isset($city)){echo $city;} ?>" placeholder="City"<?php if(($_SESSION['ulevel']==2) or ($_SESSION['ulevel']==4)){echo ' disabled ';}  ?> required>
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="australia">Sri Lanka</option>
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select>
            Item Code
            <input type="text" id="itc" name="itc" value="<?php if (isset($item_c)){echo $item_c;} ?>" placeholder="Item Code" required
                   disabled>
            Qty
            <input type="number" id="idn" name="qty" value="<?php if (isset($qty)){echo $qty;} ?>" placeholder="QTY" required disabled>
            Total Price
            <input type="number" id="amount" name="amount" value="<?php if (isset($total)){echo $total;} ?>" placeholder="Total Price(Rs)"
                   required disabled>
            Previously Paid Amount
            <input type="number" id="amount" name="amount" value="<?php if (isset($pa)){echo $pa;} ?>" placeholder="Paid Amount (RS)"
                   required disabled>
            New Amount
            <input type="number" id="amount" name="amount" value="<?php if (isset($pa)){echo $pa;} ?>" placeholder="New Paid Amount (RS)"
                   <?php if(($_SESSION['ulevel']==2) or ($_SESSION['ulevel']==4)){echo ' disabled ';}  ?>required>
            Order Status
            <input type="number" id="idn" name="qty" value="<?php if (isset($st)){echo $st;} ?>" placeholder="QTY" required disabled>
            Change Status
            <select id="st" name="status">
                <option value=1>(1)Added</option>
                <option value=2>(2)Added For manufacturing</option>
                <option value=3>(3)Delevering to customer</option>
                <option value=4>(4)Manufacturaing item(s)</option>
                <option value=5>(5)Manufacter completed</option>
                <option value=6>(6)Completed</option>
            </select>
            <input type="hidden" name="ofound" value="<?php echo $ofound; ?>">
            <input type="hidden" name="oid" value="<?php echo $oid; ?>">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

    <div class="tblock">
        <p class="t">
            <h4>Order Status</h4>

            (1)Added<br>
            (2)Added For manufacturing<br>
            (3)Delevering to customer<br>
            (4)Manufacturaing item(s)<br>
            (5)Manufacter completed<br>
            (6)Completed
        </p>

    </div>
    </section>
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    </body>
    </html>
<?php }