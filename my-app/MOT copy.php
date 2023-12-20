
      <?PHP
        session_start();
        $_SESSION;
        include("Connection.php");
        include("Function.php");

        $user_data = check_login($con);
        $user_id = $_SESSION["id"];   
        $sql = "SELECT Registration FROM cars WHERE user_id = '$user_id'";
       // $result = mysqli_query($con, $query);

        $result = $con->query($sql);
        while($row = $result->fetch_assoc()) {
           echo   $row["Registration"].  "<br>";
       }
       // print_r($result[0]);
       // $vehicles = mysqli_fetch_array($result);
      //  while($vehicles = mysqli_fetch_array($result)){
         // print_r($vehicles);
         // print($vehicles[1]);
         // print($vehicles[1]);
          echo"<br>";
       // }

      ?>






