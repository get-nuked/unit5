<?PHP
	session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");
	
	#nav bar if the user is NOT logged in
	if(check_login($con) == "False") 
	{ 
?>

	<div class="topnav">
		<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
		<a class = "navlinks" href="About.php">About</a>
		<a class = "navlinks" href="ContactUs.php">Contact Us</a>
		<a class = "navlinks" href="MOT.php">Book an MOT!</a>
		<a class="login" href="Login.php" style="float:right">Login</a>
	</div>

<?PHP 
  	} else 
	{ #nav bar if the user IS logged in
?>
	<div class="topnav">
		<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
		<a class = "navlinks" href="About.php">About</a>
		<a class = "navlinks" href="ContactUs.php">Contact Us</a>
		<a class = "navlinks" href="MOT.php">Book an MOT!</a>
		<div class="dropdown" style="float:right">
		<?PHP
			$_SESSION;
			$user_data = check_login($con);
			$user_id = $_SESSION["id"];  

			#retrieving the first name of the user from the database
			$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
			$result = $con->query($sql);
			while($row = $result->fetch_assoc()) { #creating a drop down in the nav bar with 'Hi [firstname]' as the text
				echo "<button class='dropbtn'>Hi $row[FirstName]</button>";
			}      
		?>
			<!-- links in the dropdown menu-->
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
		<title>About Us</title>

		<!-- importing the font library -->
		<link rel="icon" href="images/scottfavicon.ico" stype="image/x-icon" sizes="any">
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">

		<style>

			body {
				margin: 0;
			}

			/* custom scrollbar */
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

			/* nav bar links */
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

			/* login button in the nav bar */
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

			/* dropdown in the nav bar */
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

			/* vehicle behind "About Us" title */
			.morris img{
				position:absolute;
				top: 200px;
				left:50%;
				transform: translate(-50%,-50%);
				opacity: 60%;
			}

			/* "About Us" title */
			.morris h2 {
				position: absolute;
				top: 160px;
				left: 50%;
				transform: translate(-50%,-50%);
				font-size: 75px;
				font-family: century-gothic, sans-serif;
				color: white;
			}

			/* Our History box */
			.history {
				width: 90%;
				height: 39%;
				background-color: #383b27;
				position: relative;
				border-radius: 20px 20px 0px 0px;
				margin-top: 321.5px;
				margin-left: 5%;
				margin-right: 5%;
				transition: 0.175s;
				box-shadow:
				0 1px 1px hsl(0deg 0% 0% / 0.075),
				0 2px 2px hsl(0deg 0% 0% / 0.075),
				0 4px 4px hsl(0deg 0% 0% / 0.075),
				0 8px 8px hsl(0deg 0% 0% / 0.075),
				0 16px 16px hsl(0deg 0% 0% / 0.075);
			}

			.history:hover{
				background-color: #353b27;
				position: relative;
				margin-top: 322px;
				margin-left: 5%;
				margin-right: 5%;
				padding-top: 5px;
				padding-bottom: 5px;
			}

			/* Our History title */
			.history h4 {
				position: absolute;
				font-size: 50px;
				font-family: century-gothic, sans-serif;
				color: #d2b48c; 
				margin-left: 75px;
			}

			/* Our History paragraph */
			.history p {
				position: absolute;
				font-size: 20px;
				font-weight:bold;
				font-family: "Courier New", courier;
				color: wheat; 
				margin-top: 150px;
				margin-left: 50px;
				margin-bottom: 75px;
				margin-right: 50px;
			}

			/* Our History large first letter */
			.history p::first-letter{
				-webkit-initial-letter : 3;
				initial-letter: 3;
				/* font-size: 90px; */
				line-height:0px;
				font-weight: bold;
			}

			/* Our Mission box */
			.mission {
				width: 45.5%;
				height: 102%;
				background-image: linear-gradient(to bottom right, #fa7b62, #fb8c4c);  
				position: relative;
				border-radius: 40px;
				margin-top: 0px;
				margin-bottom: 50px;
				margin-left: 3%;
				margin-right: 1.5%;
				float: left;
				transition: 1s;
			}

			/* highlighted words */
			.mission span {
				font-family: century-gothic, sans-serif;
				color: white;
				font-weight: bold;
				font-size:17.5px;
			}

			/* Our Mission title */
			.mission h4 {
				position: absolute;
				font-size: 50px;
				font-family: century-gothic, sans-serif;
				color: white; 
				margin-top: 80px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			/* Our Mission paragraphs */
			#p1 {
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: wheat; 
				margin-top: 150px;
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
			}

			#p2 {
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: wheat; 
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
			}

			#p3 {
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: wheat; 
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
			}

			#p4 {
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: wheat; 
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
			}

			/* Our Service box */
			.service {
				width: 45.5%;
				height: 102%;
				background-color: #f4cdb3;
				position: relative;
				border-radius: 40px;
				margin-top: 0px;
				margin-left: 1.5%;
				margin-right: 3%;
				display: inline-block;
				transition: 1s;
			}

			/* Our Service title */
			.service h4 {
				position: absolute;
				font-size: 50px;
				font-family: century-gothic, sans-serif;
				color: #2c290e; 
				margin-top: 80px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			/* Our Service paragraphs */
			#p5{
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: #3d1c16; 
				margin-top: 150px;
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
				transition: 1s;
			}

			#p6{
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: #3d1c16; 
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
				transition: 1s;
			}

			#p7{
				position: relative;
				font-size: 20px;
				font-family: "Courier New", courier;
				font-weight: bold;
				color: #3d1c16; 
				margin-left: 75px;
				margin-bottom: 20px;
				margin-right: 75px;
				text-indent: 50px;
				transition: 1s;
			}

			.mission .service {
				display: inline-block;
			}

			/* Our Service car */
			.service img {
				height: 120px;
			}

			.serviceimg {
				margin-top: 5%;
				position: absolute;
				left: 50%;
				transform: translate(-50%,-50%);
				transition: 1s;
			}

			/* Inline block (for mission and service) container */
			.container2{
				margin-top: 0px;
				position: relative;
				margin-left: 5%;
				background-color: #2b2b19;
				height: auto;
				width: 90%;
				padding-top: 2.5%;
				padding-bottom: 3%;
				border-radius: 0px 0px 20px 20px;
				margin-bottom: 5%;
				box-shadow:
				0 1px 1px hsl(0deg 0% 0% / 0.075),
				0 2px 2px hsl(0deg 0% 0% / 0.075),
				0 4px 4px hsl(0deg 0% 0% / 0.075),
				0 8px 8px hsl(0deg 0% 0% / 0.075),
				0 16px 16px hsl(0deg 0% 0% / 0.075);
			}

			/* webpage footer */
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

			/* footer links */
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

			/* footer 'Comapny' links */
			.company{
				width: 400px;
				text-align: center;
				position: relative;
				float: left;
			}

			/* 'Products' links in the footer */
			.products{
				width: 400px;
				text-align: center;
				position: relative;
				float: left;
				margin-left: 300px;
			}

			/* 'Company' links in the footer */
			#company {
				position: absolute;
				top: 0px;
				left:50%;
				transform: translate(-50%,-50%);
			}

			/* all the links in the footer */
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

			/* logo in the footer */
			footer img {
				float: right;
				margin-right: 3%;
			}

			/* copyright text in the footer */
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

			/* car in the background of the page */
			.bgcar {
				z-index: -1;
				position: fixed;
				top: 50%;
				left: 40%;
				transform: translate(-50%,-50%)
			}

			.bgcar img {
				width: 120%;
				opacity: 0.1;
			}

		</style>
	</head>

	<body>
		
		<body style="background-color:#24231a">
		
		<!-- About us title -->
		<div class = "morris">
			<img src = "images\morris.png" height = 250px>
			<h2>About Us</h2>
		</div>

		<!-- History -->
		<section>
			<div class = "history">
				<h4> Our History </h4>
				<P>Welcome to SCOTT'S MOTs, Newport's premier MOT centre, founded by automotive aficionado Scott Thomas. Established in 1966, Scott's journey into the world of MOT testing began with a simple yet powerful vision – to provide Newport's residents with a trustworthy and reliable place for vehicle inspections. Scott, a seasoned mechanic with a passion for ensuring road safety, opened the doors of SCOTT'S MOTs with the goal of not just meeting but exceeding the expectations of the local community. Over the years, Scott's commitment to excellence has transformed his humble garage into a state-of-the-art MOT centre, equipped with cutting-edge technology and staffed by a team of skilled professionals. Today, SCOTT'S MOTs stands as a testament to Scott Thomas's dedication, a place where integrity meets innovation, ensuring that every vehicle leaving our premises is roadworthy and meets the highest standards of safety. Join us in celebrating our journey as we continue to be Newport's trusted destination for MOT excellence.
				</P>
			</div>
		<section>

		<!-- Mission & Service -->
		<div class = "container2">
			<section>
				<div class = "mission"> <!-- Mission box -->
					<h4> Our Mission </h4>

					<!-- Mission Paragraphs -->
					<P id = "p1">
						At SCOTT'S MOTs, located in the <span> vibrant city </span> of Newport, Wales, our <span> mission </span> is firmly anchored in the twin pillars of <span> safety </span> and <span> customer satisfaction </span>, driven by the <span>visionary</span> founder and owner, <span>Scott Thomas</span>. Established with a <span>commitment to excellence</span>, our MOT centre is <span>dedicated</span> to providing <span>meticulous</span> and <span>transparent</span> MOT testing services that extend <span>beyond mere compliance with legal requirements</span>. Scott's <span>vision</span> has shaped SCOTT'S MOTs into a <span>trusted institution</span> where <span>every vehicle</span> undergoes <span>comprehensive inspections</span>, ensuring <span>not only</span> regulatory adherence but also <span>instilling confidence</span> in its roadworthiness.
					</P>
					
					<P id = "p2">
						Our mission extends <span>beyond the confines of routine testing</span> – we <span>aspire</span> to set a <span>new standard</span> for automotive service in Newport. Under Scott's <span>guidance</span>, our <span>experienced team</span>, with a <span>wealth of expertise</span>, works <span>diligently</span> to guarantee that vehicles leaving SCOTT'S MOTs are <span>not only safe</span> but also reflect our <span>unwavering dedication</span> to <span>precision</span>. We believe in fostering a culture of <span>trust and reliability</span>, where customers can depend on us for <span>thorough assessments</span> and <span>transparent communication.</span>
					</P>

					<P id = "p3">
						As part of our mission, we continuously invest in <span>cutting-edge technology</span> and training to <span>stay ahead</span> in the ever-evolving automotive landscape. SCOTT'S MOTs aims to be <span>more than</span> just a place for inspections; we <span>strive</span> to be a partner in our <span>customers' journey</span>, <span>ensuring</span> their vehicles are <span>not just compliant</span> but <span>optimized</span> for <span>safe and efficient performance</span> on Newport's roads.
					</P>

					<P id = "p4">
						Join us on this <span>journey</span> as we uphold <span>our mission</span> to <span>prioritize safety, excellence, and customer satisfaction, setting the standard</span> for MOT services in Newport <span>and beyond</span>. SCOTT'S MOTs – where <span>your safety</span> and <span>satisfaction</span> drive our <span>commitment</span>.
					</P>
				</div>
			<section>

			<section> <!-- Services box -->
				<div class = "service">
					<h4> Our Service </h4>

					<!-- Services paragraphs -->
					<P id = "p5">
						Step into the world of automotive excellence at SCOTT'S MOTs, Newport's premier MOT centre, founded by the passionate Scott Thomas. Our comprehensive range of services is carefully curated under Scott's vision to prioritize the safety, performance, and satisfaction of your vehicle. At the heart of our offerings is our meticulous MOT testing service, where our skilled technicians go above and beyond legal requirements to ensure your vehicle not only meets standards but exceeds them, providing you with the utmost confidence in its roadworthiness.
					</P>

					<P id = "p6">
						In addition to our exceptional MOT tests, SCOTT'S MOTs offers a diverse array of products and services tailored to meet the varied needs of your vehicle. Our diagnostic assessments provide an in-depth understanding of your vehicle's health, while our expert team excels in brake and exhaust system repairs, ensuring optimal performance and safety. Beyond these services, we extend our commitment to transparency by delivering detailed reports and clear communication, empowering you to make well-informed decisions about your vehicle's maintenance.
					</p>

					<P id = "p7">
						Embrace a holistic approach to automotive care with SCOTT'S MOTs, where our dedication to excellence shines through in every MOT test and service we provide. Trust us to accompany you on your vehicle's journey, ensuring it's not just compliant but truly optimized for the road. Your satisfaction and safety are our top priorities at SCOTT'S MOTs, where precision meets passion for an unparalleled automotive experience in Newport, Wales.
					</p>

					<!-- Car in the Services box -->
					<div class = "serviceimg">
						<img src = "images/car6.png" height = 100px>
					</div>

				</div>
			<section>
		</div>
		
		<!-- Car in the background of the page -->
		<div class = "bgcar">
			<img src = "images/car3.png">
		</div>

		<!-- Footer & links -->
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

				<!-- Account page is linked if the user is signed in -->
				<?PHP 
					if(!(check_login($con) == "False")) 
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
