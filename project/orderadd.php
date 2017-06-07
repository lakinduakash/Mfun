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
$isvalidcus = false;
$isvalidi = false;
$fname;
$idn;
$cid;
$tel;
$email;
$total;
$uname = $_SESSION["name"];
$sid = $_SESSION["sid"];

if (isset($_POST['idns']) or isset($_POST['ca'])) {

    $idn = $_POST['idn'];

    $query = "SELECT cid,idn,fname,email,tel FROM Customer WHERE idn='$idn'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $isvalidcus = true;
        $arr = mysqli_fetch_array($result);
        $fname = $arr['fname'];
        $idn = $arr['idn'];
        $cid = $arr['cid'];
        $tel = $arr['tel'];
        $email = $arr['email'];
    } else {
        $isvalidcus = false;
    }

    if (isset($_POST['ca'])) {
        $citc = $_POST['citc'];
        $cqty = $_POST['cqty'];
        $query = "SELECT price FROM Items WHERE item_c='$citc'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $row = mysqli_fetch_row($result);
            $total = $row[0] * $cqty;
            $isvalidi = true;
        }

    }


}
if (isset($_POST["addorder"])) {
    $item_c = $_POST['itc'];
    $qty = $_POST['qty'];
    $amount = $_POST['amount'];
    $isvalidcus = $_POST['isvalidcus'];
    $cid = $_POST['cid'];
    $l1 = $_POST['line1'];
    $l2 = $_POST['line2'];
    $l3 = $_POST['line3'];
    $city = $_POST['city'];


    if ($_POST['isvalidcus']) {
        if ($_POST['otype'] == "stock") {

            $query = "SELECT price FROM Items WHERE item_c='$item_c'";

            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row = mysqli_fetch_row($result);
                $total = $row[0] * $qty;
                $isvalidi = true;
            }

            $query1 = "UPDATE Items SET qty=qty-$qty WHERE item_c='$item_c'";
            $query2 = "INSERT INTO Orders (cid,paid_amount,status,astimate_d_date,item_c,qty,uname,sid,line_1,line_2,line_3,city,total) VALUES 
('$cid','$amount',1,DATE_ADD(CURRENT_DATE 
,INTERVAL 3 DAY),'$item_c','$qty','$uname','$sid','$l1','$l2','$l3','$city','$total')";

            if (mysqli_query($conn, $query1)) {
                if (mysqli_query($conn, $query2)) {
                    echo $query1 . " <br/>";
                    echo $query2 . " <br/>";
                    echo "Succsess <br/>";
                    echo "<a href='orderadd.php'>Back</a>";
                } else {
                    echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
                    echo "<a href='orderadd.php'>Back</a>";
                }

            } else {
                echo "Error: " . $query1 . "<br>" . mysqli_error($conn);
                echo "<a href='orderadd.php'>Back</a>";
            }
        } else {

            $query = "SELECT price FROM Items WHERE item_c='$item_c'";

            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row = mysqli_fetch_row($result);
                $total = $row[0] * $qty;
                $isvalidi = true;
            }

            $query1 = "INSERT INTO Orders (cid,paid_amount,status,astimate_d_date,item_c,qty,uname,sid,line_1,line_2,line_3,city,total) VALUES ('$cid'
,'$amount',2,DATE_ADD(CURRENT_DATE ,INTERVAL 30 DAY),'$item_c','$qty','$uname','$sid','$l1','$l2','$l3','$city','$total')";


            if (mysqli_query($conn, $query1)) {
                $query2 = "SELECT MAX(oid) FROM Orders";
                $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
                $row = mysqli_fetch_row($result);
                $oid = $row[0];
                echo $query1 . " <br/>";
                echo "Succsess <br/>";
                echo "<a href='orderadd.php'>Back</a>";


            } else {
                echo "Error: " . $query1 . "<br>" . mysqli_error($conn);
                echo "<a href='orderadd.php'>Back</a>";
            }
        }

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
                <li class="active"><a href="orderadd.php" >Add Order</a></li>
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
                <li style="float:right"><a href="logout.php?logout"><b>Log out! </b><?php echo $_SESSION['name']?></a></li>
            </ul>

        </nav>
    </header>

    <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

    <!-- Banner -->
    <section id="banner">

    </section>

    <section id="four" class="wrapper style3 special">

    <h3>Add new order</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderadd.php" method="post">
            ID number
            <input type="text" id="idn" name="idn" placeholder="Entrer ID number..." required>
            <?php
            if (!$isvalidcus & isset($_POST['idn']) & !isset($_POST['ca'])) {
                echo "Invalid customer ID <br>";
            } ?>
            <input class="minib" type="submit" name="idns" value="Submit">
        </form>
    </div>

    Check Price
    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderadd.php" method="post">
            Item Code
            <input type="text" name="citc" placeholder="Item Code" required>
            Qty
            <input type="number" name="cqty" placeholder="QTY" required><br>

            <?php if ($isvalidi) {
                echo "<h3>Price: " . $total . "</h3> <br>";
            } ?>

            <input type="hidden" name="idn" value="<?php echo $idn ?>" placeholder="Entrer ID number..." required>

            <input class="minib" type="submit" name="ca" value="Submit">
        </form>
    </div>
    Add
    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="orderadd.php" method="post">
            Customer No.
            <input type="text" name="ci" value="<?php echo $cid; ?>" placeholder="Customer NO..." disabled>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" value="<?php echo $fname; ?>"
                   placeholder="Customer's first name..." required disabled>

            ID number
            <input type="text" id="idn" name="idn" value="<?php
            if ($isvalidcus & isset($_POST['idn'])) {
                echo $idn;
            } ?>" placeholder="ID number..." required disabled>

            E-mail
            <input type="email" name="email" placeholder="email" value="<?php echo $email; ?>" disabled>
            Telephone
            <input type="tel" name="tel" value="<?php echo $tel; ?>" placeholder="Tel..." disabled>
            Delivery Address
            <input type="text" id="add" name="line1" placeholder="Address line 1" required>
            <input type="text" id="add" name="line2" placeholder="Address line 2">
            <input type="text" id="add" name="line3" placeholder="Address line 3">
            <input type="text" id="add" name="city" placeholder="City" required>
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="australia">Sri Lanka</option>
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select>
            Item Code
            <input type="text" id="itc" name="itc" placeholder="Item Code" required>
            Qty
            <input type="number" id="idn" name="qty" placeholder="QTY" required>
            Amount
            <input type="number" id="amount" name="amount" placeholder="Paid Amount (RS)" required>
            Order Type<br>
            <input type="radio" name="otype" value="stock" checked> From Stock<br>
            <input type="radio" name="otype" value="manu"> To manufacture<br>

            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
            <input type="hidden" name="isvalidcus" value="<?php echo $isvalidcus; ?>">


            <input type="submit" name="addorder" value="Submit">
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