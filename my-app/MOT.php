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
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
    <style>

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: #191923
        
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
        font-family: inherit; 
        margin: 0; 
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
        box-shadow: rgba(44,44,38, 0.4) 10px 10px, rgba(44,44,38, 0.3) 20px 20px, rgba(44,44,38, 0.2) 30px 30px, rgba(44,44,38, 0.1) 40px 40px, rgba(44,44,38, 0.05) 50px 50px;
        transition: 0.5s;
      }

      .box1:hover{
        box-shadow: rgba(67,67,62, 0.4) 15px 15px, rgba(67,67,62, 0.3) 30px 30px, rgba(67,67,62, 0.2) 45px 45px, rgba(67,67,62, 0.1) 60px 60px, rgba(67,67,62, 0.05) 75px 75px;
      }

      select {
        position: absolute;
        top: 390px;
        left: 720px;
        transform: translate(-50%,-50%);
        height: 30px;
        width: 230px;
        background: #201f17;
        color: white;
        border-radius: 10px;
        font-size: 22px;
        font-family: century-gothic, sans-serif;

      }

      option {
        background: #201f17;
        color: white;
        width: 2000px;
        border-radius: 10px;
        font-family: century-gothic, sans-serif;
      }

      .update {
        position: absolute;
        top: 390px;
        left: 925px;
        transform: translate(-50%,-50%);
      }

      #btn-1 {
        height: 28px;
        width: 150px;
        background: #F0A202;
        border-radius: 10px;
        font-size: 18px;
        font-family: century-gothic, sans-serif;
        transition: 0.5s;
      }

      #btn-1:hover {
        background: #F1C232;
      }

      .selectvehicletext {
        position: absolute;
        top: 390px;
        left: 403px;
        transform: translate(-50%,-50%);
        line-height: 25px;
        text-decoration: none;
        font-size: 25px;
        font-family: century-gothic, sans-serif;
        color: #DEDCD1;
      }

      input {
        height: 45px;
        width: 250px;
        background: #eb5729;
        border-radius: 30px;
        font-size: 25px;
        font-family: century-gothic, sans-serif;
        transition: 1s;
      }

      input:hover {
        background-color: #FF4F58;
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

      .vehicleinfo{
        position: absolute;
        top: 570px;
        left: 50%;
        transform: translate(-50%,-50%);
        height: 120px;
        width: 72%;
        padding: 50px;
        background-image: linear-gradient(to bottom right, #201f17, #2b2a1f);
        border: 3px solid #dadada;
        border-radius: 30px;
        margin: 5px;
        transition: 1s;
        box-shadow:
            0 1px 1px hsl(0deg 0% 0% / 0.075),
            0 2px 2px hsl(0deg 0% 0% / 0.075),
            0 4px 4px hsl(0deg 0% 0% / 0.075),
            0 8px 8px hsl(0deg 0% 0% / 0.075),
            0 16px 16px hsl(0deg 0% 0% / 0.075)
      }

      .vehicleinfo:hover{
        height:130px;
      }

      table {
        font-size: 40px;
        font-family: "Courier New", monospace;
        color: white;
        font-weight: bold;
        width: 100%;
        height: 130px;
        text-align: center;
      }

      th {
        font-size: 20px;
        font-family: "Courier New", monospace;
        color: #DEDCD1;
        width: 200px; 
        height: 50px;

      }

      .continue {
        position: absolute;
        top: 806px;
        left: 82.7%;
        transform: translate(-50%,-50%);
      }

      .cross {
        position: absolute;
        top: 200px;
        left: 90%;
        transform: translate(-50%,-50%);
      }

      .welcome {
        position: absolute;
        top: 340px;
        left: 345px;
        transform: translate(-50%,-50%);
        line-height: 25px;
        text-decoration: none;
        font-size: 27px;
        font-family: century-gothic, sans-serif;
        color: #DEDCD1;
      }

      .morris {
        position: absolute;
        top: 320px;
        left: 65%;
        transform: translate(-50%,-50%);
        transform: rotate(4deg);
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
      <div class = "title">
        <h2>Book an Appointment</h2>
      </div>

      <div class = "cross">
        <a href = "Home.php"><img src="images/whitecross.png" width = 200px></a>
      </div> 

      <div class = "morris">
        <img src = "images\car7.png" height = 150px>
      </div>

      <div class = "continue">
        <form action="MOTdate.php">
          <input type="submit" value="Continue   ⇨"  />
        </form>
      </div> 

      <div class = "welcome">
        <?PHP
          $_SESSION;
          $user_data = check_login($con);
          $user_id = $_SESSION["id"];  

          $sql = "SELECT FirstName FROM customerdetails WHERE CustomerID = '$user_id'";
          $result = $con->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "Hello $row[FirstName]!";
          }     

        ?>
      </div>

      <div class = "selectvehicletext">
        <p>Choose your vehicle :</p>
      </div>

      <form method = "post">
        <div class="vehicledropdown">
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
              
              if (isset($_POST) And isset($_POST['vehicle_selected'])){
                $reg = $_POST['vehicle_selected'];
                $_SESSION['reg'] = $reg;
                echo "<option selected>$reg</option>";
              }
            ?>

          </select>

          <div class = "update">
            <!-- <input type = "submit" value = "update"> -->
            <button id="btn-1">get details</button>
          </div>
        </div>
      </form>

      <div class = "vehicleinfo">
        <?PHP
          if (isset($_SESSION) And isset($_SESSION['reg'])){
            $reg = $_SESSION['reg'];
            $_SESSION["reg"] = $reg;
          }
          else{
            $reg = 0;
            $_SESSION["reg"] = $reg;
          }

          $sql = "select Make, Model, ModelYear, Colour from cars where Registration = '$reg'";
          $result = mysqli_query($con, $sql); 

          while ( $db_field = mysqli_fetch_assoc($result) ) {
            echo "<table>
              <tr>
              <th>Make</td>
              <th>Model</td>
              <th>Model Year</td>
              <th>Colour</td>
              </tr>
              <tr>
              <td>$db_field[Make]</td>
              <td>$db_field[Model]</td>
              <td>$db_field[ModelYear]</td>
              <td>$db_field[Colour]</td>
              </tr></div>";
          } 
        ?>
      </div>
    </div>

    

    

  </body>
</html>
