<?PHP
	session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");

	// nav bar if user is not signed in
	if(check_login($con) == "False") 
	{ 
?>

	<div class="topnav">
		<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
		<a class = "navlinks" href="About.php">About</a>
		<a class = "navlinks"  href="ContactUs.php">Contact Us</a>
		<a class = "navlinks" href="MOT.php">Book an MOT!</a>
		<a class="login" href="Login.php" style="float:right">Login</a>
	</div>

<?PHP 
  } else 
	// nav bar if the user is signed in
  { 
?>
	<div class="topnav">
		<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
		<a class = "navlinks" href="About.php">About</a>
		<a class = "navlinks" class="active" href="ContactUs.php">Contact Us</a>
		<a class = "navlinks" href="MOT.php">Book an MOT!</a>
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
			<!-- drop down menu in nav bar -->
			<div class="dropdown-content">
				<a href="Account.php">Account</a>
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

  		<!-- importing font library -->
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		<link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>

		<title> Contact Us </title>

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

			/* login button in nav bar */
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

			/* logo in footer */
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

			/* Contact us title */
			.title {
				position: relative;
				margin-top:100px;
				margin-left: 9%;
				font-size: 30px;
				font-family: century-gothic, sans-serif;
				color: #ffeecb;
			}

			/* car on top right of map */
			#carimg1 {
				height: 150px;
				position: absolute;
				top: 60px;
				left: 77.5%;
				transform: translate(-50%,-50%);
			}

			/* map */
			.map iframe{
				height: 90%;
				width: 90%;
				border-radius: 20px;
				margin-left: 5%;
				margin-bottom: 50px;
			}

			/* conatct info */
			.info {
				width: 100%;
				display: flex;
			}

			/* address info */
			.address {
				flex: 1;
				width: 31%;
				height: 400px;
				position: relative;
				border-radius: 20px;
				margin-top: 30px;
				margin-bottom: 80px;
				margin-left: 5%;
				margin-right: 1.5%;
				float: left;
				transition: 0.8s;
				background-color:#edc6b9;
			}

			.address:hover {
				margin-right: 0%;
				width:40%;
				margin-bottom: 60px;
			}

			/* opeinging times */
			#times {
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight:bold;
				color:#2c290e;
				position: absolute;
				top: 72.5%;
				left: 50%;
				transform: translate(-50%,-50%);
				width: 70%;
			}

			/* address title */
			.address h4 {
				position: absolute;
				margin-left: 75px;
				margin-top: 50px;
				font-size: 45px;
				font-family: century-gothic, sans-serif;
				color: #2c290e;
			}

			.address img {
				height: 100%;
			}

			.addresstext {
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				color:#2c290e;
				position: absolute;
				top: 47.5%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			.phone {
				flex: 2;
				width: 61%;
				height: 400px;
				position: relative;
				border-radius: 20px;
				margin-top: 30px;
				margin-bottom: 80px;
				margin-left: 1.5%;
				margin-right: 5%;
				float: right;
				transition: 1s;
				background-color: wheat;
			}

			.phone:hover {
				margin-left:0%;
				width: 62.5%;
			}

			.phone img {
				position: absolute;
				height: 265px;
				margin-left: 50px;
				margin-top: 145px;
				rotate: -0.5deg;
			}

			.phone h4 {
				position: absolute;
				margin-left: 75px;
				margin-top: 50px;
				font-size: 45px;
				font-family: century-gothic, sans-serif;
				color: black;
			}

			.details {
				height: 410px;
				margin-left: 57.5%;
				width: 100px;
				position: absolute;
				top: 332.5px;
				left: 0%;
				transform: translate(-50%,-50%);
			}

			.details img {
				height: 25px;
				position: relative;
				margin-top: 25px;
				filter: invert(29%) sepia(8%) saturate(606%) hue-rotate(16deg) brightness(95%) contrast(84%);
			}

			.detailstext {
				position: absolute;
				top: 240px;
				left: 0%;
				transform: translate(-50%,-50%);
				margin-left: 77.5%;
			}

			.detailstext p {
				font-weight: bold;
				line-height: 30px;
				font-size: 20px;
				font-family: 'Courier New', Courier, monospace;
				font-weight:bold;
				color: #515047;
			}

		</style>
  	</head>

  	<body>
	
		<body style="background-color:#24231a">

		<!-- contact us title -->
		<div class = "title">
			<h1>Contact Us</h1>
			<img id = "carimg1" src= "images/car1.png">
		</div>

		<!-- map -->
		<div class = "map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13246.852251679304!2d-2.984998!3d51.587606!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4871e6c3d645d091%3A0xf7ccb47a03553e0d!2sScotts%20MOT%20Centre!5e1!3m2!1sen!2suk!4v1707682339352!5m2!1sen!2suk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

		<!-- address -->
		<div class = "info">
			<div class = "address">
				<h4> We are in </h4>
				<div class = "addresstext">
					<p> 34 Corporation Road, <br> Newport, <br> Gwent, <br> NP19 0BH. </p>
				</div>
				<p id = "times"> Open between 9am & 6pm from Monday to Friday </p>
			</div>

			<!-- contact details -->
			<div class = "phone">
				<img src = "images\car2.png" height= 200px>
				<h4> Contact Details </h4>
				<div class = "details">
					<img src = "images\phone2.png" height = 40px>
					<img src = "images\mail2.png" height = 40px>
					<img src = "images\instagram2.png" height = 40px>
					<img src = "images\x2.png" height = 40px>
				</div>
				<div class = "detailstext">
					<p> 01633842922 </p>
					<p> sales@scottsmotcentre.co.uk  </p>
					<p> @scottsmots </p>
					<p> @scottsmots </p> 
				</div>
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

				<!-- outputs the account link if signed -->
				<?PHP if(!(check_login($con) == "False")) 
				{
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
