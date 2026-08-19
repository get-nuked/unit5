<?PHP
	session_start();
	$_SESSION;
	include("Connection.php");
	include("Function.php");
	$error = "";


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//something was posted
		$user_name = $_POST["user_name"];
		$password = $_POST["password"];
		$repassword = $_POST["repassword"];
		$first = $_POST["firstname"];
		$last = $_POST["lastname"];
		$phone = $_POST["phone"];
		$namecolour = "#000000";
		$phonecolour = "#000000";
		$emailcolour = "#000000";
		$passwordcolour = "#000000";

		// Check if form was submitted:
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

			// Build POST request:
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			$recaptcha_secret = '6LciZXYpAAAAAH6etjIzDkns2rysxpEJ3hP62RWZ';
			$recaptcha_response = $_POST['recaptcha_response'];

			// Make and decode POST request:
			$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
			$recaptcha = json_decode($recaptcha);

			// Take action based on the score returned:
			if ($recaptcha->score >= 0.5) 
			{
				// Verified - send email
				if (filter_var($user_name, FILTER_VALIDATE_EMAIL)) 
				{

					// presence check on username and password
					if(!empty($user_name) && !empty($password))
					{
						// checks if the username exists in the databsse
						$empty = "";
						$query = "select * from logindetails where user_name = '$user_name'";
						$result = mysqli_query($con, $query);
						while($row = $result->fetch_assoc()) 
						{
							$empty = $row['user_name'];
						}    

						unset($error);
						
						// phone length check
						if(strlen($phone) !== 11 or is_numeric($phone) == 0)
						{
							if(((substr($phone, 0, 1) !== "+") or (substr($phone, 0, 1) !== "0")) && (strlen($phone) < 11))
							{
								$phone = substr_replace($phone, 0, 0, 0);
							}

							if((substr($phone, 0, 1) !== "+") && (strlen($phone) !== 11))
							{
								$error =  "contact number should be a 11 digit integer";
								$phonecolour = "#FF6347";
							} else if((substr($phone, 0, 1) == "+") && ((strlen($phone) > 14) or (strlen($phone) < 12)))
							{
								$error =  "contact number with calling code should be either 12, 13 or 14 digits";
								$phonecolour = "#FF6347";
							}
						}

						// password length check
						if(strlen($password) < 8)
						{
							// header("Location: Signup.php");
							$error = "password has to be longer than 8 characters";
							$passwordcolour = "#FF6347";
						}

						// double keying
						if($password !== $repassword)
						{
							// header("Location: Signup.php");
							$error = "passwords do not match.";
							$passwordcolour = "#FF6347";
						}

						if(1 !== preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $password)){
							$error = "passwords do not contain a special character.";
							$passwordcolour = "#FF6347";
						}

						if(1 !== preg_match('~[0-9]+~', $password)){
							$error = "passwords do not contain a digit.";
							$passwordcolour = "#FF6347";
						}

						// user does not exist
						if($empty !== "")
						{
							// header("Location: Signup.php");
							$error =  "account exists";
							$emailcolour = "#FF6347";
						}

						//checks the length of username
						if(strlen($first) > 50)
						{
							$error =  "First name must be under 50 characters";
							$namecolour = "#FF6347";
						}

						//checks the length of username
						if(strlen($last) > 50)
						{
							$error =  "Surname must be under 50 characters";
							$namecolour = "#FF6347";
						}

						// if user does not exist, passwords are matching (verification), passwords longer than 8 characters (validation - length check) and phone number has 11 digits
						if (!($error)) 
						{
							// saves to the database
							$password = password_hash($password, PASSWORD_DEFAULT);
							$query = "insert into logindetails (user_name, password, Admin) values ('$user_name','$password', 0)";
							mysqli_query($con, $query);
							$query = "select id from logindetails where user_name = '$user_name'";
							$result = mysqli_query($con, $query);
							while($row = $result->fetch_assoc()) {
								$user_id = $row['id'];
							}     
							$query = "insert into customerdetails (CustomerID, FirstName, LastName, Phone) values ('$user_id','$first','$last' ,'$phone')";
							mysqli_query($con, $query);
							header("Location: Login.php");
						}
						
					} else
					{
						$error = "Please enter some valid information";
					}
				} 
			} else 
			{
				$error = "Not verified, reCaptcha thinks you are a bot";
			}
		} 
	}

	// format check on email
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//something was posted
		$user_name = $_POST["user_name"];
		if (!(filter_var($user_name, FILTER_VALIDATE_EMAIL)))
		{
			// header("Location: Signup.php");
			$error = "$user_name is not a valid email address";
			$emailcolour = "#FF6347";
		}
	}
	
	// outputs error if found
	echo "<div class = 'error'> $error </div>";
?>

