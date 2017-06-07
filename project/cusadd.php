<?php
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


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST["firstname"]);
    $lname = trim($_POST["lastname"]);
    $idn=trim($_POST["idn"]);
    $sid=$_SESSION["sid"];
    $email=trim($_POST["email"]);
    $tel=trim($_POST["tel"]);
    $l1=trim($_POST["line1"]);
    $l2=trim($_POST["line2"]);
    $l3=trim($_POST["line3"]);
    $city=trim($_POST["city"]);
    $notes=trim($_POST["notes"]);
    $uname=$_SESSION["name"];



    // check email exist or not
    $query = "SELECT idn FROM Customer WHERE idn='$idn'";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $count=mysqli_num_rows($result);
    if ($count==0){
        $query="INSERT INTO Customer (fname,lname,line_1,line_2,line_3,city,tel,email,idn,notes,uname,sid) VALUES ('$fname','$lname','$l1','$l2','$l3','$city','$tel','$email',
'$idn','$notes','$uname','$sid')";
        if (mysqli_query($conn, $query)) {
            echo "<p>" . $query . " <br/></p>";
            echo "Succsess <br/>";
            echo "<a href='cusadd.php'>Back</a>";
        } else {
            echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
        }
    }
    else{
        echo "Failed. Customer is already added.<br/>";
        echo "<a href='cusadd.php'>Back</a>";
    }




}
else{
?>

    <html>
    <head>
        <title>Moratuwa Funiturers</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/tables.css" />
        <link rel="stylesheet" href="assets/css/main1.css" />

    </head>
    <body class="landing">

    <!-- Header -->
    <header id="header" class="alt">
        <nav id="nav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="cusadd.php">New Customer</a></li>
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

<h3>Add new Customer</h3>

<div class="form">
    <link rel="stylesheet" href="css/forms.css">
    <form action="cusadd.php" METHOD="post">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Customer's first name..." required>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Customer's Last name..." required>
        ID number
        <input type="text" id="idn" name="idn" placeholder="ID number..." required>

        E-mail
        <input type="email" name="email" placeholder="email">
        Telephone
        <input type="tel" name="tel" placeholder="tel...">
        Address
        <input type="text"  name="line1" placeholder="Address line 1" required>
        <input type="text"  name="line2" placeholder="Address line 2" >
        <input type="text"  name="line3" placeholder="Address line 3" >
        <input type="text"  name="city" placeholder="City" required>
        Notes
        <input type="text" name="notes" placeholder="Notes">


        <input type="submit" value="Submit">
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
