<?PHP
    session_start();
    $_SESSION;
    include("Connection.php");
    include("Function.php");
    $user_data = check_login($con);
    $user_id = $_SESSION["id"]; 

    $user_data = check_login($con);
  
    // redirects user if not signed
    if(check_login($con) == "False")
    {
      header("Location: Login.php");
    }
?>


<html>
    <head>
        <!-- imports font library  -->
        <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
        <link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>

        <title> Your Appointments </title>
        
        <style>

            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                color: #191923
            }

            /* scroll bar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #24231a; 
            }
            
            ::-webkit-scrollbar-thumb {
                background: #d0c2a6; 
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #ffeecb; 
            }

            /* nav bar */
            .topnav {
                background-color: #191708;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075)
            }

            .topnav a {
                float: left;
                color: #EEEEEE;
                text-align: center;
                padding: 10px 50px;
                height: 30px;
                line-height: 25px;
                text-decoration: none;
                font-size: 17px;
                font-family: century-gothic, sans-serif;
                transition: 0.35s;
                display: block;
            }   

            .topnav a.navlinks:hover {
                background-color: #242216;
                color: white;
                margin-top:5px;
                height: 25px;
                line-height: 20px;
                text-decoration: none;
                font-size: 17px;
                border-radius: 10px;
            }

            /* nav bar drop down */
            .dropdown {
                float: left;
                overflow: hidden;
                z-index : 2000;
                text-align: center;
                display: table;
                border-collapse: separate;
            }

            .dropdown .dropbtn {
                width: 200px;
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit; /* Important for vertical align on mobile phones */
                margin: 0; /* Important for vertical align on mobile phones */
                color: #EEEEEE;
                text-align: center;
                padding: 10px 50px;
                height: 50px;
                line-height: 25px;
                text-decoration: none;
                font-size: 20px;
                font-family: century-gothic, sans-serif;
                transition: 0.7s;
                z-index : 2000;
                display: flex; 
                white-space: nowrap;
                text-align: center;
                display: table-cell;
                border-collapse: separate;
            }

            .dropbtn:hover {
                background-color:#15150f;
                border-radius: 10px;
                text-align: center;
                display: table-cell;
                border-collapse: separate;
            }

            .dropdown:hover .dropbtn {
                background-color: #2c290e;
                color: white;
                height: 60px;
                line-height: 30px;
                text-decoration: none;
                white-space: nowrap;
                font-size: auto;
                z-index : 2000;
                width: 200;
                padding: 14px;
                text-align: center;
                display: table-cell;
                border-collapse: separate;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #2c290e;
                border-radius: 0px 0px 10px 10px;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 2000;
                width:200px;
            }

            .dropdown-content a {
                float: none;
                color: white;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
                z-index : 2000;
                text-align: center;
            }

            .dropdown-content a:hover {
                background-color:#15150f;
                z-index : 2000;
                border-radius: 10px;
            }

            .dropdown:hover .dropdown-content {
                display: block;
                z-index : 2000;
            }

            /* footer */
            footer {
                background-color: #2f2d20;
                margin:0;
                height:150px;
                padding: 50px;
            }

            footer p {
                font-size: 18px;
                font-family: century-gothic, sans-serif;
                color: #7c7b72; 
            }

            footer a {
                font-size: 15px;
                font-family: century-gothic, sans-serif;
                color: #64635a; 
                transition: 0.5s;
            }

            footer a:hover {
                color: #515047;
            }

            footer a:active {
                color: white;
            }

            .company{
                width: 400px;
                text-align: center;
                position: relative;
                float: left;
            }

            .products{
                width: 400px;
                text-align: center;
                position: relative;
                float: left;
                margin-left: 300px;
            }

            #company {
                position: absolute;
                top: 0px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #products {
                position: absolute;
                top: 0px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #home {
                position: absolute;
                top: 50px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #about {
                position: absolute;
                top: 75px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #contact {
                position: absolute;
                top: 100px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #mot{
                position: absolute;
                top: 50px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #account {
                position: absolute;
                top: 75px;
                left:50%;
                transform: translate(-50%,-50%);
            }

            footer img {
                float: right;
                margin-right: 3%;
            }

            .copyright{
                position: relative;
                float: right;
                margin-right: 10%;
                line-height: 5px;
            }

            .copyright p {
                font-size: 15px;
                font-family: century-gothic, sans-serif;
                color: #64635a; 
            }

            /* main conatiner */
            .container {
                min-height: 85%;
                width: 90%;
                margin-top: 5%;
                margin-bottom: 5%;
                margin-left: 5%;
                background-color: #f4cdb3;
                border-radius: 20px;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
            }

            /* Your Bookings title */
            .container h2 {
                font-size: 55px;
                font-family: century-gothic, sans-serif;
                color: #3d1c16; 
                padding-top: 50px;
                margin-left: 75px;
            }

            /* Pending Appointmnets title */
            .container h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #343325; 
            }

            #currenttitle {
                padding-top: 20px;
                margin-left: 125px;
            }

            /* pendng appontmnets  */
            .currentbookings {
                min-height: 30%;
                width: 95%;
                margin-top: 0px;
                margin-left: 2.5%;
                background-color: #27261c;
                border-radius: 20px;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .currentbookings table {
                font-size: 20px;
                font-family: "Courier New", monospace;
                color: white;
                font-weight: bold;
                margin-left:2.5%;
                width: 95%;
                text-align: center;
            }

            .currentbookings th {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #DEDCD1;
                width: 200px; 
                height: 50px;
            }

            .currentbookings td {
                height:30px;
            }

            /* column widths */
            #pasttitle {
                padding-top: 50px;
                margin-left: 125px;
                color: #3d1c16;
            }

            /* pas bookings box */
            .pastbookings {
                min-height: 30%;
                width: 100%;
                margin-top: 0px;
                background-color:#e08860;
                border-radius: 0px 0px 20px 20px;
                padding-bottom: 2.5%;
            }

            /* past bookings */
            .pastbookings table {
                font-size: 20px;
                font-family: "Courier New", monospace;
                color: white;
                font-weight: bold;
                margin-left:5%;
                width: 90%;
                text-align: center;
            }

            .pastbookings th {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #DEDCD1;
                width: 200px; 
                height: 50px;
                color:black;
            }

            .pastbookings td {
                height:30px;
                color: #3d1c16;
            }

            /* column widths */
            #bookingdate {
                width:10%;
            }

            #bookingtime {
                width:10%;
            }

            #reg {
                width:10%;
            }

            #bookingmade {
                width:15%;
            }

            #info {
                width:30%;
            }

            #bookingid {
                width:15%;
            }

            #delete {
                width:10%;
            }

            /* current bookings table delete button */
            .currentbookings input[type="submit"]{
                background-image: url('images/car2.png');
                background-repeat: no-repeat;
                color: inherit;
                border: none;
                padding: 5px 10px 5px 10px;
                border-radius: 10px;
                font: inherit;
                cursor: pointer;
                outline: inherit;
                background-color: #42402f;
                transition: 0.5s;
            }

            .currentbookings input[type="submit"]:hover {
                background-image: url('images/car2.png');
                background-repeat: no-repeat;
                color: inherit;
                border: none;
                padding: 5px 10px 5px 10px;
                border-radius: 10px;
                font: inherit;
                cursor: pointer;
                outline: inherit;
                background-color: #13130e;
            }

            /* past bookings column width */
            #bookingdatepast {
                width:10%;
            }

            #bookingtimepast {
                width:10%;
            }

            #regpast {
                width:10%;
            }

            #bookingmadepast {
                width:15%;
            }

            #infopast {
                width:40%;
            }

            #bookingidpast {
                width:15%;
            }

        </style>
    </head>

    <body>
    
        <body style="background-color:#24231a">

        <!-- nav bar -->
        <div class="topnav">
            <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
            <a class = "navlinks" href="About.php">About</a>
            <a class = "navlinks" href="ContactUs.php">Contact Us</a>
            <a class = "navlinks" class="active" href="MOT.php">Book an MOT!</a>
            <div class="dropdown" style="float:right">
                <?PHP
                    $_SESSION;
                    $user_data = check_login($con);
                    $user_id = $_SESSION["id"];  

                    $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
                    $result = $con->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<button class='dropbtn'>Hi $row[FirstName]</button>";
                    }      
                ?>
                <div class="dropdown-content">
                    <a href="Account.php">Account</a>
                    <a href="Bookings.php">Bookings</a>
                    <a href="Logout.php"> Log Out </a>
                </div>
            </div>
        </div>

        <div class = "container">

            <!-- Pending appointmnets -->
            <h2>Your Bookings</h2>
            <h4 id = "currenttitle">Pending Appointments</h4>
            <div class = "currentbookings">
                <table>
                    <th id = 'bookingdate'> Date </th>
                    <th id = 'bookingtime'> Time </th>
                    <th id = 'reg'> Vehicle </th>
                    <th id = 'bookingmade'> Made On </th>
                    <th id = 'info'> Additional Notes </th>
                    <th id = 'bookingid'> Appointment ID </th>
                    <th id = 'delete'>  </th>
                </table>

                <form action="bookings.php" method="post">
                    <?php
                        $_SESSION;
                        $user_data = check_login($con);
                        $user_id = $_SESSION["id"]; 
                        $sql = "select BookingID, Registration, BookedDate, BookedTime, BookingMade, Info from bookings where CustomerID = '$user_id'";
                        $result = mysqli_query($con, $sql); 
                        $count = 0;
                        $bookingid = [];

                        // pending appountmnets table
                        while ($db_field = mysqli_fetch_assoc($result) ) 
                        {
                            date_default_timezone_set('Europe/London');
                            if (date("Y-m-d H:i:s") <= ($db_field['BookedDate'] . " " . $db_field['BookedTime']))
                            {
                                $bookingid[]= $db_field['BookingID'];
                                $reg[]= $db_field['Registration'];
                                $bookingdate[]= $db_field['BookedDate'];
                                $bookingtime[]= $db_field['BookedTime'];
                                $bookingmade[]= $db_field['BookingMade'];
                                $info[]= $db_field['Info'];
                                $count += 1;
                            }
                        }

                        $rep = 0;
                        
                        while ($rep < $count)
                        {
                            echo "
                            <table>
                                <tr>
                                    <td id = 'bookingdate'> $bookingdate[$rep] </td>
                                    <td id = 'bookingtime'> $bookingtime[$rep] </td>
                                    <td id = 'reg'> $reg[$rep] </td>
                                    <td id = 'bookinghmade'> $bookingmade[$rep] </td>
                                    <td id = 'info'> $info[$rep] </td>
                                    <td id = 'bookingid'> $bookingid[$rep] </td>
                                    <td id = 'delete'> <input type = 'submit' id = 'del' name = '$bookingid[$rep]' class='button' value = 'delete'> </td>
                                </tr>
                            </table>";
                            $rep += 1;
                        }

                        // deleting appointmnet if triggered
                        if ($bookingid)
                        {
                            foreach ($bookingid as $single_id) 
                            {
                                if (isset($_POST[$single_id])) 
                                {
                                    $sql = "delete from bookings where BookingID = '$single_id'";
                                    mysqli_query($con, $sql);
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                            }
                        }

                    ?>
                </form>
            </div>
            
            <!-- past bookings table -->
            <div class = "pastbookings">
                <h4 id = "pasttitle">Past Appointments</h4>
                <table>
                    <th id = 'bookingdatepast'> Date </th>
                    <th id = 'bookingtimepast'> Time </th>
                    <th id = 'regpast'> Vehicle </th>
                    <th id = 'bookingmadepast'> Made On </th>
                    <th id = 'infopast'> Additional Notes </th>
                    <th id = 'bookingidpast'> Appointment ID </th>
                </table>
                <?php
                    $_SESSION;
                    $user_data = check_login($con);
                    $user_id = $_SESSION["id"]; 
                    $sql = "select BookingID, Registration, BookedDate, BookedTime, BookingMade, Info from bookings where CustomerID = '$user_id'";
                    $result = mysqli_query($con, $sql); 
                    $countpast = 0;
                
                    // create a table of past bookings
                    while ($db_field = mysqli_fetch_assoc($result) ) 
                    {
                        date_default_timezone_set('Europe/London');
                        if (date("Y-m-d H:i:s") > ($db_field['BookedDate'] . " " . $db_field['BookedTime']))
                        {
                            $bookingidpast[]= $db_field['BookingID'];
                            $regpast[]= $db_field['Registration'];
                            $bookingdatepast[]= $db_field['BookedDate'];
                            $bookingtimepast[]= $db_field['BookedTime'];
                            $bookingmadepast[]= $db_field['BookingMade'];
                            $infopast[]= $db_field['Info'];
                            $countpast += 1;
                        }
                    }

                    $rep = 0;

                    while ($rep < $countpast)
                    {
                        echo "
                        <table>
                            <tr>
                                <td id = 'bookingdatepast'> $bookingdatepast[$rep] </td>
                                <td id = 'bookingtimepast'> $bookingtimepast[$rep] </td>
                                <td id = 'regpast'> $regpast[$rep] </td>
                                <td id = 'bookingmadepast'> $bookingmadepast[$rep] </td>
                                <td id = 'infopast'> $infopast[$rep] </td>
                                <td id = 'bookingidpast'> $bookingidpast[$rep] </td>
                            </tr>
                        </table>";

                        $rep += 1;
                    }
                ?>
            </div>
        </div>
        
        <!-- footer -->
        <footer> 
            <div class = "company">
                <P id = "company"> Company </p>
                <a id = "home" href="Home.php">Home</a>
                <a id = "about" href="About.php">About Us</a>
                <a id = "contact" href="ContactUs.php">Contact Us</a>
            </div>

            <div class = "products">
                <p id = "products"> Prouducts & You </p>
                <a id = "mot" href="MOT.php">Book an MOT!</a> 
                <?PHP if(!(check_login($con) == "False")) {
                echo "<a id = 'account' href='Account.php'>Account</a></P>";
                }
                ?>
            </div>

            <img src = "images\SCOTT'S MOTs-logos_white2.png" height = 150px>

            <div class = "copyright">
                <P>© 2024 SCOTT'S MOTs</p>   
                <P>All Rights Reserved</p>
            </div>
        </footer>

    </body>
</html>