<html>
	<head>

		<!-- recaptcha  -->
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

		<!-- importing font library -->
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		
		<style>

			body {
				margin: 0;
				font-family: Arial, Helvetica, sans-serif;
				color: #191923
			}

			/* main container */
			.container {
				margin: 100px;
				padding: 50px;
				background-color: wheat;
				height: 70%;
				width: 86%;
				overflow: hidden;
				position:absolute; 
				top: 40%;
				left: 45%;
				transform: translate(-50%,-50%);
				border-radius: 15px;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				transition: 1s;
			}

			.container:hover {
				height: 70%;
				width: 86.5%;
			}

			/* gradient background */
			body {
				background: linear-gradient(-45deg, #fcc42c,#e1ad01, #FF8800, coral, hotpink);
				background-size: 400% 400%;
				animation: gradient 10s ease infinite;
				height: 100vh;
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

			/* different fields and texts */
			.firstname {
				height:20px;
				width: 400px;
				position: relative; 
				top: 34%;
				left: 37%;
				transform: translate(-50%,-50%);
			}

			.lastname {
				height:20px;
				width: 400px;
				position: relative; 
				top: 38%;
				left: 37%;
				transform: translate(-50%,-50%);
			}

			.phone {
				height:20px;
				width: 400px;
				position: relative; 
				top: 42%;
				left: 37%;
				transform: translate(-50%,-50%)
			}

			.username {
				height:20px;
				width: 400px;
				position: relative; 
				top: 46%;
				left: 37%;
				transform: translate(-50%,-50%)
			}

			input[type=text] {
				background-color: wheat;
				color: black;
				font-family: century-gothic, sans-serif;
				font-size: 18px;
				width:450px;
				height: 35px;
				border-radius: 5px;
			}

			.password {
				height:20px;
				width: 400px;
				position: relative; 
				top: 50%;
				left: 37%;
				transform: translate(-50%,-50%)
			}

			.repassword {
				height:20px;
				width: 400px;
				position: relative; 
				top: 54%;
				left: 37%;
				transform: translate(-50%,-50%)
			}

			input[type=password] {
				background-color: wheat;
				color: black;
				font-family: century-gothic, sans-serif;
				font-size: 18px;
				width: 450px;
				height: 35px;
				border-radius: 5px;
				border: 2px solid <?=$passwordcolour?> ;
			}

			/* signup button */
			.submit_btn {
				height:20px;
				width: 400px;
				position: relative; 
				top: 65%;
				left: 30%;
				transform: translate(-50%,-50%);
			}

			#button {
				background-color: #e1ad01;
				color: black;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 100%;
				font-family: century-gothic, sans-serif;
				font-size: 100%;
				border-radius: 10px;
				transition: 0.5s;
			}

			#button:hover {
				background-color: orangered;
				color: white;
			}

			.signup {
				font-family: 'Courier New', Courier, monospace;
				font-size: 15;
				font-weight: bold;
				position: absolute; 
				top: 84%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			a {
				transition: 1s;
			}

			/* scotts logo */
			.logo{
				position: absolute; 
				top: 50%;
				left: 80%;
				transform: translate(-50%,-50%);
			}

			/* labels */
			.text1{
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				font-size: 23px;
				position: absolute;
				top: 37%;
				left: 16%;
				transform: translate(-50%,-50%);
			}

			.text2{
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				font-size: 23px;
				position: absolute;
				top: 49%;
				left: 16%;
				transform: translate(-50%,-50%);
			}

			.text3{
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				font-size: 23px;
				position: absolute;
				top: 55%;
				left: 16%;
				transform: translate(-50%,-50%);
			}

			.text4{
				font-family: 'Courier New', Courier, monospace;
				font-weight: bold;
				font-size: 23px;
				position: absolute;
				top: 61%;
				left: 16%;
				transform: translate(-50%,-50%);
			}

			/* Sign up title */
			.title{
				font-family: century-gothic, sans-serif;
				font-size: 32px;
				position: absolute;
				top: 20%;
				left: 28%;
				transform: translate(-50%,-50%);
			}

			/* cross top right */
			.cross{
				position: absolute;
				top: 6.5%;
				left: 97%;
				transform: translate(-50%,-50%);
			}

			/* error message */
			.error{
				font-family: century-gothic, sans-serif;
				color: tomato;
				font-size: 15px;
				position: absolute; 
				top: 78%;
				left: 32.5%;
				transform: translate(-50%,-50%);
				z-index: 1000000;
			}

			#name{
				border: 2px solid <?=$namecolour?> ;
			}

			#phone{
				border: 2px solid <?=$phonecolour?> ;
			}

			#email{
				border: 2px solid <?=$emailcolour?> ;
			}

		</style>

	</head>


	<body>

		<body style="background-color:#26240c">

		<form method="post">

			<!-- input boxes and texts -->
			<!-- input boxes retain values if an error occurs as the values are saved to the respective variables -->
			<div class="container">
				<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
				<input type="hidden" name="action" value="validate_captcha">

				<div class="firstname">
					<input type="text" placeholder="First Name" name="firstname" id  = "name" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" required>
				</div>
				
				<div class="lastname">
					<input type="text" placeholder="Last Name" name="lastname" id  = "name" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" required>
				</div>

				<div class="phone">
					<input type="text" placeholder="Contact No." name="phone" id = "phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" required>
				</div>

				<div class="username">
					<input type="text" placeholder="Username" name="user_name" id = "email" value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>" required>
				</div> 

				<div class="password">
					<input type="password" placeholder="Password" name="password" required>
				</div>

				<div class="repassword">
					<input type="password" placeholder="Re-Enter Password" name="repassword" required>
				</div>

				<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

				
				<!-- submit button -->
				<div class="submit_btn">
					<input id = "button" type="submit" value = "Sign up">
				</div> 
				
				<div class="logo">
					<img src="images\SCOTT'S MOTs-logos_transparent.png" width=750px>
				</div>

				<div class="title">
					<h1>Never too late to sign up</h1>
				</div>

				<div class="text1">
					<p>Full Name</p>
				</div>
				
				<div class="text2">
					<p>Contact Number</p>
				</div>

				<div class="text3">
					<p>Email</p>
				</div>

				<div class="text4">
					<p>Password</p>
				</div>
				
				<div class="cross">
					<a href = "Login.php"><img src = "images/cross.png" height = 60px></a>
				</div>
			</div>

		</form>    



	</body>

</html>
