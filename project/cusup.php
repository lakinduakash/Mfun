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


$tel;
$cid;
$qty;
$l1;
$l2;
$l3;
$city;
$fname;
$lname;
$email;
$idn=$_POST['idn'];
$notes;
$cfound=false;



if (isset($_POST['chk'])){


    $query = "SELECT cid,fname,lname,line_1,line_2,line_3,city,tel,email,idn,notes FROM Customer WHERE idn='$idn'";

    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $count=mysqli_num_rows($result);
    if($count==1){
        $row=mysqli_fetch_row($result);

        $cid=$row[0];
        $fname=$row[1];
        $lname=$row[2];
        $l1=$row[3];
        $l2=$row[4];
        $l3=$row[5];
        $city=$row[6];
        $tel=$row[7];
        $email=$row[8];
        $idn=$row[9];
        $notes=$row[10];
        $cfound=true;
    }


}

if(isset($_POST['submit'])) {

    $cid = trim($_POST["cid"]);
    $l1 = trim($_POST['line1']);
    $l2 = trim($_POST['line2']);
    $l3 = trim($_POST['line3']);
    $city = trim($_POST['city']);
    $tel = trim($_POST['tel']);
    $email = trim($_POST['email']);
    $idn = trim($_POST['idn']);
    $notes = trim($_POST['notes']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);



    $query = "UPDATE Customer SET fname='$fname',lname='$lname',line_1='$l1',line_2='$l2',line_3='$l3',city='$city',tel='$tel',
email='$email',idn='$idn',notes='$notes' WHERE cid=$cid";
    if ($_POST["cfound"]) {
        if (mysqli_query($conn, $query)) {
            echo "<p>" . $query . " <br/></p>";
            echo "Succsess <br/>";
            echo "<a href='cusup.php'>Back</a>";
        } else {
            echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
        }
    }
    else {
        echo "<p>" . $query . " <br/></p>";
        echo "Failed Wrong idn <br/>";
        echo "<a href='cusup.php'>Back</a>";
    }


}
else{
    ?>
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

    <h3>Update Customer Info</h3>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="cusup.php" method="post">
            Customer ID.
            <input class="mini" type="text" value="<?php echo $idn?>"  name="idn" placeholder="Enter ID number" required><br>


            <input class="minib" type="submit" name="chk" value="Submit">
        </form>
    </div>

    <div class="form">
        <link rel="stylesheet" href="css/forms.css">
        <form action="cusup.php" method="post">
            ID number
            <input class="mini" type="text"  name="idn" value="<?php echo $idn?>"  placeholder="Enter ID Number" required><br>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" value="<?php echo $fname?>" placeholder="Customer's first name..." required>
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" value="<?php echo $lname?>" placeholder="Customer's first name..." required >

            Address
            <input type="text" id="add" name="line1" value="<?php echo $l1?>" placeholder="Address line 1" required >
            <input type="text" id="add" name="line2" value="<?php echo $l2?>" placeholder="Address line 2" >
            <input type="text" id="add" name="line3" value="<?php echo $l3?>" placeholder="Address line 3" >
            <input type="text" id="add" name="city" value="<?php echo $city?>" placeholder="City" required >
            <label for="country">Country</label>
            <select id="country" name="country" >
                <option value="australia">Sri Lanka</option>
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select>
            Tel
            <input type="tel" name="tel" value="<?php echo $tel?>" placeholder="Tel..." required>
            email
            <input type="email"name="email" value="<?php echo $email?>" placeholder="Email..." >
            Notes
            <input type="text"  name="notes" value="<?php echo $notes?>" placeholder="Notes..." >

            <input type="hidden" name="cfound" value="<?php echo $cfound;?>">
            <input type="hidden" name="cid" value="<?php echo $cid;?>">
            <input type="submit" name="submit" value="Submit">
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
<?php }