<?PHP
	session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");

	$user_data = check_login($con);
	
	// redirects to the login page if not signed in 
	if(check_login($con) == "False")
	{
		header("Location: Login.php");
	}

?>


<html>
	<head>

		<title> Appointment Creator </title>

		<script type="text/JavaScript">
			function myFunction()
			// calls div id = bookedpopup (opens the final popup)
			{
				window.location.href="http://localhost:81/my-app/MOTdate.php?#bookedpopup";
			}

			function confirmpopup()
			{
				// opens confirm details popup if no error were found
				let errors = "<?php echo $_SESSION['error']?>" ;
				if (errors == false) 
				{
					window.location.href="http://localhost:81/my-app/MOTdate.php?#confirmpopup";
				}
			}

			function goback()
			{
				// redirects to the MOT.php page
				window.open("http://localhost:81/my-app/MOT.php?", "_self");
				return false;
			}
		</script>

		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		<link href="https://fonts.cdnfonts.com/css/uk-number-plate" rel="stylesheet">
	
		<style>

			body {
				margin: 0;
				font-family: Arial, Helvetica, sans-serif;
				color: #191923
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

			.topnav a.login {
				padding: 1px 25px ;
				position: absolute;
				top: 50%;
				left: 95%;
				transform: translate(-50%,-50%);
				background-color: #eb5729;
				color: white;
				border-radius: 40px;
			}

			.topnav a.login:hover {
				padding: 2px 30px ;
				background-color: #e03c1b;
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
				font-family: inherit; 
				margin: 0;
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

			/* main container */
			.box1 {
				height: 800px;
				margin: 5%;
				background-color: wheat;
				border-radius: 20px;
				padding-top: 1px;
				box-shadow:
					0 1px 1px hsl(0deg 0% 0% / 0.075),
					0 2px 2px hsl(0deg 0% 0% / 0.075),
					0 4px 4px hsl(0deg 0% 0% / 0.075),
					0 8px 8px hsl(0deg 0% 0% / 0.075),
					0 16px 16px hsl(0deg 0% 0% / 0.075);
				transition: 0.5s;
				box-shadow: rgba(44,44,38, 0.4) 10px 10px, rgba(44,44,38, 0.3) 20px 20px, rgba(44,44,38, 0.2) 30px 30px, rgba(44,44,38, 0.1) 40px 40px, rgba(44,44,38, 0.05) 50px 50px;
			}

			.box1:hover{
				box-shadow: rgba(67,67,62, 0.4) 15px 15px, rgba(67,67,62, 0.3) 30px 30px, rgba(67,67,62, 0.2) 45px 45px, rgba(67,67,62, 0.1) 60px 60px, rgba(67,67,62, 0.05) 75px 75px;
			}

			/* date picker */
			.calendar {
				position: absolute;
				top: 350px;
				left: 675px;
				transform: translate(-50%,-50%);
			}

			/* date and time picker */
			input[type = time], input[type = date]{
				height: 30px;
				width: 200px;
				background: #29281f;
				color: white;
				border-radius: 10px;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				border: none;
			}

			/* continue button */
			input[type = submit] {
				height: 45px;
				width: 250px;
				background: #F0A202;
				border-radius: 30px;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				transition: 0.4s;
				border: none;
			}

			input[type = submit]:hover {
				background-color: #f0b71a;
			}

			#confirmbutton {
				height: 45px;
				width: 95%;
				background: #F0A202;
				border-radius: 10px;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				transition: 0.4s;
				border: none;
			}

			#confirmbutton:hover {
				background: #f4cdb3;
				border-radius: 30px;
			}

			/* additional info text box */
			textarea {
				height: 90px;
				width: 400px;
				background: #29281f;
				color: white;
				border-radius: 10px;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				border: none;
				resize: none;
			}
			
			/* confirm popup info table */
			.inputs table {
				width: 50%;
				height:90%;
				color: #DEDCD1;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				font-weight: bold;
				float: left
				
			}

			

			/* errors found */
			.errors {
				position: absolute;
				top: 65%;
				left: 37.5%;
				transform: translate(-50%,-50%);
			}

			.errors p {
				color: #eb5729;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
			}

			#datetime {
				height: 10%;
			}

			#optionalinfo {
				height: 60%;
			}

			/* selected vehicle box */
			.chosenvehicle {
				float: right;
				background-color: #232619;
				border-radius: 0px 20px 20px 0px;
				height: 93%;
				width: 35%;
				text-align: center;
				padding-top: 2%;
			}

			.chosenvehicle img {
				margin-top: 5%;
				width: 35%;
			}

			/* selected vehicle title */
			.chosenvehicle h2 {
				font-size: 30px;
				font-family: century-gothic, sans-serif;
				color: wheat
			}

			/* regisyration plate */
			#reg {
				font-size: 40px;
				font-family: 'UKNumberPlate', sans-serif;
				color: black;
				background-color: #F0A202;
				height: 40px;
				width: 38%;
				margin-left: 31%;
				border-radius: 5px;
				border: 3px solid black; 
			}

			/* vehicle info */
			#reginfo {
				margin-top: -4%;
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
			}

			.inputs {
				width: 90%;
				height: 60%;
				margin-left: 2.5%;
				background-color: #171910;
				border-radius: 20px;
				padding-left:5%;
			}

			/* Book an Appointment title */
			.title {
				margin-left: 75px;
				font-size: 35px;
				font-family: century-gothic, sans-serif;
				color: #3d1c16;
			}

			/* cross */
			.cross {
				position: absolute;
				top: 170px;
				left: 91.5%;
				transform: translate(-50%,-50%);
			}

			/* continue */
			.submit {
				position: absolute;
				top: 797.5px;
				left: 82.75%;
				transform: translate(-50%,-50%);
			}

			/* back button */
			.back {
				position: absolute;
				top: 797.5px;
				left: 17.25%;
				transform: translate(-50%,-50%);
			}

			h1 {
				text-align: center;
				font-family: Tahoma, Arial, sans-serif;
				color: #06D85F;
				margin: 80px 0;
			}

			.box {
				width: 40%;
				margin: 0 auto;
				background: rgba(255,255,255,0.2);
				padding: 35px;
				border: 2px solid #fff;
				border-radius: 20px/50px;
				background-clip: padding-box;
				text-align: center;
			}

			.button {
				height: 45px;
				padding: 8px;
				padding-left: 50px;
				padding-right: 50px;
				width: 250px;
				background: #F0A202;
				border-radius: 30px;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				transition: 0.4s;
				border: none;
				text-decoration: none;
				color: black;
			}

			.button:hover {
				background-color: #f0b71a;
			}

			/* popup dark overlay */
			.overlay {
				position: fixed;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				background: rgba(0, 0, 0, 0.7);
				transition: opacity 500ms;
				visibility: hidden;
				opacity: 0;
			}

			.overlay:target {
				visibility: visible;
				opacity: 1;
			}

			/* confirm popup */
			.popup {
				margin: 70px auto;
				padding: 20px;
				background: #fff;
				border-radius: 20px;
				width: 25%;
				height: 50%;
				position: relative;
				transition: all 5s ease-in-out;
				font-family: century-gothic, sans-serif;
				font-size: 22px;
				padding: 2.5%;
				background-color: #343828;
				margin-top: 10%;
			}

			.popup table {
				margin-top: 3%;
				width: 95%;
				font-family: century-gothic, sans-serif;
				font-size: 20px;
				color: antiquewhite;
				table-layout: fixed;
			}

			#title {
				width: 45%;
			}

			#details {
				width: 55%;
			}

			.popup p{
				width: 95%;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				font-size: 15px;
				color: antiquewhite;
				margin-top: 9%;
			}

			/* confirm button in popup */
			.popup input {
				width: 50%;
				margin-left: 2.5%;
				margin-top: 15%;
			}

			.popup h2 {
				margin-top: 0;
				color: #333;
				font-family: century-gothic, sans-serif;
				color: wheat;
			}

			/* confirm popup cross */
			.popup .close {
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
				color: #f4cdb3;
			}

			.popup .content {
				min-height: 30%;
				overflow: auto;
			}

			@media screen and (max-width: 700px){
				.box{
					width: 70%;
				}
				.popup{
					width: 70%;
				}
			}

			/* booked popup overlay */
			.overlaybooked {
				position: fixed;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				background: linear-gradient(-45deg, rgba(252, 196, 44, 0.35), rgba(225, 173, 1, 0.7), rgba(255, 136, 0, 0.35), rgba(255,127,80, 0.35), rgba(255, 105, 180, 0.35), rgba(235, 98, 160, 0.35));
				background-size: 400% 400%;
				animation: gradient 10s ease infinite;
				height: 100vh;
				transition: opacity 500ms;
				visibility: hidden;
				opacity: 0;
			}

			@keyframes gradient {
				0% {
					background-position: 0% 50%;
				}
			
				50% {
					background-position: 100% 50%;
				}
			
				100% {
					background-position: 0% 50%;
				}
			}

			.overlaybooked:target {
				visibility: visible;
				opacity: 1;
			}

			.popupbooked {
				margin: 70px auto;
				border-radius: 20px;
				width: 30%;
				position: relative;
				transition: all 5s ease-in-out;
				font-family: century-gothic, sans-serif;
				font-size: 22px;
				padding: 2.5%;
				background-color: antiquewhite;
				margin-top: 13%;
			}

			.popupbooked h2 {
				margin-top: 0;
				color: #333;
				font-family: century-gothic, sans-serif;
				color: #3d1c16;
			}

			/* booked popup cross */
			.popupbooked .closebooked {
				position: absolute;
				top: 0px;
				right: 40px;
				transition: all 200ms;
				font-size: 100px;
				text-decoration: none;
				color: #3d1c16;
				transition: 0.3s;
			}

			.popupbooked .closebooked:hover {
				color: #191708;
			}

			.popupbooked .contentbooked {
				max-height: 30%;
				overflow: auto;
			}

			@media screen and (max-width: 700px){
				.box{
					width: 70%;
				}
				.popupbooked{
					width: 70%;
				}
			}

			.bookings{
				margin-top: 7.5%;
				border-radius: 10px;
				height: 50px;
				background-color: #e88572;
				text-align: center;
				line-height: 50px;
				color: antiquewhite;
				transition: 0.4s;
			}

			.home{
				margin-top: 10px;
				border-radius: 10px;
				text-decoration: none;
				height: 40px;
				background-color: #f4cdb3;
				text-align: center;
				line-height: 40px;
				color:#3d1c16;
				transition: 0.4s;
			}

			.bookings:hover {
				border-radius: 25px;
				background-color: #f0958b;
				
			}

			.home:hover {
				border-radius: 25px;
				background-color: #f0ddc9;
			}

			a {
				text-decoration: none;
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
					while($row = $result->fetch_assoc()) 
					{
						echo "<button class='dropbtn'>Hi $row[FirstName]</button>";
					}      

					date_default_timezone_set("Europe/London");

					if (!(isset($_SESSION["bookedtime"])))
					{
						$_SESSION["bookedtime"] = date("H:i");
					}

					if (!(isset($_SESSION["bookeddate"])))
					{
						$_SESSION["bookeddate"] = date("Y-m-d");
					}

					if (!(isset($_SESSION["bookedadditional"])))
					{
						$_SESSION["bookedadditional"] = "-";
					}
				?>

				<!-- dropdown in nav bar -->
				<div class="dropdown-content">
					<a href="Account.php">Account</a>
					<a href="Bookings.php">Bookings</a>
					<a href="Logout.php"> Log Out </a>
				</div>
			</div>
    	</div>

		<!-- main conatiner -->
		<div class = "box1">
			<div class = "title">
				<h2>Book an Appointment</h2>
			</div>

			<div class = "cross">
				<a href = "Home.php"><img src="images/cross.png" width = 62px></a>
			</div> 

			<form method = "post">
				<div class = "inputs">
					<table>
						<tr id = "datetime">
							<td> </td>
							<td> </td>
						</tr>

						<tr id = "datetime">
							<td> </td>
							<td> </td>
						</tr>

						<!-- date time and additional info -->
						<tr id = "datetime">
							<td><p> Date </p></td>
							<td><input type="date" id="date" name="date" value="<?php echo $_SESSION['bookeddate']; ?>"></td>
						</tr>

						<tr id = "datetime">
							<td><p> Time </p></td>
							<td><input type="time" id="time" name="time" value="<?php echo $_SESSION['bookedtime'];?>"/></td>
						</tr>

						<tr id = "optionalinfo">
							<td><p> Additional Info [optional]</p></td>
							<td><textarea name=additional rows="5"></textarea></td>
						</tr>
					</table>

					<!-- output errors -->
					<div class = "errors">
						<p> <?php echo $_SESSION['errormessage']; ?> </p>
					</div>

					<!-- continue and back buttons -->
					<div class = "submit">
						<input type="submit" id = "btn-continue" name = "continue" value = "View Details" onClick = "confirmpopup()">
					</div>

					<div class = "back">	
						<input type = "submit" id = "btn-back" name = "back" value = "⇦   Go Back" onClick="return goback()">
					</div>

					<!-- chosen vehicle box -->
					<div class = "chosenvehicle">
						<h2>Selected Vehicle</h2>
						<img src = "images/morris.png">
						<?PHP
							$reg = $_SESSION["reg"];

							$sql = "select Make, Model,ModelYear, Colour from cars where Registration = '$reg'";
							$result = mysqli_query($con, $sql); 

							// assigns array information about the vehicle
							while ( $db_field = mysqli_fetch_assoc($result) ) 
							{
								if(strlen($db_field['Make']) > 15)
								{
									$db_field['Make'] = substr($db_field['Make'], 0, 15) . "...";
								}

								if(strlen($db_field['Model']) > 15)
								{
									$db_field['Model'] = substr($db_field['Model'], 0, 15) . "...";
								}


								$vehicleinfo = $db_field['ModelYear'] . " " . $db_field['Make'] . " " . $db_field['Model'];
							}

							// outputs info
							echo "<p id = 'reg'> $reg </p>";
							echo "<p id = 'reginfo'> $vehicleinfo </p>";

							date_default_timezone_set("Europe/London");
							$user_id = $_SESSION["id"];
							$reg = $_SESSION["reg"];
							$time = "";
							$date = "";
							$additional = " ";
							$opacity = 1;

							if (isset($_POST['continue']))
							{
								$error = false;
								$errormessage = "";
							
								echo "<meta http-equiv='refresh' content='0'>";

								// sets the date and time to the current date at noon if left empty
								if (isset($_POST) And isset($_POST['time']))
								{
									$time = $_POST['time'];
								}
								else
								{
									$time = "12:00:00";
								}

								if (isset($_POST) And isset($_POST['date']))
								{
									$date = $_POST['date'];
								}
								else
								{
									$date = date("Y-m-d");
								}

								// if additional info is empty, variable is given the value "-"
								if (isset($_POST) And isset($_POST['additional']))
								{
									if (!empty($_POST['additional'])){
										$additional = $_POST['additional'];
									}else
									{
											$additional = "-";
									}
								}else 
								{
									$additional = "-";
								}

								// if the sel;ected date and time is in the past, an error occurs
								if ($date <  date("Y-m-d"))
								{
									$error = true;
									$errormessage = "Invalid Date";
								} else if (($date ==  date("Y-m-d")) && ($time < date("H:i:s")))
								{
									$error = true;
									$errormessage = "Invalid Time";
								}

								$opentime = "09:00";
								$closetime = "18:00";
								if ($time > $closetime or $time < $opentime)
								{
									$error = true;
									$errormessage = "We are closed, we open at " . $opentime . " and close at " . $closetime;
								}

								if (strlen($additional) > 1000)
								{
									$error = true;
									$errormessage = "Additional infomation must be less than 1000 characters.";
								}
								
								// checks if the selected date is a weekend
								$dt1 = strtotime($date);
								$dt2 = date("l", $dt1);
								$dt3 = strtolower($dt2);
								if(($dt3 == "saturday" )|| ($dt3 == "sunday"))
								{
									$error = true;
									$errormessage = "We are closed on the weekend";;
								} 

								$_SESSION["bookedtime"] = $time;
								$_SESSION["bookeddate"] = $date;
								$_SESSION["bookedadditional"] = $additional;
								$_SESSION["errormessage"] = $errormessage;
								$_SESSION["error"] = $error;

								echo "<meta http-equiv='refresh' content='0'>";
							}	

							// retrives price based on the selected vehicle's body type
							$sql = "select Make, Model, ModelYear from cars where Registration = '$reg'";
							$result = mysqli_query($con, $sql); 
							while ( $db_field = mysqli_fetch_assoc($result))
							{
								$reginfo = $db_field["ModelYear"] . " " . $db_field["Make"] . " " . $db_field["Model"];
							}

							$sql = "select Type from cars where Registration = '$reg'";
							$result = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_assoc($result)) 
							{
								$body = $row['Type'];
							}

							$price = "";
							$sql = "select Price from priceestimate where Type = '$body'";
							$result = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_assoc($result)) 
							{
								$price = $row['Price'];
							}

							$_SESSION["bookedprice"] = $price;
							$_SESSION["bookedcar"] = $reginfo;
						?>

						<h4><?PHP $reg ?></h4>
						<p><?PHP $vehicleinfo ?></p>
					</div>
				</div>

				
				<!-- confirm info popup -->
				<div id= "confirmpopup" class="overlay">
					<div class="popup">
						<h2 id = 'confirmtitle'>Your Appointment Details</h2>
						<a class="close" href="#">&times;</a>
						<div class="content">
							<!-- outputs selected vehicle details and appointment details -->
							<?PHP
								$time = $_SESSION["bookedtime"];
								$date = $_SESSION["bookeddate"];
								$additional = $_SESSION["bookedadditional"];
								$price = $_SESSION["bookedprice"];
								$reginfo = $_SESSION["bookedcar"];
								$error = $_SESSION["error"];
								$errormessage = $_SESSION["errormessage"];
								date_default_timezone_set("Europe/London");

								if(strlen($additional) > 50)
								{
									$additionaldisplay = substr($additional, 0, 25) . "...";
								} else
								{
									$additionaldisplay = $additional;
								}

								echo "
								<div id = 'popupinfo'>
									<table>
										<tr>
											<td id = 'title'> Vehicle </td>
											<td id = 'details'> $reginfo </td>
										</tr>
										<tr>
											<td id = 'title'> Vehicle Registration </td>
											<td id = 'details'> $reg </td>
										</tr>

										<tr>
											<td id = 'title'> Date </td>
											<td id = 'details'> $date </td>
										</tr>

										<tr>
											<td id = 'title'> Time </td>
											<td id = 'details'> $time </td>
										</tr>

										<tr>
											<td id = 'title'> Additional notes </td>
											<td id = 'details'> $additionaldisplay </td>
										</tr>

										<tr>
											<td id = 'title'> Estimated Price * </td>
											<td id = 'details'> £ $price </td>
										</tr>
									</table>

									<p> * You do not have to pay now, the price is an estimate based on your vehicle information. The final price depends on many other factors, which will be said after the MOT examination.
								</div>";

								if(isset($_POST['save']))
								{
									$sql = "insert into bookings(CustomerID, Registration, BookedDate, BookedTime, Info, CompletedOn, Complete) values('$user_id','$reg','$date', '$time', '$additional', '0000-00-00 00:00:00', 0)";
									mysqli_query($con, $sql);
									$opacity = 0;
									echo "<meta http-equiv='refresh' content='0'>";
								}
							?>

							<input type = "submit" id = 'confirmbutton' name = "save" value = "Confirm and Book" onclick="myFunction()">
						</div>
					</div>
				</div>


				<!-- booked pop up -->
				<div id= "bookedpopup" class="overlaybooked">
					<div class="popupbooked">
						<h2>Woo Hoo 🎊</h2>
						<a class="closebooked" href="#">&times;</a>
						<div class="contentbooked">
							<!-- creates a popup with the appointmnetr date -->

							<p> YAY! Your next MOT is booked with us. <?PHP echo $date; ?> is a special day!  </P>
							
							<!-- Bookings page button -->
							<a href="Bookings.php" id="bookings">
								<div class = "bookings">
									View your appointments
								</div>
							</a>
						
							<!-- Homepage button -->
							<a href="Home.php"  id="home">
								<div class = "home">
									Back to the home page :)
								</div>
							</a>
						
						</div>
					</div>
				</div>
			</form>
		</div>
		
	</body>
</html>
