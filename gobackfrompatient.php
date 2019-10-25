<?php
    include_once("header.php");

    if(!isloggedin())
    {
        header("Location: login.php");
    }

    unset($_SESSION["pid"]);
    unset($_SESSION["addsubmit"]);
    unset($_SESSION["searchsubmit"]);
    header("Location:index.php")
 ?>