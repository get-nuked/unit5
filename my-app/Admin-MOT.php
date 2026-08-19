<?PHP
    session_start();
    $_SESSION;
    include("Connection.php");
    include("Function.php");
    $user_data = check_login($con);
    $user_id = $_SESSION["id"]; 

    $user_data = check_login($con);

    $query = "select * from logindetails where id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);

    // redirects non admin users
    if(check_login($con) == "False")
    {
      header("Location: Login.php");
    }

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

        <title> Create </title>

        <script type="text/JavaScript">
            // creates an error notification
            function errornotif()
            {
            alert("Appointment not created \n\n <?PHP echo $error; ?>");
            }
        </script>

        <style>
             body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                color: #191923
            }

            /* custom scroll bar */
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

            /* logout button */
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

            /* customer and appointmnets details */
            .topbox {
                min-height: 50%;
                width: 90%;
                margin-top: 4%;
                margin-left: 5%;
                background-color: #f5e0a6;
                border-radius: 20px 20px 0px 0px;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
                border: 3px solid #543d2e;
            }

            /* Appointment creator title */
            .topbox h2 {
                font-size: 55px;
                font-family: century-gothic, sans-serif;
                color: #543d2e; 
                margin-left: 75px;
            }

            /* customer details box */
            .customerdetails {
                float:left;
                width: 64%;
            }

            /* customer details title */
            .customerdetails h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: black; 
                padding-top: 20px;
                margin-left: 125px;
            }

            /* customer details text */
            .customerdetails p {
                font-size: 20px;
                font-family: century-gothic, sans-serif;
                color: #3d1c16; 
                margin-top: 5px;
                margin-left: 100px;
            }

            /* customer details input fields */
            .customerdetailsinput {
                position: absolute;
                top: 400px;
                left: 700px;
                transform: translate(-50%,-50%);  
                width: 30%;
            }

            .customerdetailsinput input{
                width: 100%;
                border-radius: 5px;
                border: 2px solid #543d2e;
                height: 32px;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                margin-top: 15px;
                background: white;
                color: #614939;
            }

            /* booking details box */
            .bookingdetails {
                float: right;
                width: 35%;
            }

            /* booking details title */
            .bookingdetails h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: black; 
                margin-left: 100px;
                margin-top: 175px;
            }

            /* booking details inputs */
            .bookingcontent input {
                border-radius: 5px;
                background: #faf8ed;
                border: 2px solid #543d2e;
                height: 30px;
                color: #24231f;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
            }

            .bookingcontent input[type=time]{
                float: right;
                margin-right: 20%;
                width: 33%;
            }

            .bookingcontent input[type=date]{
                float: left;
                margin-left: 10%;
                width: 33%;
            }

            .bookingcontent textarea{
                margin-left: 10%;
                margin-top: 2%;
                width: 70%;
                border-radius: 5px;
                background: #faf8ed;
                border: 2px solid #543d2e;
                height: 30px;
                color: #24231f;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                resize: none;
                height: 125px;
            }

            /* vehicle details box */
            .vehicledetails{
                margin-top: 0px;
                background-color: #f5b940;
                transition: 1s;
                width: 90%;
                margin-left: 5%;
                height: 43%;
                padding-top: 2%;
                padding-bottom: 5%;
                border-left: 3px solid #543d2e;
                border-right: 3px solid #543d2e;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
            }

            /* vehicle details title */
            .vehicledetails h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: black; 
                margin-left: 125px;
            }

            .vehiclecontent{
                height:89%;
                width: 90%;
                border-radius: 30px;
                background-color: #161512;
                margin-left: 5%;
            }

            .vehiclecontent img{
                margin-top: 7%;
                margin-left: 12.5%;
                height: 35%;
                float: left;
            }

            /* vehicle details input fields */
            .vehicledetailsinput {
                width: 55%;
                float: right;
                margin-right: 4%;
            }

            .vehicledetailsinput input{
                width: 100%;
                border-radius: 5px;
                background: #24231f;
                border: none;
                height: 30px;
                color: #faf8ed;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                margin-top: 2.5%;
            }

            #reg {
                margin-top: 5%;
            }

            /* dropdown menu for body style */
            .vehicledetailsinput select{
                width: 100%;
                border-radius: 5px;
                background: #24231f;
                border: none;
                height: 30px;
                color: #faf8ed;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                margin-top: 2.5%;
            }

            .vehicledetailsinput option{
                width: 100%;
                border-radius: 5px;
                background: #21201c;
                border: none;
                height: 30px;
                color: #faf8ed;
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
            }

            /* last box */
            .actions{
                margin-top: 0px;
                background-color: #bd852b;
                transition: 1s;
                width: 90%;
                margin-left: 5%;
                margin-bottom: 5%;
                padding-top: 3%;
                padding-bottom: 4%;
                border-radius: 0px 0px 20px 20px;
                border: 3px solid #543d2e;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
            }

            /* cancel button */
            #cancel {
                height: 40px;
                border-radius: 20px;
                width: 17.5%;
                border: none;
                font-size: 20px;
                font-family: century-gothic, sans-serif;
                margin-right: 2.5%;
                margin-left: 25%;
                background: wheat;
                transition: 0.5s;
                font-weight: bold;
                border: 3px solid #543d2e;
            }

            #cancel:hover {
                width: 19.5%;
                margin-right: 1.5%;
                margin-left: 24%;
                background-color: #c44e29;
                color:#DEDCD1;
            }

            /* submit button */
            #save {
                height: 40px;
                border-radius: 20px;
                width: 27.5%;
                border: none;
                font-size: 20px;
                margin-left: 2.5%;
                font-family: century-gothic, sans-serif;
                transition: 0.4s;
                font-weight: bold;
                border: 3px solid #543d2e;
            }

            #save:hover {
                width: 30.5%;
                margin-left: 1%;
                background: wheat;
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

                $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<a href='Logout.php' id = 'logout'><span>Hi $row[FirstName]</span></a>";
                }      
            ?>
            </div>
        </div>

        <!-- customer and appointmnet details -->
        <form method = "post">
            <div class = "topbox">

                <!-- customer details  -->
                <div class = "customerdetails">
                    <h2>Appointment Creator</h2>
                    <h4>Customer Details</h4>
                    <p>First Name</p>
                    <p>Last Name</p>
                    <p>Phone</p>
                    <p>Email</p>
                    <div class = "customerdetailsinput">
                            <input type="text" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" placeholder="First Name" name="firstname" id  = "customer" required>
                            <input type="text" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" placeholder="Last Name" name="lastname" id  = "customer" required>
                            <input type="text" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" placeholder="Phone" name="phone" id  = "customer" required>
                            <input type="text" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email" name="email" id  = "customer" required>
                    </div>
                </div>

                <!-- appointmnet details -->
                <div class = "bookingdetails">
                    <h4>Appointment Details</h4>
                    <div class = "bookingcontent">
                            <input type="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" id="date" name="date">
                            <input type="time" value="<?php if (isset($_POST['time'])) echo $_POST['time']; ?>" id="time" name="time" min="09:00" max="18:00"/>
                            <textarea placeholder = 'additional info' name="addinfo" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- vehicle details -->
            <div class = "vehicledetails">
                <h4>Vehicle Details</h4>
                <div class = "vehiclecontent">
                    <img src = "images/morris2.png">
                    <div class = "vehicledetailsinput">
                            <input type='text' value="<?php if (isset($_POST['reg'])) echo $_POST['reg']; ?>" placeholder = 'Registration' name = 'reg' id = 'reg'>
                            <input type='text' value="<?php if (isset($_POST['make'])) echo $_POST['make']; ?>" placeholder = 'Make' name = 'make'>
                            <input type='text' value="<?php if (isset($_POST['model'])) echo $_POST['model']; ?>" placeholder = 'Model' name = 'model'>
                            <input type='text' value="<?php if (isset($_POST['year'])) echo $_POST['year']; ?>" placeholder = 'Model Year' name = 'year'>
                            <select name = "type">
                                <option value = 'Cabriolet'>Cabriolet</option>
                                <option value = 'Coupe'>Coupe</option>
                                <option value = 'Crossover/SUV'>Crossover/SUV</option>
                                <option value = 'Estate'>Estate</option>
                                <option value = 'Hatchback'>Hatchback</option>
                                <option value = 'Motor Caravan'>Motor Caravan</option>
                                <option value = 'Motorcycle'>Motorcycle</option>
                                <option value = 'MPV'>MPV</option>
                                <option value = 'Saloon'>Saloon</option>
                            </select>
                            <input type='text' value="<?php if (isset($_POST['colour'])) echo $_POST['colour']; ?>" placeholder = 'Colour' name = 'colour'>
                    </div>
                </div>
            </div>

            <!-- buttons -->
            <div class = "actions">
                <form method = "post">
                    <input type = "submit" id = "cancel" name = "cancel" value = "Cancel">
                    <input type = "submit" id = "save" name = "save" value = "Submit">
                </form>
            </div>
        </form>

        <?PHP 
            // if saved
            if (isset($_POST['save'])){
                $first = "";
                $last = "";
                $phone = "";
                $email = "";
                $time = "";
                $date = "";
                $addinfo = "";
                $reg = "";
                $make = "";
                $model = "";
                $year = "";
                $type = "";
                $colour = "";
                $error = "";
                $customer_id = "";


                $first = $_POST['firstname'];
                $last = $_POST['lastname'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $time = $_POST['time'];
                $date = $_POST['date'];
                $addinfo = $_POST['addinfo'];
                $reg = $_POST['reg'];
                $make = $_POST['make'];
                $model = $_POST['model'];
                $year = $_POST['year'];
                $type = $_POST['type'];
                $colour = $_POST['colour'];
                $password = password_hash('Password1', PASSWORD_DEFAULT);
                $errorfound = false;
                date_default_timezone_set("Europe/London");


                // validation

                //presence check
                if ($first == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($last == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($phone == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($email == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($time == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($date == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if (isset($_POST) And isset($_POST['addinfo']))
                {
                    if (!empty($_POST['addinfo'])){
                        $addinfo = $_POST['addinfo'];
                    }else
                    {
                        $addinfo = "-";
                    }
                }else 
                {
                    $addinfo = "-";
                }

                // if the sel;ected date and time is in the past, an error occurs
                if ($date <  date("Y-m-d"))
                {
                    $errorfound = true;
                    $error = "Invalid Date";
                } else if (($date ==  date("Y-m-d")) && ($time < date("H:i:s")))
                {
                    $errorfound = true;
                    $error = "Invalid Time";
                }

                $opentime = "09:00";
                $closetime = "18:00";
                if ($time > $closetime or $time < $opentime)
                {
                    $errorfound = true;
                    $error = "We are closed, we open at " . $opentime . " and close at " . $closetime;
                }

                $dt1 = strtotime($date);
                $dt2 = date("l", $dt1);
                $dt3 = strtolower($dt2);
                if(($dt3 == "saturday" )|| ($dt3 == "sunday"))
                {
                    $errorfound = true;
                    $error = "We are closed on the weekend";;
                } 

                if ($reg == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($make == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($model == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($year == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                if ($colour == "")
                {
                    $error =  "field(s) left blank";
                    $errorfound = true;
                }

                // checking if additional info is empty and adding a dash if it is
                if (!empty($addinfo)){
                    $addinfo == "-";
                }

                if (strlen($addinfo) > 1000)
                {
                    $errorfound = true;
                    $error = "Additional infomation must be less than 1000 characters.";
                }

                // phone length check and type check
                if(strlen($phone) !== 11 or is_numeric($phone) == 0)
                {
                    if(((substr($phone, 0, 1) !== "+") or (substr($phone, 0, 1) !== "0")) && (strlen($phone) < 11))
                    {
                        $phone = substr_replace($phone, 0, 0, 0);
                    }

                    if((substr($phone, 0, 1) !== "+") && (strlen($phone) !== 11))
                    {
                        $error =  "contact number should be a 11 digit integer";
                        $errorfound = true;
                    } else if((substr($phone, 0, 1) == "+") && ((strlen($phone) > 14) or (strlen($phone) < 12)))
                    {
                        $error =  "contact number with calling code should be either 12, 13 or 14 digits";
                        $errorfound = true;
                    }
                }

                // reg length check
                if(strlen($reg) > 8){
                    $error =  "registration should be 7 characters or shorter";
                    $errorfound = true;
                }

                // checks if the car already exist in the database
                $carexists = false;
                $query = "select * from logindetails where user_name = '$email'";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_assoc($result);
                    $emailid = $row['id'];
                }     

                $query = "select * from cars where Registration = '$reg'";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0)
                {
                    $carowner = mysqli_fetch_assoc($result);
                    if($carowner['user_id'] !== $emailid)
                    {
                        $carexists = true;
                    }
                }     

                if ($carexists == true)
                {
                    $error =  "This vehicle is registered with a different user";
                    $errorfound = true;
                }

                if(strlen($first) > 50){
                    $error =  "first name should be 50 characters or shorter";
                    $errorfound = true;
                }

                if(strlen($last) > 50){
                    $error =  "last name should be 50 characters or shorter";
                    $errorfound = true;
                }

                if(strlen($email) > 70){
                    $error =  "email should be 50 characters or shorter";
                    $errorfound = true;
                }

                if(strlen($make) > 50){
                    $error =  "make should be 50 characters or shorter";
                    $errorfound = true;
                }

                if(strlen($model) > 100){
                    $error =  "model name should be 100 characters or shorter";
                    $errorfound = true;
                }

                // length check on year
                if((strlen((string)$year) !== 4) or (is_numeric($year) == 0)){
                    $error =  "model year should be a 4 digit integer";
                    $errorfound = true;
                }

                if(strlen($colour) > 50){
                    $error =  "paint name should be 50 characters or shorter";
                    $errorfound = true;
                }

                // format check on email
                if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                    $error = "$email is not a valid email address";
                    $errorfound = true;
                }

                $userexists = false;
                $userfound = "";

                // checks if user exists in the databse
                $query = "select * from logindetails where user_name = '$email'";
                $result = mysqli_query($con, $query);
                while($row = $result->fetch_assoc()) {
                    $userfound = $row['user_name'];
                } 

                if (!empty($userfound)) {
                    $userexists = true;
                }
        
                if ($errorfound == false)
                {
                    // if no errors found and user exists
                    if ($userexists == true)
                    {
                        $query = "select id from logindetails where user_name = '$email'";
                        $result = mysqli_query($con, $query);
                        while($row = $result->fetch_assoc()) {
                            $customer_id = $row['id'];
                        }     

                        $sql = "insert into cars (Registration, Make, Model, ModelYear, Colour, Type, user_id)  values('$reg', '$make', '$model', '$year', '$colour', '$type','$customer_id')";
                        mysqli_query($con, $sql); 

                        $sql = "insert into bookings(CustomerID, Registration, BookedDate, BookedTime, Info, CompletedOn, Complete) values('$customer_id ','$reg','$date', '$time', '$addinfo', '0000-00-00 00:00:00', 0)";
                        mysqli_query($con, $sql);
                    } elseif ($userexists == false) 
                    // if no error and user does not exist
                    {
                        $query = "insert into logindetails (user_name, password, Admin) values ('$email','$password', 0)";
                        mysqli_query($con, $query);

                        $query = "select id from logindetails where user_name = '$email'";
                        $result = mysqli_query($con, $query);
                        while($row = $result->fetch_assoc()) {
                            $customer_id = $row['id'];
                        }     

                        $query = "insert into customerdetails (CustomerID, FirstName, LastName, Phone) values ('$customer_id ','$first','$last' ,'$phone')";
                        mysqli_query($con, $query);

                        $sql = "insert into cars (Registration, Make, Model, ModelYear, Colour, Type, user_id)  values('$reg', '$make', '$model', '$year', '$colour', '$type','$customer_id')";
                        mysqli_query($con, $sql); 

                        $sql = "insert into bookings(CustomerID, Registration, BookedDate, BookedTime, Info, CompletedOn, Complete) values('$customer_id ','$reg','$date', '$time', '$addinfo', '0000-00-00 00:00:00', 0)";
                        mysqli_query($con, $sql);
                    }
                } else if ($errorfound == true)
                { 
                ?>
                    <!-- if error found, it is displayed as an error message -->
                    <script>
                        alert("Appointment not created \n\n <?PHP echo $error; ?>")
                    </script>';
                
                <?PHP
                }

            }
        ?>


    </body>
</html>

    