<?PHP
  session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");

  $user_data = check_login($con);

  if(check_login($con) == "False") { 
?>

    <div class="topnav">
            <a class="active" href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
            <a href="About.php">About</a>
            <a href="ContactUs.php">Contact Us</a>
            <a href="MOT.php">Book an MOT!</a>
            <a class="login" href="Login.php" style="float:right">Login</a>
        </div>
        
<?PHP 
  }else { 
?>

    <div class="topnav">
      <a class="active" href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a href="ContactUs.php">Contact Us</a>
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
          <a href="#"> Bookings </a>
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

    <style>

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: #191923;
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

      .home_box1 {
        height: 430px;
        padding: 50px;
        margin: 97.5px;
        background-color: #F0A202;
        border-radius: 40px;
        transition: 0.75s;
        border: 2px solid black;
        background-image: linear-gradient(to bottom right, #f58025, #F0A202);  
        box-shadow: rgba(138, 104, 37, 0.4) 10px 10px, rgba(138, 104, 37, 0.3) 20px 20px, rgba(138, 104, 37, 0.2) 30px 30px, rgba(138, 104, 37, 0.1) 40px 40px, rgba(138, 104, 37, 0.05) 50px 50px;
      }

      .home_box1:hover {
        height: 435px;
        margin: 100px;
        box-shadow: rgba(138, 104, 37, 0.4) 15px 15px, rgba(138, 104, 37, 0.3) 30px 30px, rgba(138, 104, 37, 0.2) 45px 45px, rgba(138, 104, 37, 0.1) 60px 60px, rgba(138, 104, 37, 0.05) 75px 75px;
      }

      .home_logo_centre {
        margin: 0;
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        transition: 1s;
      }

      .home_book {
        margin: 0;
        position: absolute;
        top: 33%;
        left: 68%;
        transform: translate(-50%,-50%);
      }

      .home_book_font {
        font-size: 65px;
        font-family: century-gothic, sans-serif;
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
        top: 82%;
        left: 16%;
        border-radius: 5px;
        transition: 0.5s;
      }

      .book_button:hover{
        background-color:#ffeecb;
        color: black;
        width: 410;
        border: 1px solid black;
        position: absolute;
        top: 82%;
        left: 15.5%;
        border-radius: 5px;
      }

      .home_box2 {
        height: 600px;
        padding: 50px;
        margin: 0px;
        background-color: wheat;
        transition: 1s;
        box-shadow:
        0 1px 1px hsl(0deg 0% 0% / 0.075),
        0 2px 2px hsl(0deg 0% 0% / 0.075),
        0 4px 4px hsl(0deg 0% 0% / 0.075),
        0 8px 8px hsl(0deg 0% 0% / 0.075),
        0 16px 16px hsl(0deg 0% 0% / 0.075)
      }

      .home_box2:hover {
        font-size: 103%;
        height: 635px;
      }

      .home_box2 img {
        height: 25%;
        transform: rotate(2deg);
        margin-left: 130px;
        margin-top: 10px;
      }

      iframe {
        border-radius: 10px;
        height:100%;
        margin-right: 47.5px;
      }

      .map_text1 {
        font-size: 250%;
        font-family: century-gothic, sans-serif;
        width: 370;
        margin-top: 100px;
        margin-left: 5%;
        position: relative; 
      }

      .map_text2 {
        font-size: 150%;
        font-family: 'Courier New', Courier, monospace;
        width: 350;
        margin-top: 30px;
        margin-left: 5%;
        position: relative; 
        font-weight: 500;
      }

      .home_box3 {
        display: block;
        height: 365px;
        padding: 45px 45px 60px 45px;
        margin-top: 3%;
        margin-left: 97.5px;
        margin-right: 97.5px;
        /* background-color: #D95D39; */
        background-image: linear-gradient(to bottom right, #fa7b62, #fb8c4c);  
        border-radius: 10px;
        font-size: 90%;
        font-family: century-gothic, sans-serif;
        color: wheat;
        transition: 1s;
        border: 2px solid black;
        box-shadow:
        0 1px 1px hsl(0deg 0% 0% / 0.075),
        0 2px 2px hsl(0deg 0% 0% / 0.075),
        0 4px 4px hsl(0deg 0% 0% / 0.075),
        0 8px 8px hsl(0deg 0% 0% / 0.075),
        0 16px 16px hsl(0deg 0% 0% / 0.075);
        overflow: auto;
        overflow-y: hidden;
        white-space: nowrap;
      }

      .home_box3:hover {
        font-size: 120%;
        height: 370px;
        padding: 45px 45px 75px 45px;
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

      article {
        /*  leverage cascade for cross-browser gradients  */
        background: radial-gradient(
          hsl(420 100% 60%), 
          hsl(360 100% 60%) 
        ) fixed;
        background: conic-gradient(
          hsl(420 100% 60%), 
          hsl(350 100% 60%), 
          hsl(420 100% 60%) 
        ) fixed;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        block-size: 500px;
        inline-size: 96%;
        text-align: right;
        margin-top: 75px;
        margin-bottom: 75px;
      } 

      article h1, article p {
        margin: 0;
      }

      article h1 {
        font-size: 70px;
        line-height: 71px;
        /* max-inline-size: 60%; */
        margin-right: 2%;
        font-family: century-gothic, sans-serif;
        letter-spacing: 2px;
      }

      .text img {
        margin-left: 50px;
        margin-top: -575px;
        position: relative;
      }

      .gallery img {
        height: 310px;
      }

    </style>
  </head>

  <body>

    <body style="background-color:#24231a">
    
    <section>
      <div class="home_box1">
        <div class="home_logo_centre">
          <img src="images\SCOTT'S MOTs-logos_transparent.png" width = 550>
        </div>

        <div class="home_book">
          <div class="home_book_font">
            <h4>Your MOT is in safe hands.</h4>
          </div>
          <a href="MOT.php" class="book_button"> book yours now </a>
        </div>
      </div>
    </section>

    <section>
      <div class="home_box2">
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3297.128665969288!2d-2.987572923375108!3d51.587605871831556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4871e6c3d645d091%3A0xf7ccb47a03553e0d!2sScotts%20MOT%20Centre!5e1!3m2!1sen!2suk!4v1704387337150!5m2!1sen!2suk" style="border:0" align="right" height=600px width=1300px allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class = "map_text1">
          <p>Come and say hi!</p>
        </div>

        <div class = "map_text2">
          <p>Can't wait to take care of your car.</p>
          <p>We are based in Corporation Road, just outside of Maindee Primary School in Newport.</p>
        </div>

        <img src = "images\car5.png">
      </div>
    </section>

    <section>
      <div class="home_box3">
        <p>A snapshot of SCOTT'S MOTs...</p>
        <div class="gallery">
          <a target="_blank" href="images\img4.png">
          <img src="images\img4.png">
          </a>
        </div>
      
        <div class="gallery">
          <a target="_blank" href="images\img5.png">
          <img src="images\img5.png">
          </a>
        </div>

        <div class="gallery">
          <a target="_blank" href="images\img6.png">
          <img src="images\img6.png">
          </a>
        </div>

        <div class="gallery">
          <a target="_blank" href="images\img7.png">
          <img src="images\img7.png">
          </a>
        </div>
      </div>
    </section>

    <section>
      <div class = "text">
        <article>
          <h1>The Finest.</h1>
          <h1>Impeccable.</h1>
          <h1>Customer-Friendly.</h1>
          <h1>Perfection.</h1>
          <h1>Attention To Detail.</h1>
          <h1>Imcomperable.</h1>
          <h1>Customer Driven.</h1>
        </article>

        <img src = "images\morris2.png" height = 500px>
      </div>
    </section>

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
