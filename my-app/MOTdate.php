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
          <a href="#">Bookings</a>
          <a href="Logout.php"> Log Out </a>
        </div>
      </div>
    </div>

  
  <?PHP } ?>

<html>
<head>

<script type="text/JavaScript">
function myFunction()
{
  alert("Thanks for booking an MOT session with SCOTT'S MOTs. \n\nSee you soon :)");
}
</script>

<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
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

/* The dropdown container */
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
        display: inline-block;
        float: left;
      }

      .products{
        width: 400px;
        text-align: center;
        position: relative;
        display: inline-block;
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

.box1 {
  height: 600px;
  padding: 5%;
  margin: 5%;
  background-color:#15150f;
  border-radius: 40px;
  box-shadow:
      0 1px 1px hsl(0deg 0% 0% / 0.075),
      0 2px 2px hsl(0deg 0% 0% / 0.075),
      0 4px 4px hsl(0deg 0% 0% / 0.075),
      0 8px 8px hsl(0deg 0% 0% / 0.075),
      0 16px 16px hsl(0deg 0% 0% / 0.075);
  transition: 0.5s;
  box-shadow: rgba(44,44,38, 0.4) 10px 10px, rgba(44,44,38, 0.3) 20px 20px, rgba(44,44,38, 0.2) 30px 30px, rgba(44,44,38, 0.1) 40px 40px, rgba(44,44,38, 0.05) 50px 50px;
}

.box1:hover{
  box-shadow: rgba(67,67,62, 0.4) 15px 15px, rgba(67,67,62, 0.3) 30px 30px, rgba(67,67,62, 0.2) 45px 45px, rgba(67,67,62, 0.1) 60px 60px, rgba(67,67,62, 0.05) 75px 75px;
}


.calendar {
  position: absolute;
  top: 350px;
  left: 675px;
  transform: translate(-50%,-50%);
}

input[type = time], input[type = date]{
  height: 30px;
  width: 230px;
  background: #201f17;
  color: white;
  border-radius: 10px;
  font-size: 22px;
  font-family: century-gothic, sans-serif;
}

input[type = submit] {
  height: 45px;
  width: 250px;
  background: #eb5729;
  border-radius: 30px;
  font-size: 25px;
  font-family: century-gothic, sans-serif;
  transition: 1s;
}

input[type = submit]:hover {
  background-color: #FF4F58;
}

textarea {
  height: 90px;
  width: 400px;
  background: #201f17;
  color: white;
  border-radius: 10px;
  font-size: 22px;
  font-family: century-gothic, sans-serif;
}

.addinfo{
  position: absolute;
  top: 380px;
  left: 1610px;
  transform: translate(-50%,-50%);
}

.addinfotext1{
  position: absolute;
  top: 367.5px;
  left: 1150px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 25px;
  font-family: century-gothic, sans-serif;
  color: #DEDCD1;
}

.addinfotext2{
  position: absolute;
  top: 392.5px;
  left: 1150px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 15px;
  font-family: century-gothic, sans-serif;
  color: #DEDCD1;
}


.datetext {
  position: absolute;
  top: 350px;
  left: 335px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 25px;
  font-family: century-gothic, sans-serif;
  color: #DEDCD1;
} 

.time{
  position: absolute;
  top: 410px;
  left: 675px;
  transform: translate(-50%,-50%);
}

.timetext{
  position: absolute;
  top: 410px;
  left: 390px;
  transform: translate(-50%,-50%);
  line-height: 25px;
  text-decoration: none;
  font-size: 25px;
  font-family: century-gothic, sans-serif;
  color: #DEDCD1;
}

.title {
  position: absolute;
  top: 215px;
  left: 500px;
  transform: translate(-50%,-50%);
  font-size: 35px;
  font-family: century-gothic, sans-serif;
  color: white;
}

.cross {
  position: absolute;
  top: 200px;
  left: 90%;
  transform: translate(-50%,-50%);
}

.submit {
  position: absolute;
  top: 797.5px;
  left: 82.75%;
  transform: translate(-50%,-50%);
}

.back {
  position: absolute;
  top: 797.5px;
  left: 17.25%;
  transform: translate(-50%,-50%);
}

.pricetext {
  position: absolute;
  top: 600px;
  left: 390px;
  transform: translate(-50%,-50%);
  font-size: 30px;
  font-family: century-gothic, sans-serif;
  color: white;
}

.price{
  position: absolute;
  top: 600px;
  left: 1680px;
  transform: translate(-50%,-50%);
  font-size: 60px;
  font-family: century-gothic, sans-serif;
  color: wheat;
}

</style>

</head>

<body>
  <body style="background-color:#24231a">

  <div class = "box1">
    <div class = "datetext">
      <p> Select date </P>
    </div>

    <div class = "title">
      <h2>Book an Appointment</h2>
    </div>

    <div class = "cross">
      <a href = "Home.php"><img src="images/whitecross.png" width = 200px></a>
    </div> 

    <div class = "timetext">
      <p> time </p>
    </div>

    <div class = "addinfotext1">
      <p> additional info </p>
    </div>

    <div class = "addinfotext2">
      <p> (optional) </p>
    </div>

    <form method = "post">
      <div class = "time">
        <input type="time" id="time" name="time" min="09:00" max="18:00"/>
      </div>

      <div class = "calendar">
        <input type="date" id="date" name="date">
      </div>

      <div class = "addinfo">
        <textarea name=additional rows="5"></textarea>
      </div>

  

      <div class = "submit">
        <input type = "submit" name = "save" value = "Submit and Book" onclick="myFunction()">
          <?PHP
          date_default_timezone_set("Europe/London");
          $user_id = $_SESSION["id"];
          $reg = $_SESSION["reg"];
          $time = "12:00:00";
          $date = date("Y-m-d");
          $additional = "";

          if (isset($_POST) And isset($_POST['time'])){
            $time = $_POST['time'];
          }
          else{
            $time = "12:00:00";
          }

          if (isset($_POST) And isset($_POST['date'])){
            $date = $_POST['date'];
          }
          else{
            $date = date("Y-m-d");
          }

          if (isset($_POST) And isset($_POST['additional'])){
            $additional = $_POST['additional'];
          }
          else{
            $additional = "";
          }

          
        
          if(isset($_POST['save'])){
            $sql = "insert into bookings(CustomerID, Registration, BookedDate, BookedTime, Info) values('$user_id','$reg','$date', '$time', '$additional')";
            mysqli_query($con, $sql);
          } 
          
          ?>

        </input>
      </div>

    </form>

    <div class = "back">
      <form action = "MOT.php">
        <input type = "submit" value = "⇦   Go Back" />
      </form>
    </div>
    
    <?PHP 
    
    $sql = "select Type from cars where Registration = '$reg'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $body = $row['Type'];
    }

    $price = "";
    $sql = "select Price from priceestimate where Type = '$body'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $price = $row['Price'];
    }

    echo "<div class = 'pricetext'><p> Estimated cost :<p></div>";
    echo "<div class = 'price'><p> £ $price</p>"
    

    ?>
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
