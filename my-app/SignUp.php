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
    $repassword = $_POST["repassword"];
    $first = $_POST["firstname"];
    $last = $_POST["lastname"];
    $phone = $_POST["phone"];
    

    if(!empty($user_name) && !empty($password))
    {
        //save to database
        $empty = "";
        $query = "select * from logindetails where user_name = '$user_name'";
        $result = mysqli_query($con, $query);
        while($row = $result->fetch_assoc()) {
          $empty = $row['user_name'];
        }     
        if ($empty == "" && $password = $repassword){
          $query = "insert into logindetails (user_name, password, Admin) values ('$user_name','$password', 0)";
          mysqli_query($con, $query);
          $query = "select id from logindetails where user_name = '$user_name'";
          $result = mysqli_query($con, $query);
          while($row = $result->fetch_assoc()) {
            $user_id = $row['id'];
          }     
          $query = "insert into customerdetails (CustomerID, FirstName, LastName, Phone) values ('$user_id','$first','$last' ,'$phone')";
          mysqli_query($con, $query);
          header("Location: Login.php");
        }

        if($password !== $repassword){
          // header("Location: Signup.php");
          echo "<div class = 'error'><p> passwords do not match. </p></div>";
        }

        if($empty !== ""){
          // header("Location: Signup.php");
          echo "<div class = 'error'><p> account exists. </p></div>";
        }


        die;

    } else
    {
      echo "Please enter some valid information";
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


.container {
  margin: 100px;
  padding: 50px;
  background-color: wheat;
  height: 70%;
  width: 86%;
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
  width: 86.5%;
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

.firstname {
  height:20px;
  width: 400px;
  position: relative; 
  top: 34%;
  left: 37%;
  transform: translate(-50%,-50%);
}

.lastname {
  height:20px;
  width: 400px;
  position: relative; 
  top: 38%;
  left: 37%;
  transform: translate(-50%,-50%);
}

.phone {
  height:20px;
  width: 400px;
  position: relative; 
  top: 42%;
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
  font-family: century-gothic, sans-serif;
  font-size: 18px;
  width:450px;
  height: 35px;
  border-radius: 5px;
}

.password {
  height:20px;
  width: 400px;
  position: relative; 
  top: 50%;
  left: 37%;
  transform: translate(-50%,-50%)
}

.repassword {
  height:20px;
  width: 400px;
  position: relative; 
  top: 54%;
  left: 37%;
  transform: translate(-50%,-50%)
}

input[type=password] {
  background-color: wheat;
  color: black;
  font-family: century-gothic, sans-serif;
  font-size: 18px;
  width: 450px;
  height: 35px;
  border-radius: 5px;
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
  font-family: century-gothic, sans-serif;
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

.text1{
  font-family: 'Courier New', Courier, monospace;
  font-size: 28px;
  position: absolute;
  top: 37%;
  left: 16%;
  transform: translate(-50%,-50%);
}

.text2{
  font-family: 'Courier New', Courier, monospace;
  font-size: 28px;
  position: absolute;
  top: 49%;
  left: 16%;
  transform: translate(-50%,-50%);
}

.text3{
  font-family: 'Courier New', Courier, monospace;
  font-size: 28px;
  position: absolute;
  top: 55%;
  left: 16%;
  transform: translate(-50%,-50%);
}

.text4{
  font-family: 'Courier New', Courier, monospace;
  font-size: 28px;
  position: absolute;
  top: 61%;
  left: 16%;
  transform: translate(-50%,-50%);
}

.title{
  font-family: century-gothic, sans-serif;
  font-size: 32px;
  position: absolute;
  top: 20%;
  left: 28%;
  transform: translate(-50%,-50%);
}

.cross{
  position: absolute;
  top: 6.5%;
  left: 97%;
  transform: translate(-50%,-50%);
}

.error{
  font-family: 'Courier New', Courier, monospace;
  font-size: 15;
  position: absolute; 
  top: 80%;
  left: 50%;
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
    <div class="firstname">
      <input type="text" placeholder="First Name" name="firstname" required>
    </div>
    
    <div class="lastname">
      <input type="text" placeholder="Last Name" name="lastname" required>
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

    <div class="repassword">
      <input type="password" placeholder="Re-Enter Password" name="repassword" required>
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

    <div class="text1">
      <p>Full Name</p>
    </div>
    
    <div class="text2">
      <p>Contact Number</p>
    </div>

    <div class="text3">
      <p>Email</p>
    </div>

    <div class="text4">
      <p>Password</p>
    </div>
    
    <div class="cross">
      <a href = "Login.php"><img src = "images/cross.png" height = 60px></a>
    </div>
  </div>

</form>    



</body>

</html>
