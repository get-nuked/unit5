<?php
    function check_login($con)
    {
        // assigns array $user_data details about the user if signed in 
        if(isset($_SESSION['id']))
        {
            $id = $_SESSION['id'];
            $query = "select * from logindetails where id = '$id' limit 1";

            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }

        }

        //redirect to login
        return 'False';
        die;
    
    };
    
?>