<?PHP
session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");

  ?>
  <?PHP if(check_login($con) == "False") { ?>
    <div class="topnav">
            <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
            <a class="active" href="About.php">About</a>
            <a href="ContactUs.php">Contact Us</a>
            <a href="MOT.php">Book an MOT!</a>
            <a class="login" href="Login.php" style="float:right">Login</a>
        </div>
  <?PHP }else { ?>
    <div class="topnav">
      <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a class="active" href="About.php">About</a>
      <a href="ContactUs.php">Contact Us</a>
      <a href="MOT.php">Book an MOT!</a>
      <div class="dropdown" style="float:right">
        <button class="dropbtn">Account</button>
        <div class="dropdown-content">
          <a href="#">Bookings</a>
          <a href="Logout.php"> Log Out </a>
        </div>
      </div>
    </div>
  
  <?PHP } ?>

<html>
<head>

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  color: #191923
  
}

.topnav {
  /* background-color: #556b2f; */
  background-color: #191708;
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
  height: 30px;
  line-height: 25px;
  text-decoration: none;
  font-size: 20px;
  font-family: "Lucida Console", monospace;
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

/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
  z-index : 2000;
}

/* Dropdown button */
.dropdown .dropbtn {
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
  font-family: "Lucida Console", monospace;
  transition: 0.7s;
  z-index : 2000;
  display: flex;
  
}

/* Add a red background color to navbar links on hover */
.dropdown:hover .dropbtn {
  background-color: #80965a;
  color: black;
  height: 60px;
  line-height: 35px;
  text-decoration: none;
  font-size: 23px;
  z-index : 2000;
  
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 2000;
  width:200px;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  z-index : 2000;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
  z-index : 2000;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
  z-index : 2000;
}





</style>
</head>


<body>
<body style="background-color:#24231a">
<!--1f2a23-->
<!--Navigation Bar-->






</body>

</html>
