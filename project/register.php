<?php
/**
 * Created by IntelliJ IDEA.
 * User: lakinduakash
 * Date: 5/13/17
 * Time: 10:38 PM
 */
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["pass"]);
    $ulevel = $_POST["ulevel"];
    $sid = $_POST["sid"];

    $uname = strip_tags($uname);
    $upass = strip_tags($upass);

    // password encrypt using SHA256();
    $password = hash('sha256', $upass);

    // check email exist or not
    $query = "SELECT uname FROM Users WHERE uname='$uname'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        $query = "INSERT INTO Users (uname,password,ulevel,sid) VALUES ('$uname','$password','$ulevel','$sid')";
        if (mysqli_query($conn, $query)) {
            echo "<p>" . $query . " <br/></p>";
            echo "Succsess <br/>";
            echo "<a href=\"register.php\">Back</a>";
        } else {
            echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
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
    <h3>Add new user</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?a">
            Username
            <input type="text" name="uname" placeholder="username..." required>
            Password
            <input type="password" name="pass" placeholder="New Password..." required>
            Confirm Password
            <input type="password" name="passc" placeholder="Confirm Password..." required>
            Showroom
            <input type="number" name="sid" placeholder="Showroom id..." required>
            <label for="ulevel">User Level</label>
            <select name="ulevel">
                <option value=1>Admin</option>
                <option value=3>Sales</option>
                <option value=2>Stock</option>
                <option value=5>Sales and Stock</option>
                <option value=4>Stock Admin</option>
            </select>
            <input type="submit" name="newuser" value="Add user">
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