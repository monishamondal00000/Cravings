<?php 
    if(!isset($_SESSION['user']))
    {
        if(isset($_SESSION['password']))
        {
            $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access.</div>";
            header("location:login.php");
        }
    }
?>