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
      $query = "select * from users where user_name = '$user_name' limit 1";
        
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
      // $error_message = "wrong username or password";
      // header("Loaction: Home.php");
      // die;
      echo "wrong username or password";
      header("Loaction: Home.php");
      die;

    } else
    {
      //
      // for each($error as $err){
      //     echo "<div class='error'>".$err."</div>"; // changed to div to seperate lines
      // }
      // 
      echo "wrong username or password";
    }
  }

?>

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


input[type=text], input[type=password] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
}


.container {
  margin: 100px;
  padding: 50px;
  background-color: #15140b;
  height: 65%;
  width: 30%;
  padding: 50px;
  overflow: hidden;
  position:absolute; 
  top: 44%;
  left: 45%;
  transform: translate(-50%,-50%);
  border-radius: 15px;
  box-shadow: 0 4px 8px 0  #4f5237, 0 6px 20px 0 #40422e;
  transition: 1s;
}

.container:hover {
  height: 66%;
  width: 31%;
}

.username {
  height:20px;
  width: 100%;
  text-align: center;
  position: relative; 
  top: 57%;
  left: 50%;
  transform: translate(-50%,-50%);
}

input[type=text] {
  background-color: #19180f;
  color:#d4d3d2;
  font-family: "Lucida Console", monospace;
}

.password {
  height:20px;
  width: 100%;
  text-align: center;
  position: relative; 
  top: 63%;
  left: 50%;
  transform: translate(-50%,-50%);
}

input[type=password] {
  background-color: #19180f;
  color:#d4d3d2;
  font-family: "Lucida Console", monospace;
}

.submit_btn {
  height:20px;
  width: 300px;
  position: relative; 
  top: 73%;
  left: 50%;
  transform: translate(-50%,-50%);
  
}

#button {
  background-color: #e1ad01;
  border: 1px solid #e1ad01;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  font-family: "Lucida Console", monospace;
  font-size: 100%;
  border-radius: 10px;
  transition: 0.5s;
}

#button:hover {
  background-color: orangered;
  border: 1px solid white;
}

.signup {
  font-family: 'Courier New', Courier, monospace;
  font-size: 15;
  position: absolute; 
  top: 84%;
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
  top: 30%;
  left: 50%;
  transform: translate(-50%,-50%);
}

body {
    background: linear-gradient(-45deg, #332a1f, #24201a, #24231a, #23241a);
    background-size: 400% 400%;
    animation: gradient 20s ease infinite;
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


</style>
</head>


<body>
<body style="background-color:#26240c">
<!--Navigation Bar-->

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
      <img src="images\SCOTT'S MOTs-logos_white.png" width = 400>
    </div>

    <div class="signup">
      <a href="SignUp.php">Create an account</a>
    </div>

    <!-- <div class = "error_msg">
      <?php echo $error_message; ?>
    <!-- </div> --> 


  </div>

</form>

<div class="d-flex flex-column justify-content-center w-100 h-100"></div>

</div>


</html>
