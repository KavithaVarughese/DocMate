<?php
	include_once("header.php");

	if(!isloggedin())
    {
        header("Location: login.php");
    }
    
    $sql = "DELETE FROM treatment ORDER BY tid DESC LIMIT 1";
  	$conn->query($sql) or die("didnt delete");


	header("Location:patient.php");
?>