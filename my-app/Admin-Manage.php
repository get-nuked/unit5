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

    // user redirected if not admin
    if ($user_data['Admin'] == "0")
    {
        header("Location: Home.php");
        die;
    }

    if(check_login($con) == "False")
    {
      header("Location: Login.php");
    }

    $query = "select * from logindetails where id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);
?>

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
  
<html>
    <script type="text/JavaScript">
        // creates an error notification
        function errornotif()
        {
        alert("Price not saved \n\n <?PHP echo $error; ?>");
        }
    </script>

    <head>

        <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
        <link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>

        <title> Manage </title>

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

            /* main container */
            .container {
                float: left;
                height: 96%;
                width: 90%;
                margin-top: 4%;
                margin-bottom: 5%;
                margin-left: 5%;
                background-color: #fad4a0;
                border-radius: 20px;
                border: 3px solid #543d2e;
                display: flex;
                flex-wrap: wrap;
                box-shadow:
                0 1px 1px hsl(0deg 0% 0% / 0.075),
                0 2px 2px hsl(0deg 0% 0% / 0.075),
                0 4px 4px hsl(0deg 0% 0% / 0.075),
                0 8px 8px hsl(0deg 0% 0% / 0.075),
                0 16px 16px hsl(0deg 0% 0% / 0.075);
            }

            /* Manage title */
            .container h2 {
                font-size: 55px;
                font-family: century-gothic, sans-serif;
                color: #3d1c16; 
                margin-left: 75px;
            }

            /* users box */
            .users {
                height: 60%;
                width: 60%;
                margin-top: 0%;
                background-color:  #db8344;
                border-top: 3px solid #543d2e;
                flex: 6;
            }

            /* users title */
            .users h4 {
                margin-top: 5%;
                margin-left: 100px;
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #161512; 
            }

            /* table of users */
            .userstable{
                height: 76%;
                overflow: auto;
                width: 92.5%;
                margin-top: 0%;
                margin-left: 3.75%;
                margin-bottom: 3.75%;
                background-color: #161512;
                border-radius: 20px;
                padding-top: 20px; 
                padding-bottom: 20px;
                transition: 0.5s;
                border: 3px solid #543d2e;
            }

            .users img {
                height: 30px;
            }

            .users table {
                font-size: 20px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                color:#f4cdb3;
                width: 95%;
                margin-left: 1%;
            }

            .users td{
                height: 40px;
            }

            /* column widths */
            #userphp{
                width: 7.5%;
                padding-left: 0px;
            }

            #userinfo{
                width: 55%;
            }

            #userpassword{
                width: 10%;
            }

            #userdisable{
                width: 10%;
            }

            #useradmin{
                width: 17.5%;
            }

            /* reset password button */
            #passwordbtn {
                width: 90%;
                margin-left: 5%;
                border-radius: 5px;
                border: none;
                height: 25px;
                transition: 0.3s;
                font-size: 15px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                border: 3px solid #543d2e;
                background-color: white;
            }

            #passwordbtn:hover{
                border-radius: 20px;
                width: 100%;
                margin-left: 0%;
            }

            /* disable account button */
            #disablebtn {
                width: 90%;
                margin-left: 5%;
                border-radius: 5px;
                border: none;
                height: 25px;
                transition: 0.3s;
                font-size: 15px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                border: 3px solid #543d2e;
            }

            #disablebtn:hover{
                border-radius: 20px;
                width: 100%;
                margin-left: 0%;
            }

            /* make admin button */
            #adminbtn {
                width: 90%;
                margin-left: 5%;
                border-radius: 5px;
                border: none;
                height: 25px;
                transition: 0.3s;
                font-size: 15px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                background-color: #f4cdb3;
                border: 3px solid #543d2e;
            }

            #adminbtn:hover{
                border-radius: 20px;
                width: 100%;
                margin-left: 0%;
            }

            /* Manage price box */
            .price {
                height: 40%;
                width: 60%;
                margin-top: 0%;
                background-color: #e37036;
                border-radius: 0px 0px 0px 20px;
                border-top: 3px solid #543d2e;
                flex: 6;
            }

            /* manage price button */
            .price h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #161512; 
                margin-top: 5%;
                margin-left: 100px;
            }

            /* manage price text */
            .pricetext{
                margin-top: 10px;
                float: left;
                width: 30%;
            }

            .pricetext p {
                font-size: 20px;
                font-family: century-gothic, sans-serif;
                color: #3d1c16; 
                font-weight: bold;
                margin-top: 0px;
                margin-left: 75px;
                line-height:17px;
            }

            /* manage price inputs */
            .priceinput {
                float: right;
                width: 70%;
            }

            .priceinput input[type="text"] {
                width: 90%;
                border-radius: 5px;
                border: 2px solid #543d2e;
                height: 27px;
                font-size: 18px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                margin-top: 10px;
                background: white;
                color: #614939;
            }

            .priceinput input[type="submit"] {
                margin-top: 15px;
                margin-left: 23.75%;
                width: 40%;
                border: 2px solid #543d2e;
                height: 30px;
                background-color: wheat;;
                border-radius: 20px;
                font-size: 17px;
                font-family: century-gothic, sans-serif;
                margin-bottom: 5%;
                transition: 0.3s;
            }

            .priceinput input[type="submit"]:hover {
                margin-left: 21.25%;
                width: 45%;
            }

            /* manage vehicle box */
            .vehicles {
                float: right;
                height: 100.1%;
                width: 39.87%;
                margin-top: 0%;
                border-radius: 0px 0px 20px 0px;
                background-color: #f1ae65;
                border-top: 3px solid #543d2e;
                border-left: 3px solid #543d2e;
                flex: 4;
                overflow: auto;
            }

            /* vehicles title */
            .vehicles h4 {
                font-size: 25px;
                font-family: century-gothic, sans-serif;
                color: #161512; 
                margin-left: 100px;
                margin-top: 7.5%;
            }

            /* vehicles table */
            .vehiclestable {
                width: 90%;
                margin-left: 5%;
                margin-top: 4%;
            }

            .vehiclestable table{
                font-size: 18px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                color: #543d2e;
                width: 100%;
            }

            .vehiclestable td{
                height: 40px;
            }

            /* column widths */
            #vehicleinfo{
                width: 85%
            }

            #vehicledelete{
                width: 85%;
            }

            #vehicledelete input{
                width: 85%;
                background: #db8344;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                font-family: "Courier New", monospace;
                transition: 0.3s;
                margin-left: 7.5%;
                border: 3px solid #543d2e;
            }

            #vehicledelete input:hover {
                width: 100%;
                border-radius: 20px;
                margin-left: 0%;
                background: #e37036;
            }

        </style>
    </head>
    <script>0</script>
    
    <body>

        <body style="background-color:#161512">

        <div class = "container">
            <form method = "post">
                <h2> Manage </h2>
                
                <div class = "vehicles">
                    <h4> Manage Vehicles </h4>

                    <div class = 'vehiclestable'>
                        <?PHP 
                            $sql = 'select LPAD(user_id, 6, "0"), Registration, ModelYear, Make, Model from cars';
                            $result = mysqli_query($con, $sql); 
                            $vehicles = [];
                            $delete = "delete-";
                    
                            // creating an array of vehicles
                            while ( $db_field = mysqli_fetch_assoc($result) ) {
                                if(strlen($db_field['Make']) > 10)
                                {
                                    $db_field['Make'] = substr($db_field['Make'], 0, 10) . "...";
                                }

                                if(strlen($db_field['Model']) > 20)
                                {
                                    $db_field['Model'] = substr($db_field['Model'], 0, 15) . "...";
                                }

                                $vehicles[] = $db_field['Registration'] . " | " . $db_field['ModelYear'] . " " . $db_field['Make'] . " " . $db_field['Model'];
                            }

                            // creating a table of vehicles with delete button
                            if ($vehicles){
                                foreach ($vehicles as $singlevehicle){
                                    $reg = substr($singlevehicle, 0, strpos($singlevehicle, " "));
                                    $deletevehicle = $delete . $reg;

                                    // delete button is given the name "delete-[vehicle registration]
                                    echo "
                                    <table>
                                        <tr>
                                        <td id = 'vehicleinfo'> $singlevehicle </td>
                                        <td id = 'vehicledelete'> <input type = 'submit' name = '$deletevehicle' value = delete id = 'deletebtn'></td>
                                        </tr>
                                    </table>";

                                    // deletes vehicle if the delete button is clicked
                                    if (isset($_POST[$deletevehicle])) 
                                    {       
                                        $sql = "DELETE FROM `cars` WHERE Registration = '$reg'";
                                        mysqli_query($con, $sql);
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>

                <!-- users table -->
                <div class = "users">
                    <h4> Manage Users </h4>

                    <div class = 'userstable'>
                        <?PHP 
                            $sql = 'select LPAD(id, 6, "0"), user_name from logindetails';
                            $result = mysqli_query($con, $sql); 
                            $users = [];
                            $disable = "disable-";
                    
                            // array of users
                            // user id is made 6 characters long (Adding 0 at the front if needed)
                            while ( $db_field = mysqli_fetch_assoc($result) ) {
                                if(strlen($db_field['user_name']) > 30)
                                {
                                    $db_field['user_name'] = substr($db_field['user_name'], 0, 30) . "...";
                                }

                                $users[] = $db_field['LPAD(id, 6, "0")'] . " | " . $db_field['user_name'];
                            }


                            if ($users){
                                foreach ($users as $singleuser){
                                    $_SESSION;
                                    $currentadmin = $_SESSION["id"]; 

                                    // removes unnecessay 0s from user id
                                    $userid = substr($singleuser, 0, strpos($singleuser, " "));
                                    $userid = (int)$userid;

                                    $sql = "SELECT Disabled, Admin FROM `logindetails` WHERE id = '$userid'";
                                    $disabled = mysqli_query($con, $sql);
                                    $currentstatus = mysqli_fetch_assoc($disabled);

                                    $disableuser = "disable" . $userid;
                                    $disablestatus = "";

                                    $adminuser = "admin" . $userid;
                                    $adminstatus= "";

                                    $passworduser = "password" . $userid;

                                    // hashes default password
                                    $defaultpassword = password_hash("Password1", PASSWORD_DEFAULT);

                                    // reset password and disable account buttons are assigned a colour and a text based on the status
                                    if ($currentstatus['Disabled'] == "1")
                                    {
                                        $disablestatus = "Enable";
                                        $disablecolour = "#d44c1e";
                                    } 
                                    else if ($currentstatus['Disabled'] == "0")
                                    {
                                        $disablestatus = "Disable";
                                        $disablecolour = "#DEDCD1";
                                    }


                                    if ($currentstatus['Admin'] == "1")
                                    {
                                        $adminstatus = "Remove Admin";
                                        $admincolour = "#e0972f";
                                    }
                                    else if ($currentstatus['Admin'] == "0")
                                    {
                                        $adminstatus = "Make Admin";
                                        $admincolour = "wheat";
                                    }

                                    // creates a table of users excluuding the admin currently logged in
                                    if (!($userid == $currentadmin)){
                                        echo "
                                        <table>
                                            <tr>
                                            <td id = 'userpfp'> <img src = 'images\car6.png' align='right'> </td>
                                            <td id = 'userinfo'> $singleuser </td>
                                            <td id = 'userpassword'> <input type = 'submit' name = '$passworduser' value = 'RST PW' id = 'passwordbtn'></td>
                                            <td id = 'userdisable'> <input type = 'submit' name = '$disableuser' value = '$disablestatus' id = 'disablebtn' style='background-color: $disablecolour'></td>
                                            <td id = 'useradmin'> <input type = 'submit' name = '$adminuser' value = '$adminstatus' id = 'adminbtn' style='background-color: $admincolour'></td>
                                            </tr>
                                        </table>";
                                    }
                                    
                                    // resetting password
                                    if (isset($_POST[$passworduser])) 
                                    {
                                        $sql = "UPDATE logindetails SET password = '$defaultpassword' WHERE id = '$userid'";
                                        mysqli_query($con, $sql);  
                                    }

                                    // disabling a user
                                    if (isset($_POST[$disableuser])) 
                                    {
                                        if ($currentstatus['Disabled'] == "1")
                                        {
                                            $sql = "UPDATE logindetails SET Disabled = 0 WHERE id = '$userid'";
                                            mysqli_query($con, $sql);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        } 
                                        else if ($currentstatus['Disabled'] == "0")
                                        {
                                            $sql = "UPDATE logindetails SET Disabled = 1 WHERE id = '$userid'";
                                            mysqli_query($con, $sql);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }
                                    }

                                    // making a user an admin
                                    if (isset($_POST[$adminuser])) 
                                    {
                                        if ($currentstatus['Admin'] == "1")
                                        {
                                            $sql = "UPDATE logindetails SET Admin = 0 WHERE id = '$userid'";
                                            mysqli_query($con, $sql);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        } 
                                        else if ($currentstatus['Admin'] == "0")
                                        {
                                            $sql = "UPDATE logindetails SET Admin = 1 WHERE id = '$userid'";
                                            mysqli_query($con, $sql);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>

                <!-- manage price box -->
                <div class = "price">
                    <h4> Manage Prices </h4>

                    <div class = "pricetext">
                        <p>Cabriolet</p>
                        <p>Coupe</p>
                        <p>Crossover/SUV</p>
                        <p>Estate</p>
                        <p>Hatchback</p>
                        <p>Motor Caravan</p>
                        <p>Motorcycle</p>
                        <p>MPV</p>
                        <p>Saloon</p>
                    </div>

                    <div class = "priceinput">
                        <?php
                            $sql = "SELECT * FROM priceestimate";
                            $result = mysqli_query($con, $sql);

                            // creates input field with current price from the database
                            while ($prices = mysqli_fetch_assoc($result)) {
                                echo "<input type = 'text' name = '$prices[Type]' value = '$prices[Price]'>";
                            }

                            $result = mysqli_query($con, $sql);

                            // updates values if clicked
                            if (isset($_POST['priceupdate'])){
                                $error = "";
                                while ($prices = mysqli_fetch_assoc($result)) {
                                    $price = $_POST[$prices['Type']];
                                    $type = $prices['Type'];

                                    if (strlen($price) == 4 or strlen($price) == 5)
                                    {
                                        if (substr($price, -3, 1) !== ".")
                                        {
                                            $price = substr_replace($price, '.', -2, 0);
                                        }
                                    } else if (strlen($price) <= 3 && $price !== "")
                                    {
                                        if (substr($price, -3, 1) !== ".")
                                        {
                                            $price = $price . ".00";
                                        }
                                    }

                                    if((1 == preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $price)) or (is_numeric($price) == 0)){
                                        $error = "Invalid price";
                                    }

                                    if (strlen($price) > 6)
                                    {
                                        $error = "Price cannot be longer than 6 characters";
                                    }

                                    // if (($pos = strpos($price, ".")) !== FALSE) 
                                    // {
                                    //     $decimalvalues = substr($price, $pos+1);

                                    //     if (strlen((string)$decimalvalues) == 3)
                                    //     {
                                    //         $price = rtrim($price, "0");
                                    //     }

                                    //     if (strlen((string)$decimalvalues) == 4)
                                    //     {
                                    //         $price = rtrim($price, "00");
                                    //     }

                                    //     if (strlen((string)$decimalvalues) == 5)
                                    //     {
                                    //         $price = rtrim($price, "000");
                                    //     }
                                    // }

                                    if ($price == "")
                                    {
                                        $error = "empty price field(s)";
                                    }

                                    if($error)
                                    { ?>
                                        <script type="text/JavaScript">
                                            // creates an error notification
                                                alert("Price not saved \n\n <?PHP echo $error; ?>");
                                        </script>
                                    <?php 
                                    } else
                                    {
                                        $sql = "update priceestimate set Price='$price' where Type = '$type'";
                                        mysqli_query($con, $sql);
                                    }
                                }

                            echo "<meta http-equiv='refresh' content='0'>";
                            }
                            
                        ?>
                        <input type = 'submit' name = 'priceupdate' value = 'Update'>
                    </div>
                </div>
            </form>
        </div>

    </body>
</html>

