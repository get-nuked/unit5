<?PHP
session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");
  
  if(check_login($con) == "False") { 
?>

    <div class="topnav">
      <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a class="active" href="ContactUs.php">Contact Us</a>
      <a href="MOT.php">Book an MOT!</a>
      <a class="login" href="Login.php" style="float:right">Login</a>
    </div>

<?PHP 
  } else { 
?>
    <div class="topnav">
      <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a class="active" href="ContactUs.php">Contact Us</a>
      <a href="MOT.php">Book an MOT!</a>
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
  
<?PHP 
  } 
?>


<html>
  <head>
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
    <link href='https://fonts.googleapis.com/css?family=Comic Neue' rel='stylesheet'>
    <style>

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: #191923
      }

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
        0 16px 16px hsl(0deg 0% 0% / 0.075);
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

      .title {
        position: relative;
        margin-top:100px;
        margin-left: 9%;
        font-size: 30px;
        font-family: century-gothic, sans-serif;
        color: #d2b48c;
      }

      #carimg1 {
        height: 150px;
        position: absolute;
        top: 60px;
        left: 77.5%;
        transform: translate(-50%,-50%);
      }

      .map iframe{
        height: 90%;
        width: 90%;
        border-radius: 20px;
        margin-left: 5%;
        margin-bottom: 50px;
      }

      .info {
        width: 100%;
        display: flex;
      }
      .address {
        flex: 1;
        width: 31%;
        height: 500px;
        position: relative;
        border-radius: 20px;
        margin-top: 30px;
        margin-bottom: 80px;
        margin-left: 5%;
        margin-right: 1.5%;
        float: left;
        transition: 1s;
      }

      .address img {
        height: 500px;
      }

      .address p {
        font-size: 27.5px;
        font-weight: bold;
        font-family: "Comic Sans", "Comic Neue", sans-serif;
        position: absolute;
        margin-top: 250px;
        top: 0%;
        left: 50%;
        transform: translate(-50%,-50%);
      }

      .phone {
        flex: 2;
        width: 61%;
        height: 500px;
        position: relative;
        border-radius: 20px;
        margin-top: 30px;
        margin-bottom: 80px;
        margin-left: 1.5%;
        margin-right: 5%;
        float: right;
        transition: 1s;
        background-color: #d8613c ;
      }

      .phone img {
        position: absolute;
        margin-left: 50px;
        margin-top: 275px;
      }

      .phone h4 {
        position: absolute;
        margin-left: 75px;
        margin-top: 70px;
        font-size: 45px;
        font-family: century-gothic, sans-serif;
        color: black;
      }

      .details {
        height: 410px;
        margin-left: 57.5%;
        width: 100px;
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-50%,-50%);
      }

      .details img {
        position: relative;
        margin-top: 50px;
      }

      .detailstext {
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-50%,-50%);
        margin-left: 80%;
      }

      .detailstext p {
        line-height: 65px;
        font-size: 25px;
        font-family: century-gothic, sans-serif;
        color: black;
      }

    </style>
  </head>

  <body>
    
    <body style="background-color:#24231a">

    <div class = "title">
      <h1>Contact Us</h1>
      <img id = "carimg1" src= "images/car1.png">
    </div>

    <div class = "map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9915.77246752687!2d-2.984998!3d51.5876059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4871e6c3d645d091%3A0xf7ccb47a03553e0d!2sScotts%20MOT%20Centre!5e0!3m2!1sen!2suk!4v1705248160984!5m2!1sen!2suk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class = "info">
      <div class = "address">
        <img src = "images\speach.png">
        <p> 34 Corporation Road, <br> Newport, <br> Gwent, <br> NP19 0BH. </p>
      </div>

      <div class = "phone">
        <img src = "images\car4.png" height= 200px>
        <h4> Contact Details </h4>
        <div class = "details">
          <img src = "images\phone.png" height = 40px>
          <img src = "images\mail.png" height = 40px>
          <img src = "images\instagram.png" height = 40px>
          <img src = "images\x.png" height = 40px>
        </div>
        <div class = "detailstext">
          <p> 01633842922 </p>
          <p> sales@scottsmotcentre.co.uk  </p>
          <p> @scottsmots </p>
          <p> @scottsmots </p> 
        </div>
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
