<?PHP
	session_start();
	$_SESSION;
	$_error_message = "";
	include("Connection.php");
	include("Function.php");
	$error = "";


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// // Check if form was submitted:
		// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

		// 	// Build POST request:
		// 	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		// 	$recaptcha_secret = '6LciZXYpAAAAAH6etjIzDkns2rysxpEJ3hP62RWZ';
		// 	$recaptcha_response = $_POST['recaptcha_response'];

		// 	// Make and decode POST request:
		// 	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		// 	$recaptcha = json_decode($recaptcha);

		// 	// Take action based on the score returned:
		// 	if ($recaptcha->score >= 0.5) 
		// 	{
				//something was posted
				$user_name = $_POST["user_name"];
				$password = $_POST["password"];
				if (filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
				
					if(!empty($user_name) && !empty($password))
					{
						//read from database
						$query = "select * from logindetails where user_name = '$user_name' limit 1";
						$result = mysqli_query($con, $query);

						if($result)
						{
							if ($result && mysqli_num_rows($result) > 0)
								{
									$user_data = mysqli_fetch_assoc($result);
									// assigns array $user_data details about the username

									// checks if the input is the same as the password from the database
									if(password_verify($password, $user_data['password']))
									{

										// checks if the account has been dissabled
										if($user_data['Disabled'] == 0)
										{

											// if the user is an admin, they will be redirected to the admin home page
											if ($user_data['Admin'] == 1)
											{

												$_SESSION["id"] = $user_data["id"];
												header("Location: Admin-Home.php");
												die;

											} else 
											// else redirected to the customer home page
											{

												$_SESSION["id"] = $user_data["id"];
												header("Location: Home.php");
												die;

											}

										} else if($user_data['Disabled'] == 1)
										{
											$error = "account dissabled";
										}

									}else 
									{
										$error = "wrong username or password";
										// header("refresh:2; url=login.php");
									}
								}else 
								{
								$error = "consider creating an account";
							}
						}

					} else
					{
						echo "<div class = 'error'> fill the fields </div>";
					}

				} else 
				{
				$error = "$user_name is not a valid email address";
				}
		// 	} else 
		// 	{
		// 		$error = "Not verified, reCaptcha thinks you are a bot";
		// 	}
		// } 
	}

	// outputs any errors if found
	echo "<div class = 'error'> $error </div>";
?>

