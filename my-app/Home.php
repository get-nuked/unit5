<?PHP

session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");

  $user_data = check_login($con);
  
  ?>
  <?PHP if(check_login($con) == "False") { ?>
    <div class="topnav">
            <a class="active" href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
            <a href="About.php">About</a>
            <a href="ContactUs.php">Contact Us</a>
            <a href="MOT.php">Book an MOT!</a>
            <a class="login" href="Login.php" style="float:right">Login</a>
        </div>
        
  <?PHP }else { ?>
    <div class="topnav">
      <a class="active" href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a href="ContactUs.php">Contact Us</a>
      <a href="MOT.php">Book an MOT!</a>
      <div class="dropdown" style="float:right">
        <button class="dropbtn">Account</button>
        <div class="dropdown-content">
          <a href="#"> Bookings </a>
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
  color: #191923;
  /* background-image: linear-gradient(to bottom right, #353d37 , #26240c); */
  
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

.home_box1 {
  height: 430px;
  padding: 50px;
  margin: 100px;
  background-color: #F0A202;
  border-radius: 10px;
  transition: 1s;
  border: 2px solid black;
  background-image: linear-gradient(to bottom right, #f58025, #F0A202);  
  box-shadow: rgba(138, 104, 37, 0.4) 5px 5px, rgba(138, 104, 37, 0.3) 10px 10px, rgba(138, 104, 37, 0.2) 15px 15px, rgba(138, 104, 37, 0.1) 20px 20px, rgba(138, 104, 37, 0.05) 25px 25px;
}



.home_logo_centre {
  margin: 0;
  position: absolute;
  top: 36%;
  left: 19%;
  transform: translate(-50%,-50%);
  transition: 1s;
}



.home_book {
  margin: 0;
  position: absolute;
  top: 32%;
  left: 69%;
  transform: translate(-50%,-50%);
}
.home_book_font {
  font-size: 350%;
  font-family: "Lucida Console", monospace;
  width: 1000;
}

.book_button {
  background-color: black;
  width: 400;
  border: 1px solid black;
  color: #F0A202;
  padding: 8px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 25px;
  font-family: 'Courier New', Courier, monospace;
  position: absolute;
  top: 90%;
  left: 18%;
  border-radius: 5px;
  transition: 0.5s;
}

.book_button:hover{
  background-color:#ffeecb;
  color: black;
  width: 410;
  border: 1px solid black;
  position: absolute;
  top: 90%;
  left: 17.5%;
  border-radius: 5px;
}

.home_box2 {
  height: 600px;
  padding: 50px;
  margin: 0px;
  background-color: wheat;
  transition: 1s;
}

.home_box2:hover {
  font-size: 103%;
  height: 625px;
}


.map_text1 {
  font-size: 250%;
  font-family: "Lucida Console", monospace;
  width: 350;
  position:absolute; 
  top: 90%;
  left: 14%;
  transform: translate(-50%,-50%);
}

.map_text2 {
  font-size: 150%;
  font-family: 'Courier New', Courier, monospace;
  width: 350;
  position:absolute;
  top: 110%;
  left:14%;
  transform: translate(-50%,-50%);
}

.home_box3 {
  display: block;
  height: 370px;
  padding: 45px;
  margin: 50px;
  background-color: #D95D39;
  border-radius: 10px;
  font-size: 90%;
  font-family: "Lucida Console", monospace;
  color: wheat;
  transition: 1s;
  border: 2px solid black;
}

.home_box3:hover {
  font-size: 120%;
  height: 385px;
}


div.gallery {
  margin: 0.25%;
  border: 8px solid wheat;
  display: inline-block;
  position: relative;


}

div.gallery:hover {
  border: 8px solid white;
  transition: 1s;
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



<div class="home_box1">
  <div class="home_logo_centre">
  <img src="images\SCOTT'S MOTs-logos_transparent.png" width = 550>
  </div>
  <div class="home_book">
    <div class="home_book_font">
    <p>Your MOT is in safe hands.</p>
    </div>
    <a href="MOT.php" class="book_button"> book yours now </a>
  </div>
</div>

<div class="home_box2">
  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2478.943118418686!2d-2.9875729233751103!3d51.587605871831556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4871e6c3d645d091%3A0xf7ccb47a03553e0d!2sScotts%20MOT%20Centre!5e0!3m2!1sen!2suk!4v1697219208885!5m2!1sen!2suk" style="border:0" align="right" height=600px width=1400px allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <div class = "map_text1">
    <p>Come and say hi!</p>
  </div>

  <div class = "map_text2">
    <p>Can't wait to take care of your car.</p>
    <p>We are based in Corporation Road, just outside of Maindee Primary School in Newport.</p>
  </div>
</div>

<div class="home_box3">
  <p>A snapshot of SCOTT'S MOTs...</p>
  <div class="gallery">
    <a target="_blank" href="images\img4.png">
      <img src="images\img4.png" height = 310>
    </a>
  </div>
  <div class="gallery">
    <a target="_blank" href="images\img5.png">
      <img src="images\img5.png" height = 310>
    </a>
  </div>
  <div class="gallery">
    <a target="_blank" href="images\img6.png">
      <img src="images\img6.png" height = 310>
    </a>
  </div>
  <div class="gallery">
    <a target="_blank" href="images\img7.png">
      <img src="images\img7.png" height = 310>
    </a>
  </div>
</div>


</body>

</html>
