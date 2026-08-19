<?php
session_start();

// clears session variable valuyes for id and reg
if(isset($_SESSION['id']))
{
    unset($_SESSION['id']);
    unset($_SESSION["reg"]);
    unset($user_data);
}
header("Location: Home.php")
?>