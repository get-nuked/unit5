<?PHP
    session_start();
    $_SESSION;
    $_error_message = "";
    include("Connection.php");
    include("Function.php");
    $error = "";

    $_SESSION;
    $user_data = check_login($con);
    $user_id = $_SESSION["id"];  
    $query = "select * from logindetails where id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);


    if(check_login($con) == "False")
    {
      header("Location: Login.php");
    }

    $query = "select * from logindetails where id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    if ($user_data['Admin'] == "0")
    {
       header("Location: Home.php");
       die;
    }

?>
  
<html>
    <head>

        <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
        <link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>

        <title> Admin Home </title>

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
            
            ::-webkit-scrollbar-thumb {
                background: #d0c2a6; 
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #ffeecb; 
            }

            /* nav bar */
            .topnav {
                background-color: #11110f;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
            }

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


            #logout:hover span{
                display: none;
            }

            #logout:hover:before{
                content: "Log out";
            }

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

            /* log out button */
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

            /* background image */
            .wallpaper img {
                width: 90%;
                margin-left: 5%;
                margin-top: 4%;
                border-radius: 20px 20px 0px 0px;
            }

            .wallpaper h3 {
                color: white;
                font-size: 80px;
                font-family: century-gothic, sans-serif;
                position: absolute;
                top: 40%;
                left:50%;
                transform: translate(-50%,-50%);
                z-index: 1000;
            }

            /* stats */
            .wallpaper table {
                position: absolute;
                top: 80%;
                left:50%;
                transform: translate(-50%,-50%);
                width: 60%;
                text-align: center;
                font-family: century-gothic, sans-serif;
            }

            .wallpaper th{
                font-size: 120px;
                color: antiquewhite;
            }

            .wallpaper td{
                font-size: 25px;
                color: #f4cdb3;
                font-weight: bold;
            }

            #todaybookings{
                width: 25%;
            }

            #totalbookings{
                width: 25%;
            }

            #totalcars{
                width: 25%;
            }

            #totalusers{
                width: 25%;
            }

            /* customer site button */
            .customerside {
                width: 90%;
                height: 75px;
                margin-left: 5%;
                border-radius: 0px 0px 20px 20px;
                background-color: black;
                margin-bottom: 4%;
            }

            .customerside a {
                float: right;
                text-align: center;
                font-family: century-gothic, sans-serif;
                font-size: 18px;
                color: black;
                text-decoration: none;
            }

            .customerbtn {
                margin-right: 100px;
                line-height: 30px;
                width: 210px;
                height:30px;
                background-color: #f0c002;
                border-radius: 5px;
                transition: 0.4s;
            }

            .customerbtn:hover {
                margin-right: 90px;
                width: 230px;
                background-color: #f4cdb3;
                border-radius: 20px;
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
            <div style="float:right">
            <?PHP
            $_SESSION;
            $user_data = check_login($con);
            $user_id = $_SESSION["id"];  

            // logout button
            $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<a href='Logout.php' id = 'logout'><span>Hi $row[FirstName]</span></a>";
            }      
            ?>
            </div>
        </div>

        <div class = "wallpaper">
            <img src="images\Adminhome.jpg">

            <?PHP
                $_SESSION;
                $user_data = check_login($con);
                $user_id = $_SESSION["id"];  
                date_default_timezone_set("Europe/London");
					
                $totalusers = 0;
                $totalcars = 0;
                $totalbookings = 0;
                $todaybookings = 0;

                // Hello [firstname]! in the home page
                $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    $name = $row['FirstName'];
                }     

                // stats
                
                // counts the number of users exclusing admins
                $sql = "SELECT * FROM logindetails WHERE Admin = '0'";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    $totalusers = $totalusers + 1;
                }      

                // counts the total number of cars
                $sql = "SELECT * FROM cars";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    $totalcars = $totalcars + 1;
                }  

                // counts the toal number of bookings
                $sql = "SELECT BookingID FROM bookings";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    $totalbookings = $row['BookingID'];
                }  

                // counts the number of the appointmnets made tday
                $sql = "SELECT BookingMade FROM bookings";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    if (substr($row['BookingMade'], 0, -9) == date("Y-m-d")){
                        $todaybookings = $todaybookings + 1;
                    }
                } 
            ?>
            
            <h3> Hello <?PHP echo $name; ?>!</h3>

            <!-- outputs the stats -->
            <table>
                <tr>
                    <th id = "todaybookings">
                        <?php echo $todaybookings; ?>
                    </th>
                    
                    <th id = "totalbookings">
                        <?php echo $totalbookings; ?>
                    </th>
                    
                    <th  id = "totalcars">
                        <?php echo $totalcars; ?>
                    </th>

                    <th  id = "totalusers">
                        <?php echo $totalusers; ?>
                    </th>
                </tr>

                <tr>
                    <td id = "todaybookings">
                        appointments made today.
                    </td>

                    <td id = "totalbookings">
                        appointments made ever.
                    </td>

                    <td  id = "totalcars">
                        vehicles
                    </td>

                    <td id = "totalusers">
                        customers
                    </td >
                </tr>
            </table>
        </div>

        <!-- button to visit the customer side of the websoite -->
        <div class = "customerside">
            <a href = "Home.php">
                <div class = "customerbtn">
                    View Customer Page
                </div>
            </a>
        </div>

    </body>
</html>

