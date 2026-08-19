<?PHP
		session_start();
		$_SESSION;
		include("Connection.php");
		include("Function.php");

		#calls function "check_login" from Function.php 
		$user_data = check_login($con);
		
		# user is redirected to the login page if not signed in
		if(check_login($con) == "False")
		{
			header("Location: Login.php");
		}
?>


<html>
	<head>

		<title> Account </title>

		<!-- importing font library -->
		<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
		<link href="https://fonts.cdnfonts.com/css/uk-number-plate" rel="stylesheet">

		<script type="text/JavaScript">
			// converting a inpuut type from password to text or vice versa
			function showPasswords() {
				//sets password input boxes as javascript variables
				var currentpw = document.getElementById("currentpw");
				var newpw = document.getElementById("newpw");

				//if the input type is password, it converts both input fields into text fields 
				if (currentpw.type === "password") 
				{ 
					currentpw.type = "text";
					newpw.type = "text";
				} else 
				//if the input type is text, it converts both input fields into password fields 
				{
					currentpw.type = "password";
					newpw.type = "password";
					
				}
			}
		</script>

		<style>

			/* no horizontal scroll bar in the page */
			body {
				margin: 0;
				overflow-x: hidden;
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

			/* navbar links */
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

			/* nav bar dropdown for account related links */
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

			/* links inside the dropdown */
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

			/* footer text */
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

			/* company links in the footer */
			.company{
				width: 400px;
				text-align: center;
				position: relative;
				/* display: inline-block; */
				float: left;
			}

			/* products & you links in the footer */
			.products{
				width: 400px;
				text-align: center;
				position: relative;
				/* display: inline-block; */
				float: left;
				margin-left: 300px;
			}

			/* alligning company links in the footer */
			#company {
				position: absolute;
				top: 0px;
				left:50%;
				transform: translate(-50%,-50%);
			}

			/* allighning products & you links in the footer */
			#products {
				position: absolute;
				top: 0px;
				left:50%;
				transform: translate(-50%,-50%);
			}

			/* alligning each links in the footer */
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

			/* Account title container on the page */
			.accounttitle{
				width: 95%;
				height: 150px;
				/* background-image: linear-gradient(to bottom right,  #F0A202, #ff7800); */
				border-radius: 20px;
				position: absolute;
				top: 125px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			/* Account title */
			.title {
				position: absolute;
				top:30px;
				left: 175px;
				transform: translate(-50%,-50%);
				font-size: 27.5px;
				font-family: century-gothic, sans-serif;
				color: #3d1c16; 
			}
			
			/* welcome [firstname]! title */
			.nametitle {
				position: absolute;
				top: 40px;
				left: 440px;
				transform: translate(-50%,-50%);
				font-size: 25px;
				font-family: century-gothic, sans-serif;
				color: black;
			}

			/* Your details box */
			.details{
				margin-left: 2.5%;
				margin-top: 175px;
				height: 510px;
				width: 68%;
				padding: 75px;
				background-color: #2d2c21;
				border-radius: 25px 0px 0px 25px;
				position: relative;
				float: left;
				flex: 2;
			}

			/* Your Details title */
			.details h4{
				font-size: 30px;
			}

			.detailstitle{
				position: absolute;
				top: 75px;
				left: 220px;
				transform: translate(-50%,-50%);
				font-family: century-gothic, sans-serif;
				color: white;
			}

			/* Your Details text */
			.details p{
				font-size: 20px;
				font-weight: bold;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
				position:relative;
				margin-left: 125px;
				margin-top: 25px;
			}

			.detailstext{
				margin-top: 50px;
			}

			/* Your Details input fields */
			Input[type = text]{
				height: 30px;
				width: 600px;
				background: #211f0e;
				color: white;
				border: none;
				border-radius: 10px;
				font-size: 25px;
				font-weight: bold;
				font-family: "Courier New", monospace;
				margin-bottom: 20px;
				position: relative;
			}

			.detailsinput {
				position: absolute;
				top: 240px;
				left: 680px;
				transform: translate(-50%,-50%);
			}

			/* change password button/link */
			.detailsinput a {
				color: white;
				font-size: 25px;
				font-weight: bold;
				font-family: "Courier New", monospace;
				margin-bottom: 20px;
				position: relative;
				text-decoration: none;
			}

			.password {
				height: 30px;
				width: 600px;
				background: #211f0e;
				border: none;
				border-radius: 10px;
			}

			/* Vehcile in the Your Details box */
			.details img {
				height: 150px;
				position: absolute;
				top: 500px;
				left: 600px;
				transform: translate(-50%,-50%);
			}

			/* Change button in the Your details box */
			#change{
				height: 28px;
				width: 150px;
				background: #adc2dd;
				border:none;
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
				top: 380px;
				left: 900px;
				transform: translate(-50%,-50%);
			}

			/* error message formatting in the Your Details box */
			.error {
				position: absolute;
				top: 520px;
				left: 450px;
				transform: translate(-50%,-50%);
				font-size: 15px;
				font-family: century-gothic, sans-serif;
			}

			.errordetails{
				position: absolute;
				top: 14px;
				left: -200px;
				transform: translate(-50%,-50%);
				font-size: 17px;
				font-family: century-gothic, sans-serif;
				width: 400px;
				color:#fcc42c;
			}

			/* Your Vehicles box */
			.vehicles{
				position: relative;
				margin-top: 175px;
				margin-right: 2.5%;
				float: right;
				height: 440px;
				overflow: auto;
				padding-top: 100px;
				padding-bottom: 120px;
				padding-right: 4%;
				background-color: #2d2c21;
				width: 27%;
				border-radius: 0px 40px 40px 0px;
				flex: 1;
				overflow-x: hidden;
			}
			
			/* Your Vehicles title */
			.vehicles h4{
				position: absolute;
				top: 25px;
				left: 47%;
				transform: translate(-50%,-50%);
				font-size: 30px;
				font-family: century-gothic, sans-serif;
				color: white;
				white-space: nowrap;
			}

			/* custom scrollbar for Your Details box */
			.vehicles::-webkit-scrollbar {
				width: 10px;
			}

			.vehicles::-webkit-scrollbar-track {
				background: #f1ae65; 
				border:none;
			}
			
			.vehicles::-webkit-scrollbar-thumb {
				background: #DEDCD1; 
				border-radius: 5px;
			}

			.vehicles::-webkit-scrollbar-thumb:hover {
				background: white; 
			}

			/* Each vehicle the user owns (vehicles are displayed as rows in the table) */
			table{
				table-layout: fixed;
				border-top: 20px solid #2d2c21;
				border-right: 20px solid #2d2c21;
				border-bottom: 0px solid #2d2c21;
				border-left: 20px solid #2d2c21;
				/* column-width: 300px; */
				text-align: center;
    			border-spacing: 0;
			}

			/* setting column widths */
			th {
				column-width: 10%;
				column-gap: 0px;
			}

			th:first-child {
				column-width: 300px;
			}

			th:last-child {
				column-width: 300px;
			}

			/* formatting table columns */

			/* middle column (details about the vehicle) */
			tr td {
				border-right: none;
				border-left: 10px solid #211f0e;
				width: 77.5%;
				column-width: 77.5%;
				background-color: #211f0e;
				height: 110px;
				font-size: 18px;
				font-weight: bold;
				font-family: "Courier New", monospace;
				color: #DEDCD1;
				column-gap: 0px;
				border-style: hidden;
			}

			/* left column (vehicle image) */
			tr td:first-child {
				border-left: none;
				border-right: 10px solid #211f0e;
				border-radius: 20px 0px 0px 20px;
				width: 85px;
				text-align: center;
				padding-left: 10px
			}

			/* right column (delete option) */
			tr td:last-child {
				border-right: none;
				border-left: 10px solid #211f0e;
				border-radius: 0px 20px 20px 0px;
				width: 100px;
				text-align: center;
			}

			/* formatting delete button */
			tr td input {
				font-family: "Courier New", Courier;
				font-weight: bold;
				font-size: 20px;
				text-align: center;
				border-radius: 10px;
				background-color: #42402f;
				color: white;
				border: none;
				width: 40px;
				height: 40px;
				margin-right: 10px;
				transition: 0.3s;
			}

			tr td input:hover {
				border-radius: 25px;
				background-color: #753826;
			}

			tr td input:active {
				background-color: #f72e05;
			}

			/* giving the registration number the UK plate font */
			#reg {
				font-family: 'UKNumberPlate', sans-serif;
				font-size: 24px;
				color: white;
				margin-bottom: 5px;
			}

			/* add vehicle button in the Your Vehicle box */
			.add{
				position: relative;
				top: -285px;
				left: 2240px;
				transform: translate(-50%,-50%);
			}

			.button {
				background-color: #211f0e;
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

			/* contains all "Your Details", "Your Vehicle", account delete and view bookings boxes */
			.container {
				position: relative;
				top: 69.75%;
				left: 50%;
				transform: translate(-50%,-50%);
				background-image: linear-gradient(to bottom right, #f5bd73, #f2aa5c); 
				background-color:#f1ae65;
				margin-bottom: 150px;
				border-radius: 20px;
				width: 90%;
				height: 1225px;
				box-shadow:
				0 1px 1px hsl(0deg 0% 0% / 0.075),
				0 2px 2px hsl(0deg 0% 0% / 0.075),
				0 4px 4px hsl(0deg 0% 0% / 0.075),
				0 8px 8px hsl(0deg 0% 0% / 0.075),
				0 16px 16px hsl(0deg 0% 0% / 0.075);
				display: flex;
				flex-direction: row;
				flex-wrap: wrap;
				gap: 0px;
			}

			/* delete account box */
			.delete{
				background: #d36f20;
				width: 100%;
				height: 150px;
				position: absolute;
				margin-top: 1150px;
				left: 50%;
				transform: translate(-50%,-50%);
				border-radius: 0px 0px 20px 20px;
			}

			/* delete account text in the delete account box */
			.deletetext{
				font-size: 20px;
				color: #DEDCD1;
				position: absolute;
				top: 50%;
				left: 37.5%;
				transform: translate(-50%,-50%);
				font-family: "Courier New", Courier;
				font-weight: bold;
			}

			/* delete link in the account page */
			#del{
				font-family: "Courier New", Courier;
				font-weight: bold;
				text-decoration: none;
				color: black;
				line-height: 35px;
				text-align: center;
			}

			#del:hover{
				color: #DEDCD1;
				line-height: 35px;
			}
			
			.deletebutton{
				height: 35px;
				width: 175px;
				background: #DEDCD1;
				border: none;
				border-radius: 20px;
				font-size: 20px;
				position: absolute;
				top: 50%;
				left: 70%;
				transform: translate(-50%,-50%);
				transition: 0.75s;
			}

			.deletebutton:hover {
				width: 200px;
				height: 36px;
				width: 200px;
				background: #b84825;
			}

			/* makes the account page slightly darker when the add vehicle popup is open */
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

			/* add vehicle pop up */
			.popup {
				z-index: 2000;
				margin: 70px auto;
				padding: 30px;
				border-radius: 20px;
				width: 530px;
				position: absolute;
				top:45%;
				left:50%;
				transform: translate(-50%,-50%);
				transition: all 5s ease-in-out;
				background: linear-gradient(-45deg, #fcc42c,#e1ad01, #FF8800, coral, hotpink);
				background-size: 400% 400%;
				animation: gradient 10s ease infinite;
				height: 550px;
				transition: 1s;
			}

			.popup:hover {
				/* animation: hover 0.75s ease; */
				box-shadow: rgba(138, 104, 37, 0.4) 10px 10px, rgba(138, 104, 37, 0.3) 20px 20px, rgba(138, 104, 37, 0.2) 30px 30px, rgba(138, 104, 37, 0.1) 40px 40px, rgba(138, 104, 37, 0.05) 50px 50px;
			}

			/* centent inside of the add vehicle popup */
			.content {
				position: absolute;
				top: 370px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			.content p {
				font-size: 15px;
				font-family: "Courier New", Courier;
				font-weight: bold;
				position: absolute;
				top:91.5%;
				left: 50%;
				transform: translate(-50%,-50%);
				width: 90%;
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

			/* Add a Vehicle title in the popup */
			.popup h2 {
				margin-top: 40px;
				margin-left: 20px;
				font-size: 45px;
				font-family: century-gothic, sans-serif;
				color: #DEDCD1;
			}

			/* text inputs in the add vehicle popup */
			.popup input[type=text] {
				height: 40px;
				width: 500px;
				background: rgba(222,220,209, 0.3);
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 10px;
				border: 0px;
				font-weight:100;
			}

			/* 'I have a private plate' checkbox in the add vehicle popup */
			.popup input[type=checkbox] {
				border-radius: 10px;
			}

			.popup label{
				font-size: 18px;
				font-family: century-gothic, sans-serif;
				color: white;
			}

			/* lookup dropdown to select vehicle type in the add vehicle popup */
			.popup select {
				height: 40px;
				width: 500px;
				background: rgba(222,220,209, 0.3);
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 10px;
				border: 0px;
			}

			/* lookup dropdown options */
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

			/* add button in the add vehicle popup */
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

			/* cross in the add vehicle popup */
			.popup .close {
				position: absolute;
				top: 0px;
				right: 30px;
				transition: all 200ms;
				font-size: 100px;
				text-decoration: none;
				color: white;
				transition: 0.3s;
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

			/* view bookings linked box in the account page */
			.bookings {
				height:200px;
				width:100%;
				background: #db8344 ;
				position: absolute;
				top: 976px;
				left: 50%;
				transform: translate(-50%,-50%);
				transition: 1s;
			}

			.bookings a {
				display: block;
				height:100%;
				width:100%;
				font-size: 22px;
				font-family: "Courier New", monospace;
				color: #3d1c16; 
				text-decoration: none; 
				transition: 0.75s;
				font-weight: bold;
			}

			.bookings p {
				position: absolute;
				top: 40%;
				left: 41%;
				transform: translate(-50%,-50%);
				white-space: nowrap;
			}

			.bookings:hover {
				background-color: #df7c2e ;
			}

			.bookings a:hover {
				background-color: #df7c2e ;
				font-size: 150%;
				color: #3d1c16; 
			}

			/* arrow in the view bookings button */
			.bookingsimg {
				position: absolute;
				top: 50%;
				left: 70%;
				transform: translate(-50%,-50%);
				height: 35px;
				width: 175px;
				background: #DEDCD1;
				border: none;
				border-radius: 20px;
				transition: 0.75s;
				font-weight: bold;
			}

			.bookings img {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			.bookingsimg:hover {
				height: 36px;
				width: 200px;
				background: wheat;
				border: none;
			}

			/* account delete popup */
			.deletepopup {
				z-index: 2000;
				margin: 70px auto;
				padding: 30px;
				border-radius: 20px;
				width: 900px;
				position: absolute;
				top:45%;
				left:50%;
				transform: translate(-50%,-50%);
				background-color: #ffeecb;
				height: 375px;
				transition: 1s;
			}

			/* account delete popup content */
			.deletecontent {
				position: absolute;
				top: 275px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			/* 'Are you sure?' title in the account delete popup */
			.deletepopup h2 {
				margin-top: 40px;
				margin-bottom: 40px;
				margin-left: 20px;
				font-size: 45px;
				font-family: century-gothic, sans-serif;
				color: #3d1c16;
			}

			/* disclaimer text in the account delete popup */
			.deletecontent p{
				font-size: 20px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				text-align: center;
			}

			/* password input in the account delete popup */
			.deletepopup input[type=password] {
				text-align: center;
				height: 40px;
				width: 600px;
				background-color: white;
				color: #753826;
				border-radius: 20px;
				font-size: 20px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				margin-bottom: 10px;
				border: 0px;
			} 

			/* delete button in the account delete popup */
			.deletepopup input[type=submit] {
				margin-top: 10px;
				height: 40px;
				width: 600px;
				background: wheat;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 30px;
				border: 0px;
				transition: 0.75s;
			}

			.deletepopup input[type=submit]:hover {
				border-radius: 40px;
				background-color:#b84825;
				font-size: 20px;
			}

			/* error in the account delete popup */
			#deleteerror {
				color: #3d1c16;
				font-size: 18px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				text-align: center;
				margin-top: -10px;
			}

			/* cross in the account delete popup */
			.deletepopup .deleteclose {
				position: absolute;
				top: 0px;
				right: 30px;
				transition: all 200ms;
				font-size: 100px;
				text-decoration: none;
				color: #3d1c16;
				transition: 0.3s;
			}

			.deletepopup .deleteclose:hover {
				color:#753826;
			}

			@media screen and (max-width: 700px){
				.box{
					width: 70%;
				}
				.deletepopup{
					width: 70%;
				}
			}

			/* change password popup */
			.pwpopup {
				z-index: 2000;
				margin: 70px auto;
				padding: 30px;
				border-radius: 20px;
				width: 750px;
				position: absolute;
				top:45%;
				left:50%;
				transform: translate(-50%,-50%);
				background-color: #ffeecb;
				height: 400px;
				transition: 1s;
			}

			/* content in change password popup */
			.pwcontent {
				position: absolute;
				top: 305px;
				left: 50%;
				transform: translate(-50%,-50%);
			}

			/* title in change password popup */
			.pwpopup h2 {
				margin-top: 40px;
				margin-bottom: 40px;
				margin-left: 20px;
				font-size: 45px;
				font-family: century-gothic, sans-serif;
				color: #3d1c16;
			}

			/* passwords made visible in change password popup */
			.pwpopup input[type=text] {
				text-align: center;
				height: 40px;
				width: 600px;
				background-color: white;
				color: #753826;
				border-radius: 20px;
				font-size: 20px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				margin-bottom: 10px;
				border: 0px;
			}

			/* passwords made hidden in change password popup */
			.pwpopup input[type=password] {
				text-align: center;
				height: 40px;
				width: 600px;
				background-color: white;
				color: #753826;
				border-radius: 20px;
				font-size: 20px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				margin-bottom: 10px;
				border: 0px;
			} 

			/* show passwords text in change password popup */
			.pwpopup label {
				color: #3d1c16;
				font-size: 18px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				border: 0px;
			} 

			/* update password button in change password popup */
			.pwpopup input[type=submit] {
				margin-top: 10px;
				height: 40px;
				width: 600px;
				background: wheat;
				color: #2d2c21;
				border-radius: 10px;
				font-size: 22px;
				font-family: century-gothic, sans-serif;
				margin-bottom: 30px;
				border: 0px;
				transition: 0.75s;
			}

			.pwpopup input[type=submit]:hover {
				border-radius: 40px;
				background-color:darksalmon;
				font-size: 20px;
			}

			/* error message in change password popup */
			#pwerror {
				color: #3d1c16;
				font-size: 18px;
				font-family: "Courier New", monospace;
				font-weight: bold;
				text-align: center;
				margin-top: -10px;
			}

			/* cross in change password popup */
			.pwpopup .pwclose {
				position: absolute;
				top: 0px;
				right: 30px;
				transition: all 200ms;
				font-size: 100px;
				text-decoration: none;
				color: #3d1c16;
				transition: 0.3s;
			}

			.pwpopup .pwclose:hover {
				color:#753826;
			}

			@media screen and (max-width: 700px){
				.box{
					width: 70%;
				}
				.pwpopup{
					width: 70%;
				}
			}

		</style>
	</head>

	<body>
	
		<!-- setting dark background colour -->
		<body style="background-color:#24231a"> 

		<!-- navigation bar -->
		<div class="topnav">
			<!-- links in the nav bar -->
			<a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
			<a class = "navlinks" href="About.php">About</a>
			<a class = "navlinks" href="ContactUs.php">Contact Us</a>
			<a class = "navlinks" class="active" href="MOT.php">Book an MOT!</a>

			<!-- dropdown in the nav bar -->
			<div class="dropdown" style="float:right">
				<?PHP
				$_SESSION;
				$user_data = check_login($con);
				$user_id = $_SESSION["id"];  

				// Making the dropdwonn in the nav bar have the first name of the user. 
				$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
				$result = $con->query($sql);
				while($row = $result->fetch_assoc()) 
				{
					echo "<button class='dropbtn'>Hi $row[FirstName]</button>";
				}      
				?>
				<!-- links in the dropdown -->
				<div class="dropdown-content">
					<a href="Account.php">Account</a>
					<a href="Bookings.php">Bookings</a>
					<a href="Logout.php"> Log Out </a>
				</div>
			</div>
		</div>


		<div class = "container">

			<!-- Account page title -->
			<div class = "accounttitle">
				<div class = "title">
					<h1>Account    |</h1>
				</div>

				<!-- make the title say 'Welcome [firstname]!'-->
				<div class = "nametitle">
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

			<!-- user's data (Your Details) -->
			<div class = "details">
				<!-- title -->
				<div class = "detailstitle">
					<h4>Your Details</h4>
				</div>

				<!-- text -->
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

				<!-- creating input fields to display and enter information to the user -->
				<form method = post>
					<div class = "detailsinput">

						<!-- First Name input field is created and asigned the firstname of the user -->
						<div class = "first">
							<?PHP
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"];  

								$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
								$result = $con->query($sql);
								while($row = $result->fetch_assoc()) 
								{
									echo "<input type='text' value = '$row[FirstName]' name = 'firstinput'>";
								}     
							?>
						</div>
					
						<!-- Last Name input field is created and asigned the lastname of the user -->
						<div class = "last">
							<?PHP
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"];  

								$sql = "SELECT LastName FROM customerdetails WHERE CustomerID = '$user_id'";
								$result = $con->query($sql);
								while($row = $result->fetch_assoc()) 
								{
									echo "<input type='text' value = '$row[LastName]' name = 'lastinput'>";
								}     
							?>
						</div>

						<!-- Phone input field is created and asigned the contact number of the user -->
						<div class = "phone">
							<?PHP
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"];  

								$sql = "SELECT Phone FROM customerdetails WHERE CustomerID = '$user_id'";
								$result = $con->query($sql);
								while($row = $result->fetch_assoc()) 
								{
									echo "<input type='text' value = '$row[Phone]' name = 'phoneinput'>";
								}     
							?>
						</div>

						<!-- Email input field is created and asigned the username of the user -->
						<div class = "email">
							<?PHP
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"];  

								$sql = "SELECT user_name FROM logindetails WHERE id = '$user_id'";
								$result = $con->query($sql);
								while($row = $result->fetch_assoc()) 
								{
									echo "<input type='text' value = '$row[user_name]' name = 'emailinput' disabled>";
								}     
							?>
						</div>
					
						<!-- Change password button/link -->
						<a id = "pwchange" name = 'passwordinput' href="#pwpopup">
							<div class = "password">
								change Password? 
							</div>
						</a>
					</div>
					
					<!-- Update user data button -->
					<div class = "change">
						<input type = "submit" id = "change" name = "change" value = "Change" onClick="window.location.href=window.location.href">
							<?php
								$_SESSION;
								$user_data = check_login($con);
								$user_id = $_SESSION["id"]; 
								$errormessagedetails = "";
								$errordetails = false;

								// Validation

								// if field left empty, it retrieves orignal value form the database and assigns to the repective variable
								// asigning firstname field value to a variable
								if (isset($_POST) And (! empty($_POST['firstinput'])))
								{
									$first = $_POST['firstinput'];
								} else
								{
									$sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$first = $row['FirstName'];
									}     
									$errormessagedetails =  "field(s) left empty";
									$errordetails = true;
								}

								// asigning lastname field value to a variable
								if (isset($_POST) And (! empty($_POST['lastinput'])))
								{
									$last = $_POST['lastinput'];
								} else
								{
									$sql = "SELECT LastName FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$last = $row['LastName'];
									}     
									$errormessagedetails =  "field(s) left empty";
									$errordetails = true;
								}

								// asigning contact number field value to a variable
								if (isset($_POST) And (! empty($_POST['phoneinput'])))
								{
									$phone = $_POST['phoneinput'];
								} else
								{
									$sql = "SELECT Phone FROM customerdetails WHERE CustomerID = '$user_id'";
									$result = $con->query($sql);
									while($row = $result->fetch_assoc()) {
										$phone = $row['Phone'];
									}     
									$errormessagedetails =  "field(s) left empty";
									$errordetails = true;
								}


								// presence check on the name fields and the phone field
								if ((empty($first) == 1) or (empty($last) == 1) or (empty($phone) == 1)) 
								{
									$errormessagedetails = "empty field(s)";
									$errordetails = true;
								}

								//checks the length of username
								if(strlen($first) > 50)
								{
									$errormessagedetails =  "First name must be under 50 characters";
									$errordetails = true;
								}

								//checks the length of username
								if(strlen($last) > 50)
								{
									$errormessagedetails =  "Surname must be under 50 characters";
									$errordetails = true;
								}

								if(strlen($phone) !== 11 or is_numeric($phone) == 0)
								{
									if(((substr($phone, 0, 1) !== "+") or (substr($phone, 0, 1) !== "0")) && (strlen($phone) < 11))
									{
										$phone = substr_replace($phone, 0, 0, 0);
									}

									if((substr($phone, 0, 1) !== "+") && (strlen($phone) !== 11))
									{
										$errormessagedetails =  "contact number should be a 11 digit integer";
										$errordetails = true;
									} else if((substr($phone, 0, 1) == "+") && ((strlen($phone) > 14) or (strlen($phone) < 12)))
									{
										$errormessagedetails=  "contact number with calling code should be either 12, 13 or 14 digits";
										$errordetails = true;
									}
								}
								
								// once the update button is clicked, checks if there are any errors, if not, then updates the database
								if(isset($_POST['change']))
								{
									if ($errordetails == false){
										$sql = "update customerdetails set Firstname = '$first', LastName = '$last', Phone = '$phone' where CustomerID = '$user_id' ";
										mysqli_query($con, $sql);
										$_POST['first'] = "";
										$_POST['last'] = "";
										$_POST['phone'] = "";
										echo "<meta http-equiv='refresh' content='0'>";
										$errormessagedetails = "";
										echo "<div class = 'errordetails'>$errormessagedetails</div>";
									} else
									// outputs error message if found
									{
										echo "<div class = 'errordetails'>$errormessagedetails</div>";
										$errordetails = false;
									}
								}
							?>
						</input>
					</div>
				</form>

				<img src = "images\car9.png">

			</div>

			<!-- Your Vehicles box -->
			<div class = "vehicles">
				<h4>Your Vehicles</h4>
				<form method = "post">
					<?php
						$_SESSION;
						$user_data = check_login($con);
						$user_id = $_SESSION["id"]; 
						$sql = "select Make, Model, ModelYear, Registration from cars where user_id = '$user_id'";
						$result = mysqli_query($con, $sql); 
						$count = 0;
						$reg = [];
			
						// assigning vehicle details into an array
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
							
							$details[]= $db_field['ModelYear'] . " " . $db_field['Make'] . " " . $db_field['Model'];
							$reg[]= $db_field['Registration'];
							$count += 1;
						}

						$rep = 0;

						// outputs each vehicle as a table row from the arrays
						// assigns the name of the delete button as the registration of the vehicle
						while ($rep < $count)
						{
							$single_reg_key = str_replace(' ', '_', $reg[$rep]);
							echo "
							<table>
								<tr>
									<td> <img src = 'images\morris.png' width = 75 align='right'> </td>
									<td> <p id = 'reg'>$reg[$rep]</p> $details[$rep] </td>
									<td> <input type = 'submit' name = '$single_reg_key' value='✘'> </td>
								</tr>
							</table>";
							$rep += 1;
						}

					?>

					<!-- button to open the add vehicle pop up -->
					<a class="button" id = "btn-add" href="#addpopup"> <img src = "images\add.png" height = 25px > </a>
						
					<?PHP 
					
					// deleting vehicle from the databases
					if ($reg)
					{
						// goes through every button to check if a button is clicked
						foreach ($reg as $single_reg) 
						{
							// replacing the space in registration with an _ 
							$single_reg_key = str_replace(' ', '_', $single_reg);
							if (isset($_POST[$single_reg_key])) 
							{
								$sql = "delete from cars where Registration = '$single_reg'";
								mysqli_query($con, $sql);
								// refreshes page
								echo "<meta http-equiv='refresh' content='0'>";								
							}
						}
					}

					?>
				</form>
			</div>

			<!-- View bookings box -->
			<div class = "bookings">
				<a href="Bookings.php">
					<div>
						<p> Your Bookings with us </p> 
						<div class = "bookingsimg">  
							<img src = "images\arrow.png" height = 20px>   
						</div>          
					</div>
				</a>
			</div>

			<!-- delete accouynt button -->
			<div class = "delete">
				<div class = "deletetext">
					<p>Delete Account? Sad to see you go</p>
				</div>

				<!-- calls the deletepopup div (delete account poup) -->
				<a id = "del" name = "del" href="#deletepopup"> 
					<div class = "deletebutton">
						Delete 
					</div>
				</a>
				
			</div>
		</div>
	
		<!-- add vehicle popup -->
		<div id = "addpopup" class = "overlay">
			<div class="popup">
				<h2>Add a vehicle</h2>
				<a class="close" href="#">&times;</a>
				<div class="content">

					<!-- inputs -->
					<form method = "post">
						<input type='text' placeholder = 'Registration' name = 'reg'>
						<input type="checkbox" name="custom" value="Custom Plate">
						<label for="custom"> I have a private plate</label><br><br>
						<input type='text' placeholder = 'Make' name = 'make'>
						<input type='text' placeholder = 'Model' name = 'model'>
						<input type='text' placeholder = 'Model Year' name = 'year'>
						<select name = "type">
							<option value = 'Cabriolet'>Cabriolet</option>
							<option value = 'Coupe'>Coupe</option>
							<option value = 'Crossover/SUV'>Crossover/SUV</option>
							<option value = 'Estate'>Estate</option>
							<option value = 'Hatchback'>Hatchback</option>
							<option value = 'Motor'>Motor Caravan</option>
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
						$errorcar = false;
						$errorcarmessage = "";
						$reg = "";

						// assigning the $reg variable the value from the registration input
						if (isset($_POST) And isset($_POST['reg']))
						{
							$reg = $_POST['reg'];

							// if the private plate checkbox is not ticked
							if (!(isset($_POST['custom'])))
							{
								// if the registration is not a private plate and is missing a space, it inserts a space between the 4th and 5th characters
								if (substr($reg, 4, 1) !== " ")
								{
									$reg = substr_replace($reg, ' ', 4, 0);
								}
							}
						} else
						{
							$reg = "";
							$errorcar = true;
							$errorcarmessage = "Registration left blank";
						}

						// assigns details from the input boxes to respective variables.

						if (isset($_POST) And isset($_POST['make']))
						{
							$make = $_POST['make'];
						} else
						{
							$make = "";
							$errorcar = true;
							$errorcarmessage = "Make left blank";
						}

						if (isset($_POST) And isset($_POST['model'])) 
						{
							$model = $_POST['model'];
						} else
						{
							$model = "";
							$errorcar = true;
							$errorcarmessage = "Model left blank";
						}

						if (isset($_POST) And isset($_POST['type']))
						{
							$type = $_POST['type'];
						} else
						{
							$type = "";
							$errorcar = true;
							$errorcarmessage = "Type left blank";
						}

						if (isset($_POST) And isset($_POST['colour']))
						{
							$colour = $_POST['colour'];
						} else
						{
							$colour = "";
							$errorcar = true;
							$errorcarmessage = "Colour left blank";
						}
	
						if (isset($_POST) And isset($_POST['year']))
						{
							$year = $_POST['year'];
						} else
						{
							$year = "";
							$errorcar = true;
							$errorcarmessage = "Year left blank";
						}

						// validation

						// presence check on all the fields
						if($reg == "" or $reg == " "  or $make == "" or $model == "" or $year == "" or $colour == "")
						{
							$errorcar = true;
							$errorcarmessage = "Field(s) left blank";
						}

						// length check on registration
						if(strlen($reg) > 9)
						{
							$errorcar = true;
							$errorcarmessage = "Invalid registration";
						}

						// length check on make
						if(strlen($make) > 50)
						{
							$errorcar = true;
							$errorcarmessage = "Manufacturer name is too long";
						}

						// length check on model
						if(strlen($model) > 100)
						{
							$errorcar = true;
							$errorcarmessage = "Model name is too long";
						}

						// length check and type check on manufactured year
						$intyear = (int)$year;
						$stryear = strval($year);
						if(strlen($stryear) !== 4 or (is_numeric($year) == 0))
						{
							$errorcar = true;
							$errorcarmessage = "Invalid model year";
						}

						if(strlen($colour) > 50)
						{
							$errorcar = true;
							$errorcarmessage = "paint name is too long";
						}

						// checks if the car already exist in the database
						$carexists = false;
						$query = "select * from cars where Registration = '$reg'";
						$result = mysqli_query($con, $query);
						while($row = $result->fetch_assoc())
						{
							$carexists = true;
						}     

						if ($carexists == true)
						{
							$errorcar = true;
							$errorcarmessage = "This vehicle is in our database. Contact us if you think this is a mistake.";
						}

						// adds vehicle to databse if no errors were found
						if (isset($_POST["addbtn"]))
						{
							if ($errorcar == false){
								$sql = "insert into cars (Registration, Make, Model, ModelYear, Colour, Type, user_id)  values('$reg', '$make', '$model', '$year', '$colour', '$type','$user_id')";
								mysqli_query($con, $sql); 
								echo "<meta http-equiv='refresh' content='0'>";
								$errorcarmessage = "";
								echo "<p> $errorcarmessage <?p>";
							} else 
							{
								// echoes error if found
								echo "<p> $errorcarmessage <?p>";
							}
						}
					?>

				</div>
			</div>
		</div>

		<!-- Change Password Popup -->
		<div id = "pwpopup" class = "overlay">
			<div class="pwpopup">
				<h2>Change your pasword?</h2>
				<a class="pwclose" href="#">&times;</a>
				<div class="pwcontent">
					<form method = "post">
						<input type = "password" name = "currentpw" id ="currentpw" placeholder = "Current Password">
						<input type = "password" name = "newpw" id = "newpw" placeholder = "New Password">
						<input type="checkbox" onclick="showPasswords()"><label> Show Passwords </label>
						<input type = "submit"  name = "pwchangebtn" Value = "Update Password">

						<!-- Update button is clicked -->
						<?php
							$_SESSION;
							$user_id = $_SESSION["id"];  

							if(isset($_POST['pwchangebtn'])) 
							{
								$query = "select * from logindetails where id = '$user_id' limit 1";
								$result = mysqli_query($con, $query);
								$pwerrordetails = "";
								$pwerror = false;
								unset($pwerrordetails);

								if($result)
								{
									if ($result && mysqli_num_rows($result) > 0)
									{
										$currentpassword = $_POST['currentpw'];
										$newpassword = $_POST['newpw'];
										$pwerrordetails = "";
										unset($pwerrordetails);
										$pwerror = false;


										// hashing the new password
										$hashednewpassword = password_hash($newpassword, PASSWORD_DEFAULT);

										$user_data = mysqli_fetch_assoc($result);

										// validatiom

										// special character check on password
										if(1 !== preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $newpassword)){
											$pwerrordetails = "password does not contain a special character.";
											$pwerror = true;
										}

										if(1 !== preg_match('~[0-9]+~', $newpassword)){
											$pwerrordetails = "password does not contain a digit.";
											$pwerror = true;
										}

										// length check on password
										if(strlen($newpassword) < 8)
										{
											$pwerrordetails = "password should be longer than 8 characters.";
											$pwerror = true;
										}

										if($pwerror === false)
										{
											// checks if the current password is correct and if it is, updatesthe databse
											if(password_verify($currentpassword, $user_data['password']))
											{
												$sql = "update logindetails set password = '$hashednewpassword' where id = '$user_id' ";
												mysqli_query($con, $sql);
											} else 
											{
												echo "<p id='pwerror'> Incorrect Password </p>";
											}
										} else
										{
											// echoes error message if found
											echo "<p id='pwerror'> $pwerrordetails </p>";
										}
									}
								}
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<!-- delete account popup -->
		<div id = "deletepopup" class = "overlay">
			<div class="deletepopup">
				<h2>Are you sure?</h2>
				<a class="deleteclose" href="#">&times;</a>
				<div class="deletecontent">
					<form method = "post">
						<p> Please note, once the action has been carried out, it cannot be reverted. </p>
						<input type = "password" name = "pw" id ="pw" placeholder = "Password">
						<input type = "submit" id = "del" name = "del" value = "Delete">

						<?php
							$_SESSION;
							$user_id = $_SESSION["id"]; 
							
							// if delete account button is clicked
							if (isset($_POST["del"]))
							{
								$query = "select * from logindetails where id = '$user_id' limit 1";
								$result = mysqli_query($con, $query);

								if($result)
								{
									if ($result && mysqli_num_rows($result) > 0)
									{
										$password = $_POST['pw'];
										$user_data = mysqli_fetch_assoc($result);

										// if password is correct deletes account, vehicles, bookings
										if(password_verify($password, $user_data['password']))
										{
											$user_data = check_login($con);
											$sql = "delete from customerdetails where user_id = '$user_id'";
											mysqli_query($con, $sql); 
											$sql = "delete from cars where user_id = '$user_id'";
											mysqli_query($con, $sql); 
											$sql = "delete from bookings where CustomerID = '$user_id'";
											mysqli_query($con, $sql); 
											$sql = "delete from logindetails where id = '$user_id'";
											mysqli_query($con, $sql); 
											echo "<script>window.open('http://localhost:81/my-app/Home.php')</script>";
										} else 
										{
											// echoes errors if found
											echo "<p id='deleteerror'> Incorrect Password </p>";
										}
									}
								}
							}
						?>
					</form>
				</div>
			</div>
		</div>


		<!-- webpage footer -->
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

				<!-- if the user is signed in, it displays the following links -->
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
