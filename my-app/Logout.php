<?php
session_start();
if(isset($_SESSION['id']))
{
    unset($_SESSION['id']);
    unset($_SESSION["reg"]);
    unset($user_data);
}
header("Location: Home.php")
?>