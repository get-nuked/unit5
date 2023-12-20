<?PHP
session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");

  $user_data = check_login($con);
  
  if(check_login($con) == "False")
  {
    header("Location: Login.php");
  }

  ?>
  <?PHP if(check_login($con) == "False") { ?>
    <div class="topnav">
            <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
            <a href="About.php">About</a>
            <a href="ContactUs.php">Contact Us</a>
            <a class="active" href="MOT.php">Book an MOT!</a>
            <a class="login" href="Login.php" style="float:right">Login</a>
        </div>
  <?PHP }else { ?>
    <div class="topnav">
      <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a href="ContactUs.php">Contact Us</a>
      <a class="active" href="MOT.php">Book an MOT!</a>
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
 <script src = "calendar.js"></script>
 


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

.box1 {
  height: 800px;
  padding: 50px;
  margin: 100px;
  background-color: #524F3B;
  border-radius: 20px;
}

select {
  position: absolute;
  top: 350px;
  left: 750px;
  transform: translate(-50%,-50%);
  height: 30px;
  width: 200px;
  background: #7A7758;
  border-radius: 10px;
  font-size: 22px;
  font-family: "Lucida Console", monospace;

}

option {
  background: #7A7758;
  width: 2000px;
  border-radius: 10px;
  font-family: "Lucida Console", monospace;
}

.selectvehicletext {
  position: absolute;
  top: 350px;
  left: 400px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 23px;
  font-family: "Lucida Console", monospace;
  color: #DEDCD1;
}

.title {
  position: absolute;
  top: 22%;
  left: 22%;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 42px;
  font-family: "Lucida Console", monospace;
  color: white;
}

.calendar {
  position: absolute;
  top: 600px;
  left: 750px;
  transform: translate(-50%,-50%);
}

input {
  height: 30px;
  width: 200px;
  background: #7A7758;
  border-radius: 10px;
  font-size: 22px;
  font-family: "Lucida Console", monospace;
}

.datetext {
  position: absolute;
  top: 600px;
  left: 342px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 23px;
  font-family: "Lucida Console", monospace;
  color: #DEDCD1;
} 

.vehicleinfo {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}

.time{
  position: absolute;
  top: 650px;
  left: 750px;
  transform: translate(-50%,-50%);
}

.timetext{
  position: absolute;
  top: 650px;
  left: 390px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 23px;
  font-family: "Lucida Console", monospace;
  color: #DEDCD1;
}

</style>

<script>
  var now = new Date();
  var datetime = now.toLocaleString();
</script>
</head>


<body>

<body style="background-color:#24231a">

<div class = "box1">
  <div class="vehicledropdown">
    <form method = "get">
      <select name ="vehicle_selected">
        <?PHP
          $_SESSION;
          $user_data = check_login($con);
          $user_id = $_SESSION["id"];   
          $sql = "SELECT Registration FROM cars WHERE user_id = '$user_id'";

          $result = $con->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "<option value = '$row[Registration]'>$row[Registration]</option>";
          }            
        ?>
      </select>

      <input type = "submit" value = "update">

      <?php
      if (isset($_GET) And isset($_GET['vehicle_selected'])){
        $reg = $_GET['vehicle_selected'];
      }
      ?>

    </form>
  </div>

  <div class = "selectvehicletext">
    <p>Choose your vehicle</p>
  </div>

  <div class = "title">
    <p>Book an Appointment</p>
  </div>

  <div class = "calendar">
    <input type="date" id="date" name="data">
  </div>

  <div class = "datetext">
    <p> Select date </P>
  </div>

  <div class = "vehicleinfo">
    <?PHP
      $reg = $_GET['vehicle_selected'];
      $sql = "select Make, Model, ModelYear, Colour from cars where Registration = '$reg'";
      $result = mysqli_query($con, $sql); 

      while ( $db_field = mysqli_fetch_assoc($result) ) {

        print $db_field['Make'] . "<BR>";
        print $db_field['Model'] . "<BR>";
        print $db_field['ModelYear'] . "<BR>";
        print $db_field['Colour'] . "<BR>";
        
        }
        
    ?>
  </div>

  <div class = "timetext">
    <p> time </p>
  </div>

  <div class = "time">
    <input type="time" id="time" name="time" min="09:00" max="18:00" required />
  </div>
</div>

<div id="demo-booking-multiple"></div>



</body>






</body>

</html>
