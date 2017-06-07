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
$qty;
$price;
$item_c;
$desc;
$item_f = false;
if (isset($_POST["check"])) {

    $item_c = trim($_POST["item_c"]);


    // check email exist or not
    $query = "SELECT item_c,price,qty,description FROM Items WHERE item_c='$item_c'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $arr = mysqli_fetch_array($result);
        $item_c = $arr['item_c'];
        $price = $arr['price'];
        $qty = $arr['qty'];
        $desc = $arr['description'];
        $item_f = true;
    } else {
        $item_f = false;
        echo "<p>" . $query . " <br/></p>";
        echo "<p style='color: #f21040'>Failed: No item found</p> <br/>";
    }

}

if (isset($_POST["add"])) {

    $qty = trim($_POST["qty"]);
    $price = trim($_POST["price"]);
    $desc = trim($_POST["description"]);
    $item_c = $_POST["item_c"];
    $item_f = $_POST["item_f"];

    $query = "UPDATE Items SET price='$price',qty='$qty',description='$desc' WHERE item_c='$item_c'";
    if (mysqli_query($conn, $query)) {
        if (!$item_f) {
            echo "No valid item selected.";
            echo "<a href='itemup.php'>Back</a>";
        } else {
            echo "<p>" . $query . " <br/></p>";
            echo "Succsess <br/>";
            echo "<a href='itemup.php'>Back</a>";
        }

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
                <li class="dropdown active">
                    <a href="javascript:void(0)" class="dropbtn">Stock</a>
                    <div class="dropdown-content">
                        <a href="itemup.php">New stock</a>
                        <a href="itemadd.php">New Item</a>
                    </div>
                <li><a href="orderview.php">View Orders</a></li>
                <li><a href="itemview.php">View Items</a></li>
                <li class="dropdown ">
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
    <h3>Add stock</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="itemup.php" method="post">
            Item code
            <input type="text" name="item_c" value="<?php echo $item_c ?>" placeholder="Item code..." required>

            <input class="minib" type="submit" name="check" value="Submit">
        </form>
    </div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="itemup.php" method="post">
            Currunt QTY
            <input type="number" name="cqty" value="<?php echo $qty ?>" placeholder="currunt qty..." disabled>
            New QTY
            <input class="mini" type="number" name="qty" placeholder="Enter new QTY..." required<?php if(($_SESSION['ulevel']==3)){echo ' disabled ';}  ?>><br>
            Current Price
            <input class="mini" type="number" name="cprice" value="<?php echo $price ?>" placeholder="Enter new QTY..."
                   required disabled><br>
            New Price
            <input class="mini" type="number" name="price" placeholder="Enter new price..."<?php if(($_SESSION['ulevel']==3)){echo ' disabled ';}  ?> required><br>
            Description
            <input type="text" name="description" value="<?php echo $desc ?>" placeholder="Description..."<?php if(($_SESSION['ulevel']==3)){echo ' disabled ';}  ?> required>

            <input type="hidden" name="item_c" value="<?php echo $item_c; ?>">
            <input type="hidden" name="item_f" value="<?php echo $item_f; ?>">

            <input type="submit" name="add" value="Submit">
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