<?PHP
session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");
	
	if(check_login($con) == "False") { 
?>

<div class="topnav">
	<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
	<a href="About.php">About</a>
	<a href="ContactUs.php">Contact Us</a>
	<a href="MOT.php">Book an MOT!</a>
	<a class="login" href="Login.php" style="float:right">Login</a>
</div>

<?PHP 
	} else { 
?>
<div class="topnav">
	<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
	<a href="About.php">About</a>
	<a href="ContactUs.php">Contact Us</a>
	<a href="MOT.php">Book an MOT!</a>
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
			<a href="#">Account</a>
			<a href="Bookings.php">Bookings</a>
			<a href="Logout.php"> Log Out </a>
		</div>
	</div>
</div>
	
<?PHP 
	} 
?>


<html>
	<head>
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		<style>

			body {
				margin: 0;
				font-family: Arial, Helvetica, sans-serif;
				color: #191923;
				background-image: linear-gradient(to bottom, #2d2c21, #24231a);
				overflow-x: hidden;
				/* height: 120%; */
			}

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
				0 16px 16px hsl(0deg 0% 0% / 0.075);
			}

			.topnav a {
				float: left;
				color: #EEEEEE;
				text-align: center;
				padding: 8px 50px;
				height: 30px;
				line-height: 25px;
				text-decoration: none;
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				transition: 0.7s;
				display: block;
			}

			.topnav a:hover {
				background-color: #2c290e;
				color: white;
				height: 35px;
				line-height: 30px;
				text-decoration: none;
				font-size: 23px;
				border-radius: 10px;
			}

			.topnav a.active {
				background-color: black;
				color: white;
			}

			.topnav a.login {
				padding: 5px 25px ;
				position: absolute;
				top: 50%;
				left: 95%;
				transform: translate(-50%,-50%);
				background-color: #eb5729;
				color: white;
				border-radius: 40px;
			}

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
				/* display: inline-block; */
				float: left;
			}

			.products{
				width: 400px;
				text-align: center;
				position: relative;
				/* display: inline-block; */
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

			.addcar{
				width: 95%;
				height: 150px;
				background-image: linear-gradient(to bottom right,  #F0A202, #ff7800);
				border-radius: 20px;
				position: absolute;
				top: 125px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			.title {
				position: absolute;
				top: 50%;
				left: 250px;
				transform: translate(-50%,-50%);
				font-size: 27.5px;
				font-family: century-gothic, sans-serif;
				color: black;
			}
			
			.addcartext {
				position: absolute;
				top: 55%;
				left: 525px;
				transform: translate(-50%,-50%);
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				color: black;
			}

			.details{
				margin-left: 2.5%;
				margin-top: 250px;
				height: 435px;
				width: 900px;
				padding: 75px;
				background-color: #2c290e;
				border-radius: 20px;
				position: relative;
				float: left;
				flex: 2;
			}

			.detailstitle{
				position: absolute;
				top: 100px;
				left: 220px;
				transform: translate(-50%,-50%);
				font-size: 40px;
				font-family: century-gothic, sans-serif;
				color: white;
			}

			.detailstext{
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
			}

			.firsttext{
				position: absolute;
				top: 200px;
				left: 250px;
				transform: translate(-50%,-50%);
			}

			.lasttext{
				position: absolute;
				top: 260px;
				left: 250px;
				transform: translate(-50%,-50%);
			}

			.phonetext{
				position: absolute;
				top: 320px;
				left: 224px;
				transform: translate(-50%,-50%);
			}

			.emailtext{
				position: absolute;
				top: 380px;
				left: 219px;
				transform: translate(-50%,-50%);
			}

			.passwordtext{
				position: absolute;
				top: 440px;
				left: 245px;
				transform: translate(-50%,-50%);
			}

			.first{
				position: absolute;
				top: 200px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			.last{
				position: absolute;
				top: 260px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			.phone{
				position: absolute;
				top: 320px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			.email{
				position: absolute;
				top: 380px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			.password{
				position: absolute;
				top: 440px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			Input[type = text]{
				height: 40px;
				width: 600px;
				background: #211f0e;
				color: white;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
			}

			#change{
				height: 28px;
				width: 150px;
				background: #D95D39;
				border-radius: 10px;
				font-size: 18px;
				font-family: century-gothic, sans-serif;
				transition: 0.75s;
			}

			#change:hover{
				background: #ff7800;
			}
			
			.change{
				position: absolute;
				top: 520px;
				left: 900px;
				transform: translate(-50%,-50%);
			}

			.error {
				position: absolute;
				top: 520px;
				left: 450px;
				transform: translate(-50%,-50%);
				font-size: 15px;
				font-family: century-gothic, sans-serif;
			}

			.vehicles{
				position: relative;
				margin-top: 250px;
				margin-right: 2.5%;
				float: right;
				height: 365px;
				overflow: auto;
				padding-top: 160px;
				padding-bottom: 60px;
				background-color: #2d2c21;
				width: 200px;
				border-radius: 25px;
				flex: 1;
				flex: 0 0 27.5%;
				overflow-x: hidden;
			}
			
			.vehicles p{
				position: absolute;
				top: 60px;
				left: 50%;
				transform: translate(-50%,-50%);
				font-size: 40px;
				font-family: century-gothic, sans-serif;
				color: white;
				white-space: nowrap;
			}

			table{
				table-layout: fixed;
				border-top: 20px solid #2d2c21;
				border-right: 20px solid #2d2c21;
				border-bottom: 0px solid #2d2c21;
				border-left: 20px solid #2d2c21;
				/* column-width: 300px; */
				text-align: center;
			}

			th:first-child {
				column-width: 300px;
				column-gap: 0px;
			}

			th:last-child {
				column-width: 10%;
				column-gap: 0px;
			}


			tr td:first-child {
				border-left: none;
				border-right: 10px solid #24231a;
				border-radius: 20px 0px 0px 20px;
				width: 85px;
				column-width:85px;
				background-color: #24231a;
				height: 90px;
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
				column-gap: 0px;
				text-align: center;
			}

			tr td:last-child {
				border-right: none;
				border-left: 10px solid #24231a;
				border-radius: 0px 20px 20px 0px;
				width: 77.5%;
				column-width: 77.5%;
				background-color: #24231a;
				height: 90px;
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
				column-gap: 0px;
			}

			.container {
				position: relative;
				top: 62%;
				left: 50%;
				transform: translate(-50%,-50%);
				background-color:#15150f;
				margin-bottom: 150px;
				border-radius: 40px;
				width: 90%;
				height: 1025px;
				box-shadow:
				0 1px 1px hsl(0deg 0% 0% / 0.075),
				0 2px 2px hsl(0deg 0% 0% / 0.075),
				0 4px 4px hsl(0deg 0% 0% / 0.075),
				0 8px 8px hsl(0deg 0% 0% / 0.075),
				0 16px 16px hsl(0deg 0% 0% / 0.075);
				display: flex;
				gap: 2.5%;
				flex-direction: row;
			}

			.delete{
				background: #b84825;
				width: 100%;
				height: 150px;
				position: absolute;
				margin-top: 950px;
				left: 50%;
				transform: translate(-50%,-50%);
				border-radius: 0px 0px 40px 40px;
			}

			.deletetext{
				font-size: 25px;
				font-family: "Courier New", Courier;
				color: #DEDCD1;
				position: absolute;
				top: 50%;
				left: 37.5%;
				transform: translate(-50%,-50%);
			}

			#del{
				height: 35px;
				width: 175px;
				background: #DEDCD1;
				border-radius: 20px;
				font-size: 20px;
				font-family: century-gothic, sans-serif;
				transition: 0.75s;
			}


			#del:hover{
				height: 36px;
				width: 200px;
				background: #b84825;
				color: #DEDCD1;
				border: 2px solid #DEDCD1;
			}
			
			.deletebutton{
				position: absolute;
				top: 50%;
				left: 70%;
				transform: translate(-50%,-50%);
			}

			.add{
				position: relative;
				top: -285px;
				left: 2240px;
				transform: translate(-50%,-50%);
			}

			.button {
				background-color: #24231a;
				padding: 10px;
				border-radius: 20px;
				cursor: pointer;
				transition: all 0.3s ease-out;
				position: relative;
				top: 30px;
				left: 0px;
				transform: translate(-50%,-50%);
				margin-left:20px;
			}

			#btn-add {
				padding: 20px 42% 10px 42%;
			}

			.button:hover {
				background: rgba(0, 0, 0, 0.35)
			}

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
				margin: 70px auto;
				padding: 20px;
				border-radius: 20px;
				width: 525px;
				position: absolute;
				top:50%;
				left:50%;
				transform: translate(-50%,-50%);
				transition: all 5s ease-in-out;
				background: linear-gradient(-45deg, #fcc42c,#e1ad01, #FF8800, coral, hotpink);
				background-size: 400% 400%;
				animation: gradient 10s ease infinite;
				height: 525px;
				transition: 1s;
			}

			.popup:hover {
				/* animation: hover 0.75s ease; */
				box-shadow: rgba(138, 104, 37, 0.4) 10px 10px, rgba(138, 104, 37, 0.3) 20px 20px, rgba(138, 104, 37, 0.2) 30px 30px, rgba(138, 104, 37, 0.1) 40px 40px, rgba(138, 104, 37, 0.05) 50px 50px;
			}

			/* @keyframes hover {
					0% {
						box-shadow: rgba(138, 104, 37, 0.4) 5px 5px, rgba(138, 104, 37, 0.3) 10px 10px, rgba(138, 104, 37, 0.2) 15px 15px, rgba(138, 104, 37, 0.1) 20px 20px, rgba(138, 104, 37, 0.05) 25px 25px;
					}
					
					20% {
						box-shadow: rgba(138, 104, 37, 0.4) 50px 50px, rgba(138, 104, 37, 0.3) 100px 100px, rgba(138, 104, 37, 0.2) 150px 150px, rgba(138, 104, 37, 0.1) 200px 200px, rgba(138, 104, 37, 0.05) 250px 250px;
					}
					
					40% {
						box-shadow: rgba(138, 104, 37, 0.4) 60px 60px, rgba(138, 104, 37, 0.3) 120px 120px, rgba(138, 104, 37, 0.2) 180px 180px, rgba(138, 104, 37, 0.1) 240px 240px, rgba(138, 104, 37, 0.05) 300px 300px;
					}
					

					60% {
						box-shadow: rgba(138, 104, 37, 0.4) 30px 30px, rgba(138, 104, 37, 0.3) 60px 60px, rgba(138, 104, 37, 0.2) 90px 90px, rgba(138, 104, 37, 0.1) 120px 120px, rgba(138, 104, 37, 0.05) 150px 150px;
					}

					80% {
						box-shadow: rgba(138, 104, 37, 0.4) 15px 15px, rgba(138, 104, 37, 0.3) 30px 30px, rgba(138, 104, 37, 0.2) 45px 45px, rgba(138, 104, 37, 0.1) 60px 60px, rgba(138, 104, 37, 0.05) 75px 75px;
					}
			
					100% {
						box-shadow: rgba(138, 104, 37, 0.4) 10px 10px, rgba(138, 104, 37, 0.3) 20px 20px, rgba(138, 104, 37, 0.2) 30px 30px, rgba(138, 104, 37, 0.1) 40px 40px, rgba(138, 104, 37, 0.05) 50px 50px;
					}
			} */

			.content {
				position: absolute;
				top: 340px;
				left: 50%;
				transform: translate(-50%,-50%);
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

			.popup h2 {
				margin-top: 40px;
				margin-left: 20px;
				font-size: 30px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
			}

			.popup input[type=text] {
				height: 40px;
				width: 500px;
				background: #DEDCD1;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 10px;
				border: 0px;
			}

			.popup select {
				height: 40px;
				width: 500px;
				background: #DEDCD1;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 10px;
				border: 0px;
			}

			.popup option {
				height: 40px;
				width: 500px;
				background: #DEDCD1;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				border: 0px;
			}

			.popup input[type=submit] {
				margin-top: 10px;
				height: 40px;
				width: 500px;
				background: wheat;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 30px;
				border: 0px;
				transition: 0.75s;
			}

			.popup input[type=submit]:hover {
				border-radius: 40px;
				background-color: white;
				font-size: 20px;
			}

			.popup .close {
				z-index: 3000;
				position: absolute;
				top: 20px;
				right: 30px;
				transition: all 200ms;
				font-size: 30px;
				font-weight: bold;
				text-decoration: none;
				color: #333;
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

			html {
				scroll-snap-type: y mandatory;
			}

		</style>
	</head>

	<body>

		<div class = "container">

			<div class = "addcar">
				<div class = "title">
					<h1>Account    |</h1>
				</div>

				<div class = "addcartext">
					<?PHP
						$_SESSION;
						$user_data = check_login($con);
						$user_id = $_SESSION["id"];  
						$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
						$result = $con->query($sql);
						while($row = $result->fetch_assoc()) {
							$first = $row['FirstName'];
						}     
						echo "<p>Welcome " . $first . "! </p>" ;
					?>
				</div>
			</div>

			<div class = "details">
				<div class = "detailstitle">
					<p>Your Details</p>
				</div>

				<div class = "detailstext">
					<div class = "firsttext">
						<p>First Name</p>
					</div>
				
					<div class = "lasttext">
						<p>Last Name</p>
					</div>
				
					<div class = "phonetext">
						<p>Phone</p>
					</div>

					<div class = "emailtext">
						<p>Email</p>
					</div>

					<div class = "passwordtext">
						<p>Password</p>
					</div>
				</div>

				<form method = post>
					<div class = "first">
						<?PHP
							$_SESSION;
							$user_data = check_login($con);
							$user_id = $_SESSION["id"];  

							$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
							$result = $con->query($sql);
							while($row = $result->fetch_assoc()) {
								echo "<input type='text' value = '$row[FirstName]' name = 'firstinput'>";
							}     
						?>
					</div>
				
					<div class = "last">
						<?PHP
							$_SESSION;
							$user_data = check_login($con);
							$user_id = $_SESSION["id"];  

							$sql = "SELECT LastName FROM customerdetails WHERE CustomerID = '$user_id'";
							$result = $con->query($sql);
							while($row = $result->fetch_assoc()) {
								echo "<input type='text' value = '$row[LastName]' name = 'lastinput'>";
							}     
						?>
					</div>

					<div class = "phone">
						<?PHP
							$_SESSION;
							$user_data = check_login($con);
							$user_id = $_SESSION["id"];  

							$sql = "SELECT Phone FROM customerdetails WHERE CustomerID = '$user_id'";
							$result = $con->query($sql);
							while($row = $result->fetch_assoc()) {
								echo "<input type='text' value = '$row[Phone]' name = 'phoneinput'>";
							}     
						?>
					</div>

					<div class = "email">
						<?PHP
							$_SESSION;
							$user_data = check_login($con);
							$user_id = $_SESSION["id"];  

							$sql = "SELECT user_name FROM logindetails WHERE id = '$user_id'";
							$result = $con->query($sql);
							while($row = $result->fetch_assoc()) {
								echo "<input type='text' value = '$row[user_name]' name = 'emailinput'>";
							}     
						?>
					</div>
				
					<div class = "password">
						<?PHP
							// $_SESSION;
							// $user_data = check_login($con);
							// $user_id = $_SESSION["id"];  

							// $sql = "SELECT password FROM logindetails WHERE id = '$user_id'";
							// $result = $con->query($sql);
							// while($row = $result->fetch_assoc()) {
							//   echo "<input type='text' value = '$row[password]' name = 'passwordinput'>";
							// }     
						?> 
						<input type='text' placeholder = "Chang Password?" name = 'passwordinput'>

					</div>
				
					<div class = "change">
						<input type = "submit" id = "change" name = "change" value = "Change" onClick="window.location.href=window.location.href">
							<?php
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"]; 

								if (isset($_POST) And (! empty(isset($_POST['firstinput'])))){
									$first = $_POST['firstinput'];
								}
								else{
									$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$first = $row['FirstName'];
									}     
								}

								if (isset($_POST) And (! empty(isset($_POST['lastinput'])))){
									$last = $_POST['lastinput'];
								}
								else{
									$sql = "SELECT LastName FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$last = $row['LastName'];
									}     
								}

								if (isset($_POST) And (! empty(isset($_POST['phoneinput'])))){
									$phone = $_POST['phoneinput'];
								}
								else{
									$sql = "SELECT Phone FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$phone = $row['Phone'];
									}     
								}

								if (isset($_POST) And (! empty(isset($_POST['emailinput'])))){
									$email = $_POST['emailinput'];
								}
								else{
									$sql = "SELECT user_name FROM logindetails WHERE id = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$email = $row['user_name'];;
									}     
								}

								if (isset($_POST) And (! empty(isset($_POST['passwordinput'])))){
									$password = $_POST['passwordinput'];
								}
								else{
									$sql = "SELECT password FROM logindetails WHERE id = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$password = $row['password'];;
									}  
								}

								$error = "";

								if(isset($_POST['change'])){
									$sql = "update customerdetails set Firstname = '$first', LastName = '$last', Phone = '$phone' where CustomerID = '$user_id' ";
									mysqli_query($con, $sql);
									$sql = "update logindetails set user_name = '$email', password = '$password' where id = '$user_id' ";
									mysqli_query($con, $sql);
									$_POST['first'] = "";
									$_POST['last'] = "";
									$_POST['email'] = "";
									$_POST['password'] = "";
									$_POST['phone'] = "";
									echo "<meta http-equiv='refresh' content='0'>";
									// $error = "changed successfully";
								}
							?>
						</input>

						<?PHP echo "<div class = 'error'>$error</div>"; ?>
					</div>
				</form>
			</div>

			<div class = "vehicles">
				<p>Your Vehicles</p>
				<?php
					$_SESSION;
					$user_data = check_login($con);
					$user_id = $_SESSION["id"]; 
					$sql = "select Make, Model, ModelYear, Registration from cars where user_id = '$user_id'";
					$result = mysqli_query($con, $sql); 
					$count = 0;
		
					while ( $db_field = mysqli_fetch_assoc($result) ) {
						$details[]= $db_field['ModelYear'] . " " . $db_field['Make'] . " " . $db_field['Model'];
						$reg[]= $db_field['Registration'];
						$count += 1;
					}

					$rep = 0;

					while ($rep < $count){
						echo "
						<table>
							<tr>
								<td> <img src = 'images\car.png' height = 70 align='right'> </td>
								<td> $details[$rep] <br> $reg[$rep] </td>
							</tr>
						</table>";
						$rep += 1;
					}
				?>
				<a class="button" id = "btn-add" href="#addpopup"> <img src = "images\add.png" height = 25px > </a>
			</div>

			<div class = "delete">
				<div class = "deletetext">
					<p>Delete Account? Sad to see you go</p>
				</div>

				<div class = "deletebutton">
					<form method = "post" action="Home.php">
						<input type = "submit" id = "del" name = "del" value = "Delete">
							<?php
								if (isset($_POST["del"])){
									$user_data = check_login($con);
									$user_id = $_SESSION["id"]; 
									$sql = "delete from customerdetails where user_id = '$user_id'";
									mysqli_query($con, $sql); 
									$sql = "delete from logindetails where id = '$user_id'";
									mysqli_query($con, $sql); 
									$sql = "delete from cars where user_id = '$user_id'";
									mysqli_query($con, $sql); 
									$sql = "delete from bookings where CustomerID = '$user_id'";
									mysqli_query($con, $sql); 

								}
							?>
						</input>
					</form>
				</div>
			</div>
		</div>
	
		<div id = "addpopup" class = "overlay">
			<div class="popup">
				<h2>Add a vehicle</h2>
				<a class="close" href="#">&times;</a>
				<div class="content">
					<form method = "post">
						<input type='text' placeholder = 'Registration' name = 'reg'>
						<input type='text' placeholder = 'Make' name = 'make'>
						<input type='text' placeholder = 'Model' name = 'model'>
						<input type='text' placeholder = 'Model Year' name = 'year'>
						<select name = "type">
							<option value = 'Cabriolet'>Cabriolet</option>
							<option value = 'Coupe'>Coupe</option>
							<option value = 'Crossover / SUV'>Crossover/SUV</option>
							<option value = 'Estate'>Estate</option>
							<option value = 'Hatchback'>Hatchback</option>
							<option value = 'Motor Caravan'>Motor Caravan</option>
							<option value = 'Motorcycle'>Motorcycle</option>
							<option value = 'MPV'>MPV</option>
							<option value = 'Saloon'>Saloon</option>
						</select>
						<input type='text' placeholder = 'Colour' name = 'colour'>
						<input type='submit' value = "add" name = 'addbtn'>
					</form>

					<?PHP 
						$_SESSION;
						$user_data = check_login($con);
						$user_id = $_SESSION["id"]; 

						if (isset($_POST) And isset($_POST['reg'])){
							$reg = $_POST['reg'];
						}
						else{
							$reg = "";
						}

						if (isset($_POST) And isset($_POST['reg'])){
							$reg = $_POST['reg'];
						}
						else{
							$reg = "";
						}

						if (isset($_POST) And isset($_POST['make'])){
							$make = $_POST['make'];
						}
						else{
							$make = "";
						}

						if (isset($_POST) And isset($_POST['model'])){
							$model = $_POST['model'];
						}
						else{
							$model = "";
						}

						if (isset($_POST) And isset($_POST['type'])){
							$type = $_POST['type'];
						}
						else{
							$type = "";
						}

						if (isset($_POST) And isset($_POST['colour'])){
							$colour = $_POST['colour'];
						}
						else{
							$colour = "";
						}
	
						if (isset($_POST) And isset($_POST['year'])){
							$year = $_POST['year'];
						}
						else{
							$year = "";
						}

						if (isset($_POST["addbtn"])){
							$sql = "insert into cars (Registration, Make, Model, ModelYear, Colour, Type, user_id)  values('$reg', '$make', '$model', '$year', '$colour', '$type','$user_id')";
							mysqli_query($con, $sql); 
							echo "<meta http-equiv='refresh' content='0'>";
						}
					?>

				</div>
			</div>
		</div>

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