<html>
	<head>

		<!-- importing the font library -->
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">

		<!-- captcha -->
		<script src="https://www.google.com/recaptcha/api.js?render=6LciZXYpAAAAAEMRKm8WHDmiEfG4FOxw1mxiYL33"></script>
		
		<script>
			function loadRecaptchaToken() {
				grecaptcha.ready(function () {
					grecaptcha.execute('6LciZXYpAAAAAEMRKm8WHDmiEfG4FOxw1mxiYL33', { action: 'contact' }).then(function (token) {
						var recaptchaResponse = document.getElementById('recaptchaResponse');
						recaptchaResponse.value = token;
					});
				});
			}
			loadRecaptchaToken();
			setInterval(function(){loadRecaptchaToken();}, 100000);
		</script>

		<title> Login </title>
		
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

			/* password and username inputboxes */
			input[type=text], input[type=password] {
				width: 50%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
			}

			/* main container */
			.container {
				z-index: 20000;
				padding: 50px;
				background-color: #191708;
				height: 500px;
				width: 18%;
				overflow: hidden;
				position:absolute; 
				top: 50%;
				left: 74%;
				transform: translate(-50%,-50%);
				border-radius: 0px 35px 35px 0px;
				transition: 0.4s;
			}

			.container:hover {
				width: 18.5%;
			}

			.image{
				position: absolute; 
				top: 50%;
				left: 38%;
				transform: translate(-50%,-50%);  
			}

			.image img {
				border-radius: 35px 0px 0px 35px;
				height:600px
			}

			/* username input */
			.username {
				height:20px;
				width: 600px;
				text-align: center;
				position: relative; 
				top: 60%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			input[type=text] {
				background-color: #24231a;
				color:#d4d3d2;
				font-family: 'Courier New', Courier, monospace;
				font-size: 15px;
				font-weight: bold;
				border-radius: 17px;
				border: none;
			}

			/* password input */
			.password {
				height:20px;
				width: 600px;
				text-align: center;
				position: relative; 
				top: 66%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			input[type=password] {
				background-color: #24231a;
				color:#d4d3d2;
				font-family: 'Courier New', Courier, monospace;
				font-size: 15px;
				font-weight: bold;
				border-radius: 17px;
				border: none;
			}

			/* login button */
			.submit_btn {
				height:20px;
				width: 300px;
				position: relative; 
				top: 76%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			#button {
				background-color: #eb5729;
				border: 5px solid #e1ad01;
				color: white;
				padding: 10px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 300px;
				font-family: century-gothic, sans-serif;
				font-size: 20px;
				border-radius: 35px;
				transition: 1s;
			}

			#button:hover {
				background-color: #e1ad01;
			}

			.signup {
				font-family: 'Courier New', Courier, monospace;
				font-size: 15;
				position: absolute; 
				top: 89%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			a {
				transition: 1s;
			}

			a:link {
				color: white;
			}

			a:visited {
				color: white;
			}

			a:hover {
				color: #e1ad01;
			}

			a:active {
				color: white;
			}

			/* welcome text and logo */
			.logo{
				position: absolute; 
				top: 38%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			.welcometext{
				position: absolute; 
				top: 30%;
				left: 74%;
				transform: translate(-50%,-50%);
				color: wheat;
				font-family: century-gothic, sans-serif;
				font-size: 50px;
				z-index: 400000;
				font-weight: bold;
			}

			/* background */
			.filter{
				height:100%;
				width:100%;
				background-color: black;
				z-index: 0;
				opacity: 0.98;
				background: linear-gradient(-45deg, #332a1f, #24201a, #24231a, #23241a);
				background-size: 400% 400%;
				animation: gradient 10s ease infinite;
				height: 100vh;
			}

			body {
				height: 100%;
				overflow-y: hidden;
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

			/* login error message */
			.error {
				position: absolute; 
				top: 52%;
				left: 74%;
				transform: translate(-50%,-50%);
				color: #d4d3d2;
				font-family: century-gothic, sans-serif;
				font-size: 15px;
				z-index: 400000;
			}

		</style>
	</head>

	<body>

		<!-- setting background image -->
		<body style="background-image: url('https://graphicriver.img.customer.envatousercontent.com/files/246486475/preview.jpg?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=60996981f30a0d18587856b07f400b4c')">

		<div class = filter></div>

		<!-- nav bar -->
		<div class="topnav">
			<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
			<a class = "navlinks" href="About.php">About</a>
			<a class = "navlinks" href="ContactUs.php">Contact Us</a>
			<a class = "navlinks" href="MOT.php">Book an MOT!</a>
		</div>

		<!-- login form -->
		<form method="post">
			<div class="container">
				<div class="username">
					<input id = "text" type="text" placeholder="Username" name="user_name" required>
				</div> 

				<div class="password">
					<input id = "text" type="password" placeholder="Password" name="password" required>
				</div>

				<!-- recaptcha hidden input -->
				<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
	
				<div class="submit_btn">
					<input id = "button" type="submit" value = "Login">
				</div> 
		
				<div class="logo">
					<img src="images\SCOTT'S MOTs-logos_simple2.png" width = 150>
				</div>

				<!-- signup link  -->
				<div class="signup">
					<a href="SignUp.php">Create an account</a>
				</div>
			</div>
		</form>

		<div class = "welcometext">
			<p>hello there!</p>
		</div>

		<div class="d-flex flex-column justify-content-center w-100 h-100"></div>

		<div class = "image">
			<img src = "images\test2.jpg" height = 600px>
		</div>
	
	</body>
</html>
