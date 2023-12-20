<?PHP
session_start();
  $_SESSION;
  include("Connection.php");
  include("Function.php");


  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //something was posted
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    if(!empty($user_name) && !empty($password))
    {
        //save to database
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
        mysqli_query($con, $query);
        header("Location: Home.php");
        die;

    } else
    {
      echo "Please enter some valid information";
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


.container {
  margin: 100px;
  padding: 50px;
  background-color: wheat;
  height: 70%;
  width: 86%;
  padding: 50px;
  overflow: hidden;
  position:absolute; 
  top: 40%;
  left: 45%;
  transform: translate(-50%,-50%);
  border-radius: 15px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  transition: 1s;
}

.container:hover {
  height: 70%;
  width: 87%;
}

body {
    background: linear-gradient(-45deg, #fcc42c,#e1ad01, #FF8800, coral, hotpink);
    background-size: 400% 400%;
    animation: gradient 10s ease infinite;
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

.name {
  height:20px;
  width: 400px;
  position: relative; 
  top: 34%;
  left: 37%;
  transform: translate(-50%,-50%);
}

.phone {
  height:20px;
  width: 400px;
  position: relative; 
  top: 40%;
  left: 37%;
  transform: translate(-50%,-50%)
}

.username {
  height:20px;
  width: 400px;
  position: relative; 
  top: 46%;
  left: 37%;
  transform: translate(-50%,-50%)
}

input[type=text] {
  background-color: wheat;
  color: black;
  font-family: "Lucida Console", monospace;
  font-size: 18px;
  width:450px;
  height: 35px;
}

.password {
  height:20px;
  width: 400px;
  position: relative; 
  top: 52%;
  left: 37%;
  transform: translate(-50%,-50%)
}

input[type=password] {
  background-color: wheat;
  color: black;
  font-family: "Lucida Console", monospace;
  font-size: 18px;
  width: 450px;
  height: 35px;
}

.submit_btn {
  height:20px;
  width: 400px;
  position: relative; 
  top: 65%;
  left: 30%;
  transform: translate(-50%,-50%);
}

#button {
  background-color: #e1ad01;
  color: black;
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
  color: white;
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

.logo{
  position: absolute; 
  top: 50%;
  left: 80%;
  transform: translate(-50%,-50%);
}

.content{
  font-family: 'Courier New', Courier, monospace;
  font-size: 28px;
  position: absolute;
  top: 48%;
  left: 16%;
  transform: translate(-50%,-50%);
}

.title{
  font-family: "Lucida Console", monospace;
  font-size: 32px;
  position: absolute;
  top: 20%;
  left: 33%;
  transform: translate(-50%,-50%);
}

.cross{
  position: absolute;
  top: 6.5%;
  left: 97%;
  transform: translate(-50%,-50%);
}


</style>
</head>


<body>
<body style="background-color:#26240c">
<!--1f2a23-->
<!--Navigation Bar-->


<form method="post">

  <div class="container">
  <div class="name">
      <input type="text" placeholder="Full name" name="name" required>
    </div> 

    <div class="phone">
      <input type="text" placeholder="Contact No." name="phone" required>
    </div>

    <div class="username">
      <input type="text" placeholder="Username" name="user_name" required>
    </div> 

    <div class="password">
      <input type="password" placeholder="Password" name="password" required>
    </div>
    

    <div class="submit_btn">
      <input id = "button" type="submit" value = "Sign up">
    </div> 
    
    <div class="logo">
      <img src="images\SCOTT'S MOTs-logos_transparent.png" width=750px>
    </div>

    <div class="title">
      <h1>Never too late to sign up</h1>
    </div>

    <div class="content">
      <p>Full Name</p>
      <p>Contact Number</p>
      <p>Email</p>
      <p>Password</p>
    </div>

    <div class="cross">
      <a href = "Login.php"><img src = "images/cross.png" height = 60px></a>
    </div>

    



</body>

</html>
