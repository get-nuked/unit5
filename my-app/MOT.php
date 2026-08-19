<?PHP
	session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");

	$user_data = check_login($con);
	
	// if user is not logged in, redirect them to the login page
	if(check_login($con) == "False")
	{
		header("Location: Login.php");
	}
?>

<html>
	<head>
		<!-- importing font family -->
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		
		<title> Appointment Creator </title>

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

			/* dropdown in nav bar */
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
				background-color:#343828;
				border-radius: 20px;
				box-shadow:
					0 1px 1px hsl(0deg 0% 0% / 0.075),
					0 2px 2px hsl(0deg 0% 0% / 0.075),
					0 4px 4px hsl(0deg 0% 0% / 0.075),
					0 8px 8px hsl(0deg 0% 0% / 0.075),
					0 16px 16px hsl(0deg 0% 0% / 0.075);
				box-shadow: rgba(44,44,38, 0.4) 10px 10px, rgba(44,44,38, 0.3) 20px 20px, rgba(44,44,38, 0.2) 30px 30px, rgba(44,44,38, 0.1) 40px 40px, rgba(44,44,38, 0.05) 50px 50px;
				transition: 0.5s;
			}

			.box1:hover{
				box-shadow: rgba(67,67,62, 0.4) 15px 15px, rgba(67,67,62, 0.3) 30px 30px, rgba(67,67,62, 0.2) 45px 45px, rgba(67,67,62, 0.1) 60px 60px, rgba(67,67,62, 0.05) 75px 75px;
			}

			/* dropdown menu to select vehicle */
			select {
				position: absolute;
				top: 50%;
				left: 475px;
				transform: translate(-50%,-50%);
				height: 30px;
				width: 275px;
				background: #d2c497;
				color: black;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
			}

			option {
				background: #d2c497;
				color: black;
				width: 2000px;
				border-radius: 5px;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
			}

			/* go button to select vehicles */
			.update {
				position: absolute;
				top: 50%;
				left: 690px;
				transform: translate(-50%,-50%);
				
			}

			#btn-1 {
				height: 28px;
				width: 100px;
				background: #F0A202;
				border-radius: 5px;
				font-size: 18px;
				font-family: century-gothic, sans-serif;
				transition: 1s;
				border: none;
			}

			#btn-1:hover {
				background: #F1C232;
				border-radius: 30px;
			}

			.selectvehicletext {
				position: absolute;
				top: 50%;
				left: 24%;
				transform: translate(-50%,-50%);
				line-height: 25px;
				text-decoration: none;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				color: black;
			}

			/* continue button */
			input {
				height: 45px;
				width: 250px;
				background: #cc8108;
				border-radius: 30px;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				transition: 1s;
				border: none;
			}

			input:hover {
				background-color: #F0A202;
			}

			/* Book an Appointment title */
			.title {
				position: absolute;
				margin-top: 0px;
				margin-left: 75px;
				font-size: 35px;
				font-family: century-gothic, sans-serif;
				color: white;
			}

			/* information about cars */
			.vehicleinfo{
				position: absolute;
				margin-left: 0%;
				margin-top: 409px;
				height: 350px;
				width: 80%;
				padding-left: 5%;
				padding-right: 5%;
				padding-top: 2%;
				background-color: #171910;
				border-radius: 0px 0px 20px 20px;
				transition: 1s;
				box-shadow:
						0 1px 1px hsl(0deg 0% 0% / 0.075),
						0 2px 2px hsl(0deg 0% 0% / 0.075),
						0 4px 4px hsl(0deg 0% 0% / 0.075),
						0 8px 8px hsl(0deg 0% 0% / 0.075),
						0 16px 16px hsl(0deg 0% 0% / 0.075)
			}


			table {
				font-size: 40px;
				font-family: "Courier New", monospace;
				color: white;
				font-weight: bold;
				width: 100%;
				height: 130px;
				padding: 1% 5% 5% 2%;
				text-align: center;
			}

			th {
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
				width: 200px; 
				height: 50px;

			}

			.continue {
				position: absolute;
				top: 806px;
				left: 82.7%;
				transform: translate(-50%,-50%);
				z-index: 500;
			}

			/* cross on the top right */
			.cross {
				position: absolute;
				top: 170px;
				left: 91.5%;
				transform: translate(-50%,-50%);
			}

			.welcome {
				position: absolute;
				top: 315px;
				left: 14%;
				transform: translate(-50%,-50%);
				line-height: 25px;
				text-decoration: none;
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				color: wheat;
				font-weight: bold;
			}

			.text {
				position: absolute;
				margin-top: 250px;
				margin-left: 50px;
				border-radius: 20px;
				background: wheat;
				width: 700px;
				height:75px;
				padding: 20px 50px 20px 50px;
				box-shadow:
					0 1px 1px hsl(0deg 0% 0% / 0.075),
					0 2px 2px hsl(0deg 0% 0% / 0.075),
					0 4px 4px hsl(0deg 0% 0% / 0.075),
					0 8px 8px hsl(0deg 0% 0% / 0.075),
					0 16px 16px hsl(0deg 0% 0% / 0.075);
			}

			/* vehicle image */
			.morris {
				position: absolute;
				top: 335px;
				left: 62.5%;
				transform: translate(-50%,-50%);
				transform: rotate(5deg);
				z-index: 400;
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

		<!-- main contain -->
		<div class = "box1">
			<div class = "title">
				<h2>Book an Appointment</h2>
			</div>

			<div class = "cross">
				<a href = "Home.php"><img src="images/whitecross.png" width = 200px></a>
			</div> 

			<div class = "morris">
				<img src = "images\car7.png" height = 200px>
			</div>

			<!-- continue button -->
			<div class = "continue">
				<form action="MOTdate.php">
					<input type="submit" value="Continue   ⇨"  />
				</form>
			</div> 
			
			<!-- Welcome text -->
			<div class = "welcome">
				<?PHP
					$_SESSION;
					$user_data = check_login($con);
					$user_id = $_SESSION["id"]; 

					$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
					$result = $con->query($sql);
					while($row = $result->fetch_assoc()) {
						echo "Hello $row[FirstName]!";
					}     
				?>
			</div>

			<div class = "text">
				<div class = "selectvehicletext">
					<p>I want a booking for </p>
				</div>
			
				<form method = "post">
					<div class="vehicledropdown">
						<select name ="vehicle_selected">
							<?PHP
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"];   
								$sql = "SELECT Registration FROM cars WHERE user_id = '$user_id'";
							
								// sets $_SESSION['reg'] to the vehicle the user selected
								if (isset($_POST) And isset($_POST['vehicle_selected'])){
									$reg = $_POST['vehicle_selected'];
									$_SESSION['reg'] = $reg;
									$_SESSION['errormessage'] = ""; 
									echo "<option selected>$reg</option>";
								}

								// creates a dropdown with the vehiles they own
								$result = $con->query($sql);

								while($row = $result->fetch_assoc()) {
									if ($reg !== $row['Registration'])
									{
										echo "<option value = '$row[Registration]'>$row[Registration]</option>";
									}
								}    
							?>
						</select>

						<div class = "update">
							<!-- <input type = "submit" value = "update"> -->
							<button id="btn-1">go!</button>
						</div>
					</div>
				</form>
			</div>

			<!-- outputs information about the selected vehicle -->
			<div class = "vehicleinfo">
				<?PHP
					if (isset($_SESSION) And isset($_SESSION['reg']))
					{
						$reg = $_SESSION['reg'];
						$_SESSION["reg"] = $reg;
					} else
					{
						$reg = 0;
						$_SESSION["reg"] = $reg;
					}

					$sql = "select Make, Model, ModelYear, Colour from cars where Registration = '$reg'";
					$result = mysqli_query($con, $sql); 

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

						if(strlen($db_field['Colour']) > 15)
						{
							$db_field['Colour'] = substr($db_field['Colour'], 0, 15) . "...";
						}

						echo "
							<table>
								<tr>
									<th>Make</td>
									<th>Model</td>
									<th>Model Year</td>
									<th>Colour</td>
								</tr>
								<tr>
									<td>$db_field[Make]</td>
									<td>$db_field[Model]</td>
									<td>$db_field[ModelYear]</td>
									<td>$db_field[Colour]</td>
								</tr>
							</table>";
					} 
				?>
			</div>
		</div>

	</body>
</html>
