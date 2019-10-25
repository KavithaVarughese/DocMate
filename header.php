<?php 
    session_start();
    //for debugging
    ini_set("log_errors", 1);
    ini_set("error_log", "log.txt");

    //mysql connection settings
    $user = "root";
    $pass = "Oh!DraconianDevil";
    $ser = "127.0.0.1";
    $db = "ecom";

    $conn = new mysqli($ser, $user, $pass, $db);

    if($conn->connect_error)
    {
        die("Database Connection failed" . $conn->connect_error);
    }

    include_once("db.php");

    function isloggedin()
    {
        return isset($_SESSION["username"]);
    }
?>