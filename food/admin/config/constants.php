<?php

    // start session
    session_start();

    // create constant to store non repeating value
    define('SITEURL', 'http://localhost/food/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD,DB_NAME) or die(sqli_error()); // database connectiom
    $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error()); //select database
    // $conn = mysqli_connect("localhost","root","","food-order");
    //  if(!$conn){
    //     die("Connection failed");
    //  }
?>