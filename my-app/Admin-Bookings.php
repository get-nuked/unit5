<?PHP
    session_start();
    $_SESSION;
    include("Connection.php");
    include("Function.php");
    $user_data = check_login($con);
    $user_id = $_SESSION["id"]; 

    $user_data = check_login($con);
  
    // if user is not logged in, they will be rerdirected to the login page
    if(check_login($con) == "False")
    {
        header("Location: Login.php");
    }

    $query = "select * from logindetails where id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    // if the useer is not an admin, they will be redirected to the home page
    if ($user_data['Admin'] == "0")
    {
        header("Location: Home.php");
        die;
    }

?>


<html>
    <head>
        <!-- importing font library -->
        <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
        <link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>

        <title> View </title>

        <style>

            body {
                margin: 0;
            }

            /* scrollbar */
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
                background-color: #161512;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
            }

            /* nav bar links */
            .topnav a {
                float: left;
                color: #EEEEEE;
                text-align: center;
                padding: 8px 50px;
                height: 40px;
                line-height: 15px;
                text-decoration: none;
                font-size: 15px;
                font-family: century-gothic, sans-serif;
                transition: 0.7s;
                display: block;
                margin-top: 10px;
            }

            /* when user hovers over "Hi [firstname]" in the nav bar, the text will be changed to "log out" */
            #logout:hover span{
                display: none;
            }

            #logout:hover:before{
                content: "Log out";
            }

            /* positioning nav bar links */
            .navcentre {
                position: absolute;
                top: 50%;
                left:50%;
                transform: translate(-50%,-50%);
            }

            #navcontent:hover{
                background-color: #77815c;
                width: 120px;
                color: white;
                text-decoration: none;
                border-radius: 20px;
            }

            #navcontent {
                float: left;
                color: #24231a;
                background-color: #f4cdb3;
                text-align: center;
                padding: 5px 0px;
                width: 100px;
                height: 20px;
                line-height: 17.5px;
                text-decoration: none;
                font-size: 15px;
                font-family: century-gothic, sans-serif;
                transition: 0.7s;
                display: block;
                border-radius: 5px;
                margin-top: 10px;
                margin-right: 10px;
            }

            /* logout button */
            #logout:hover{
                background-color: #b84825;
                width: 120px;
                color: white;
                text-decoration: none;
                border-radius: 20px;
                margin-right: 50px;
            }

            #logout {
                float: left;
                color: #DEDCD1;
                background-color: #292825;
                text-align: center;
                padding: 5px 0px;
                width: 100px;
                height: 20px;
                line-height: 17.5px;
                text-decoration: none;
                font-size: 15px;
                font-family: century-gothic, sans-serif;
                transition: 0.7s;
                display: block;
                border-radius: 5px;
                margin-top: 20px;
                margin-right: 60px;
            }

            /* main conatiner */
            .container {
                min-height: 85%;
                width: 90%;
                margin-top: 4%;
                margin-bottom: 5%;
                margin-left: 5%;
                background-color: #f4cdb3;
                border-radius: 20px;
                border: 3px solid #543d2e;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
            }

            /* Appointmnet Viewer title */
            .container h2 {
            font-size: 55px;
            font-family: century-gothic, sans-serif;
            color: #3d1c16; 
            padding-top: 0px;
            margin-left: 75px;
            }

            /* Pending Appointments title */
            .container h4 {
            font-size: 25px;
            font-family: century-gothic, sans-serif;
            color: #161512; 
            }

            #currenttitle {
            padding-top: 20px;
            margin-left: 125px;
            }

            /* Past Appointmnets title */
            #pasttitle {
            padding-top: 30px;
            margin-left: 125px;
            color: #3d1c16;
            }

            /* current bookings */
            .currentbookings {
            min-height: 30%;
            width: 95%;
            margin-top: 0px;
            margin-left: 2.5%;
            background-color: #161512;
            border-radius: 20px;
            padding-top: 20px; 
            padding-bottom: 20px;
            transition: 0.5s;
            border: 3px solid #543d2e;
            }

            .currentbookings:hover {
            background-color: #0f0f0d;
            border-radius: 30px;
            padding-top: 25px;
            padding-bottom: 25px;
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

            /* link in the current appointmnets table to view info about the vehicle/customer */
            .currentbookings a{ 
            color: white;
            transition: 0.5s;
            }

            .currentbookings a:hover{ 
            color: #f4cdb3;
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

            /* past bookings */
            .pastbookings {
                min-height: 30%;
                width: 100%;
                margin-top: 2.5%;
                background-color:#e08860;
                border-radius: 0px 0px 20px 20px;
                transition: 1s;
                border-top: 3px solid #543d2e;
                padding-bottom: 50px;
            }

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
            color: black;
            width: 200px; 
            height: 50px;
            }

            .pastbookings td {
                height:30px;
                color: #3d1c16;
            }

            /* link in the current appointmnets table to view info about the vehicle/customer */
            .pastbookings a {
                height:30px;
                color: #3d1c16;
            }

            /* current bookings table column widths */
            #bookingdate {
                width:10%;
            }

            #bookingtime {
                width:10%;
            }

            #reg {
                width:10%;
            }

            #customer{
                width:10%;
            }

            #bookingmade {
                width:17.5%;
            }

            #info {
                width:32.5%;
            }

            #bookingid {
                width:5%;
            }

            #delete {
                width:2.5%;
            }
            
            #complete {
                width:2.5%;
            }

            /* delete button and complete button */
            #deletebtn {
                background-color: #e08860;
                border-radius: 5px
            }

            #completebtn {
                background-color: #64635a;
                border-radius: 5px
            }

            #deletebtn:hover {
                background-color: #b84825;
                border-radius: 15px
            }

            #completebtn:hover {
                background-color: #77815c;
                border-radius: 15px
            }

            .currentbookings input[type="submit"]{
                border: none;
                padding: 5px 10px 5px 10px;
                font: inherit;
                cursor: pointer;
                outline: inherit;
                transition: 0.5s;
            }

            /* past bookings column widths */
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
                width:17.5%;
            }

            #infopast {
                width:30%;
            }

            #bookingidpast {
                width:5%;
            }

            #completedpast {
                width:17.5%;
            }

            /* customer and vehicle details popup */
            .overlay {
                z-index: 1000;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                height: 100%;
                width: 100%;
                background: rgba(0, 0, 0, 0.8);
                transition: opacity 500ms;
                visibility: hidden;
                opacity: 0;
                margin: 0px;
            }

            .overlay:target {
                visibility: visible;
                opacity: 1;
                height: 100%;
                width: 100%;
            }

            .popup {
                z-index: 2000;
                border-radius: 20px;
                width: 800px;
                position: absolute;
                top:50%;
                left:50%;
                background-color: #f4cdb3;
                transform: translate(-50%,-50%);
                height: 350px;
                display: flex;
            }

            /* close button in popup */
            .popup .close {
                z-index: 3000;
                position: absolute;
                top: 0px;
                right: 40px;
                transition: all 200ms;
                font-size: 100px;
                text-decoration: none;
                color: antiquewhite;
                transition: 0.3s;
            }

            .popup .close:hover {
                color: #DEDCD1;
            }

            @media screen and (max-width: 700px){
                .box{
                width: 70%;
                }
                .popup{
                width: 70%;
                }
            }

            .popup > div {
                width:50%;
                text-align: center;
            }

            /* vehicle details in popup */
            .vehicledetails {
                height: 100%;
                background-color: #7c7b72;
                border-radius: 20px 0px 0px 20px;
                transition: 1s;
            }

            .vehicledetails:hover {
                width: 55%;
            }

            .vehicledetails img {
                height: 100px;
                margin-top: 50px;
            }

            .vehicledetails h3 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #24231a; 
            }

            .vehicledetails p {
                font-size: 20px;
                font-family: "Courier New", courier;
                font-weight: bold;
                color: #42402f; 
                line-height: 5px
            }

            /* customer details in popup */
            .customerdetails {
                height: 100%;
                border-radius: 0px 20px 20px 0px;
                transition: 1s;
            }

            .customerdetails:hover {
                width: 55%;
            }

            .customerdetails img {
                height: 100px;
                margin-top: 50px;
            }

            .customerdetails h3 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #3d1c16; 
            }

            .customerdetails p {
                font-size: 20px;
                font-family: "Courier New", courier;
                font-weight: bold;
                color: #4f2822; 
                line-height: 5px
            }

        </style>
    </head>

    <body>
    
        <body style="background-color:#161512">

        <!-- nav bar -->
        <div class="topnav">
            <a href="Admin-Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>

            <div class = "navcentre">
                <a id = "navcontent" href="Admin-MOT.php">Create</a>
                <a id = "navcontent" href="Admin-Bookings.php">View</a>
                <a id = "navcontent" href="Admin-Manage.php">Manage</a>
            </div>

            <!-- creating a logout button in the nav bar that says "Hi [firstname]" -->
            <div style="float:right">
            <?PHP
                $_SESSION;
                $user_data = check_login($con);
                $user_id = $_SESSION["id"];  

                $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<a href='Logout.php' id = 'logout'><span>Hi $row[FirstName]</span></a>";
                }      
            ?>
            </div>
        </div>

        <!-- container -->
        <div class = "container">
            <h2>Appointment Viewer</h2>
            <h4 id = "currenttitle">Pending Appointments</h4>

            <!-- current bookings -->
            <div class = "currentbookings">
                <table>
                    <th id = 'complete'>  </th>
                    <th id = 'delete'>  </th>
                    <th id = 'bookingid'> ID </th>
                    <th id = 'bookingdate'> Date </th>
                    <th id = 'bookingtime'> Time </th>
                    <th id = 'reg'> Vehicle </th>
                    <th id = 'customer'> Customer </th>
                    <th id = 'info'> Additional Notes </th>
                    <th id = 'bookingmade'> Made On </th>
                </table>

                <form action="Admin-Bookings.php" method="post">
                    <?php
                        $_SESSION;
                        $user_data = check_login($con);
                        $user_id = $_SESSION["id"]; 
                        $sql = "select BookingID, Registration, BookedDate, BookedTime, BookingMade, Info, CustomerID, Complete from bookings";
                        $result = mysqli_query($con, $sql); 
                        $count = 0;
                        $bookingid = [];
                        $userid = [];

                        // assigning appointmnet info from the databse to arrays if the Booked Date is in the future
                        while ($db_field = mysqli_fetch_assoc($result) ) 
                        {
                            date_default_timezone_set('Europe/London');
                            if ((date("Y-m-d H:i:s") <= ($db_field['BookedDate'] . " " . $db_field['BookedTime'])) and ($db_field['Complete'] == 0))
                            {
                                $bookingid[]= $db_field['BookingID'];
                                $reg[]= $db_field['Registration'];
                                $bookingdate[]= $db_field['BookedDate'];
                                $bookingtime[]= $db_field['BookedTime'];
                                $bookingmade[]= $db_field['BookingMade'];
                                $info[]= $db_field['Info'];
                                $userid[]= $db_field['CustomerID'];
                                $count += 1;
                            }
                        }

                        $rep = 0;
                        
                        // creates pending appointmnet table
                        while ($rep < $count){
                            if(strlen($info[$rep]) > 35)
                            {
                                $info[$rep] = substr($info[$rep], 0, 35) . "...";
                            }

                            echo "
                            <table>
                            <tr>
                                <td id = 'complete'> <input type = 'submit' name = 'complete-$bookingid[$rep]' class='button' id = 'completebtn' value = '✓'> </td>
                                <td id = 'delete'> <input type = 'submit' name = 'del-$bookingid[$rep]' class='button' id = 'deletebtn' value = '✗'> </td>
                                <td id = 'bookingid'> $bookingid[$rep] </td>
                                <td id = 'bookingdate'> $bookingdate[$rep] </td>
                                <td id = 'bookingtime'> $bookingtime[$rep] </td>
                                <td id = 'reg'> <a class='button' id = 'vehiclebtn' name = '$bookingid[$rep]' href='Admin-Bookings.php?ID=$bookingid[$rep]#addpopup' > $reg[$rep] </a> </td>
                                <td id = 'customer'> <a class='button' id = 'customerbtn' name = '$bookingid[$rep]' href='Admin-Bookings.php?ID=$bookingid[$rep]#addpopup'> $userid[$rep] </td>
                                <td id = 'info'> $info[$rep] </td>
                                <td id = 'bookingmade'> $bookingmade[$rep] </td>
                            </tr>
                            </table>";
                            $rep += 1;
                        }

                        // checks if any delete or complete buttons are clicked
                        if ($bookingid)
                        {
                            foreach ($bookingid as $single_id) 
                            {
                                // deletes any selected appointmnets 
                                if (isset($_POST['del-'.$single_id])) 
                                {
                                    $sql = "delete from bookings where BookingID = '$single_id'";
                                    mysqli_query($con, $sql);
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }

                                // marks as complete any selected appointments.
                                if (isset($_POST['complete-'.$single_id])) 
                                {
                                    date_default_timezone_set('Europe/London');
                                    $date = date("Y-m-d H:i:s");
                                    $sql = "update bookings set Complete= 1, CompletedOn = '$date' where BookingID = '$single_id'";
                                    mysqli_query($con, $sql);
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                            }
                        }
                        

                    ?>
                </form>
            </div>

            <!-- past bookings -->
            <div class = "pastbookings">
                <h4 id = "pasttitle">Past Appointments</h4>
                <table>
                <th id = 'bookingidpast'> ID </th>
                <th id = 'bookingdatepast'> Date </th>
                <th id = 'bookingtimepast'> Time </th>
                <th id = 'regpast'> Vehicle </th>
                <th id = 'infopast'> Additional Notes </th>
                <th id = 'bookingmadepast'> Made On </th>
                <th id = 'completedpast'> Completed </th>
                </table>
                <?php
                    $_SESSION;
                    $user_data = check_login($con);
                    $user_id = $_SESSION["id"]; 
                    $sql = "select BookingID, Registration, BookedDate, BookedTime, BookingMade, Info, Complete, CompletedOn from bookings";
                    $result = mysqli_query($con, $sql); 
                    $countpast = 0;
                
                    // if appointmnets is in the past or marked as comlete, they will be assigned to the following arrays
                    while ($db_field = mysqli_fetch_assoc($result) ) {
                        date_default_timezone_set('Europe/London');
                        if ((date("Y-m-d H:i:s") > ($db_field['BookedDate'] . " " . $db_field['BookedTime'])) or ($db_field['Complete'] == 1)){
                                $bookingidpast[]= $db_field['BookingID'];
                                $regpast[]= $db_field['Registration'];
                                $bookingdatepast[]= $db_field['BookedDate'];
                                $bookingtimepast[]= $db_field['BookedTime'];
                                $bookingmadepast[]= $db_field['BookingMade'];
                                $infopast[]= $db_field['Info'];
                                $completedpast[]= $db_field['CompletedOn'];
                                $countpast += 1;
                        }
                    }

                    $rep = 0;

                    // creates past bookings table
                    while ($rep < $countpast){
                        $completeddate = "";
                        if ($completedpast[$rep] == "0000-00-00 00:00:00")
                        {
                            $completeddate = "-";
                        } else 
                        {
                            $completeddate = $completedpast[$rep];
                        }

                        if(strlen($infopast[$rep]) > 25)
                        {
                            $infopast[$rep] = substr($infopast[$rep], 0, 25) . "...";
                        }

                        echo "
                        <table>
                        <tr>
                            <td id = 'bookingidpast'> $bookingidpast[$rep] </td>
                            <td id = 'bookingdatepast'> $bookingdatepast[$rep] </td>
                            <td id = 'bookingtimepast'> $bookingtimepast[$rep] </td>
                            <td id = 'regpast'> <a class='button' id = 'vehiclebtn' name = '$bookingidpast[$rep]' href='Admin-Bookings.php?ID=$bookingidpast[$rep]#addpopup' > $regpast[$rep] </a> </td>
                            <td id = 'infopast'> $infopast[$rep] </td>
                            <td id = 'bookingmadepast'> $bookingmadepast[$rep] </td>
                            <td id = 'completedpast'> $completeddate </td>
                        </tr>
                        </table>";
                        $rep += 1;
                    }
                ?>
            </div>
        </div>
        
        <!-- details popup -->
        <div id = "addpopup" class = "overlay">
            <div class="popup">
                <a class="close" href="#">&times;</a>
                <div class = "vehicledetails">
                    <?PHP
                        $reg = "";
                        $make = "";
                        $model = "";
                        $year = "";
                        $colour = "";
                        $type = "";
                        $selectedid = $_GET['ID'];

                        $sql = "select Registration from bookings where BookingID = '$selectedid'";
                        $result = mysqli_query($con, $sql);
                        while ( $db_field = mysqli_fetch_assoc($result) ) {
                            $reg = $db_field['Registration'];
                        }

                        $sql = "select * from cars where Registration = '$reg'";
                        $result = mysqli_query($con, $sql);
                        while ( $db_field = mysqli_fetch_assoc($result) ) {
                            $make = $db_field['Make'];
                            $model = $db_field['Model'];
                            $year = $db_field['ModelYear'];
                            $colour = $db_field['Colour'];
                            $type = $db_field['Type'];
                        }

                        if(strlen($make) > 15)
                        {
                            {
                                $make = substr($make, 0, 15) . "...";
                            }
                        }

                        if(strlen($model) > 15)
                        {
                            {
                                $model = substr($model, 0, 15) . "...";
                            }
                        }

                        if(strlen($colour) > 15)
                        {
                            {
                                $colour = substr($colour, 0, 15) . "...";
                            }
                        }

                        // info about the respective appointmnet
                        echo "<img src = 'images/morris.png' height = 100px>";
                        echo "<h3> $year $make $model</h3>";
                        echo "<p> $type </p>";
                        echo "<p> $colour </p>";
                        echo "<p> $reg </p>";
                    ?>
                </div>

                <div class = "customerdetails">
                    <?PHP
                        $customerid = "";
                        $firstname = "";
                        $lastname = "";
                        $phone = "";
                        $email = "";
                        $selectedid = $_GET['ID'];


                        $sql = "select CustomerID from bookings where BookingID = '$selectedid'";
                        $result = mysqli_query($con, $sql);
                        while ( $db_field = mysqli_fetch_assoc($result) ) {
                            $customerid = $db_field['CustomerID'];
                        }

                        $sql = "select * from customerdetails where CustomerID = '$customerid'";
                        $result = mysqli_query($con, $sql);
                        while ( $db_field = mysqli_fetch_assoc($result) ) {
                            $firstname = $db_field['FirstName'];
                            $lastname = $db_field['LastName'];
                            $phone = $db_field['Phone'];
                        }

                        $sql = "select user_name from logindetails where id = '$customerid'";
                        $result = mysqli_query($con, $sql);
                        while ( $db_field = mysqli_fetch_assoc($result) ) {
                            $email = $db_field['user_name'];
                        }

                        if(strlen($firstname) > 15)
                        {
                            {
                                $firstname = substr($firstname, 0, 15) . "...";
                            }
                        }

                        if(strlen($lastname) > 15)
                        {
                            {
                                $lastname = substr($lastname, 0, 15) . "...";
                            }
                        }

                        if(strlen($email) > 50)
                        {
                            {
                                $email = substr($email, 0, 50) . "...";
                            }
                        }

                        // info about the customer from the selevted appointment
                        echo "<img src = 'images/car6.png'>";
                        echo "<h3> $firstname $lastname </h3>";
                        echo "<p> $phone </p>";
                        echo "<p> $email </p>";
                    ?>
                </div>
            </div>
        </div>


    </body>
</html>
