<?php
    $dbhost = "localhost" ;
    $dbuser = "root" ;
    $dbpass = "root" ;
    $dbname = "scotts" ;

    if(!$con = mysqli_connect($dbhost, $dbuser ,$dbpass ,$dbname))
    {
        die("failed to connect!");
    }


?>