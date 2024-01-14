<?PHP
  session_start();
  $_SESSION;
  $_error_message = "";
  include("Connection.php");
  include("Function.php");


  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //something was posted
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

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

              if($user_data['password'] === $password)
              {
                $_SESSION["id"] = $user_data["id"];
                header("Location: Home.php");
                die;
              }
          }
      }

      echo "wrong username or password";
      header("Loaction: Home.php");
      die;

    } else
    {
      echo "wrong username or password";
    }
  }

?>

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

      input[type=text], input[type=password] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
      }


      .container {
        z-index: 20000;
        margin: 100px;
        padding: 50px;
        background-color: #15140b;
        height: 63%;
        width: 18%;
        overflow: hidden;
        position:absolute; 
        top: 44%;
        left: 70%;
        transform: translate(-50%,-50%);
        border-radius: 35px;
        transition: 0.4s;
        box-shadow:
        0 1px 1px hsl(0deg 0% 0% / 0.075),
        0 2px 2px hsl(0deg 0% 0% / 0.075),
        0 4px 4px hsl(0deg 0% 0% / 0.075),
        0 8px 8px hsl(0deg 0% 0% / 0.075),
        0 16px 16px hsl(0deg 0% 0% / 0.075)
      }

      .container:hover {
        height: 63.5%;
        width: 18.25%;
      }

      .image{
        position: absolute; 
        top: 54%;
        left: 38%;
        transform: translate(-50%,-50%);  
      }

      img {
        border-radius: 35px 0px 0px 35px;
      }

      .username {
        height:20px;
        width: 600px;
        text-align: center;
        position: relative; 
        top: 61%;
        left: 50%;
        transform: translate(-50%,-50%);
      }

      input[type=text] {
        background-color: #19180f;
        color:#d4d3d2;
        font-family: "Helvetica", Sans-serif;
        font-size: 15px;
        border-radius: 17px;
      }

      .password {
        height:20px;
        width: 600px;
        text-align: center;
        position: relative; 
        top: 67%;
        left: 50%;
        transform: translate(-50%,-50%);
      }

      input[type=password] {
        background-color: #19180f;
        color:#d4d3d2;
        font-family: "Helvetica", Sans-serif;
        font-size: 15px;
        border-radius: 17px;
      }

      .submit_btn {
        height:20px;
        width: 300px;
        position: relative; 
        top: 77%;
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
        top: 87%;
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

      .logo{
        position: absolute; 
        top: 38%;
        left: 50%;
        transform: translate(-50%,-50%);
      }

      .welcometext{
        position: absolute; 
        top: 30%;
        left: 75%;
        transform: translate(-50%,-50%);
        color: #d4d3d2;
        font-family: century-gothic, sans-serif;
        font-size: 40px;
        z-index: 400000;
      }

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

    </style>
  </head>

  <body>

    <body style="background-image: url('https://graphicriver.img.customer.envatousercontent.com/files/246486475/preview.jpg?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=60996981f30a0d18587856b07f400b4c')">

    <div class = filter></div>

    <div class="topnav">
      <a href="Home.php"><img src="images\SCOTT'S MOTs-logos_simple.png" height=35px></a>
      <a href="About.php">About</a>
      <a href="ContactUs.php">Contact Us</a>
      <a href="MOT.php">Book an MOT!</a>
    </div>

    <form method="post">
      <div class="container">
        <div class="username">
          <input id = "text" type="text" placeholder="Username" name="user_name" required>
        </div> 

        <div class="password">
          <input id = "text" type="password" placeholder="Password" name="password" required>
        </div>
  
        <div class="submit_btn">
          <input id = "button" type="submit" value = "Login">
        </div> 
    
        <div class="logo">
          <img src="images\SCOTT'S MOTs-logos_simple2.png" width = 150>
        </div>

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
      <img src = "images\test2.jpg" height = 600>
    </div>
  
  </body>
</html>
