<?php
	include_once("header.php");

	if(!isloggedin())
    {
        header("Location: login.php");
    }
    
    $sql = "DELETE FROM appointment WHERE patient_id = '{$_SESSION["pid"]}'";
  	$conn->query($sql) or die("didnt delete");

    $sql = "DELETE FROM treatment WHERE treat_id = '{$_SESSION["pid"]}'";
  	$conn->query($sql) or die("didnt delete");

  	$sql = "DELETE FROM ptable WHERE pid = '{$_SESSION["pid"]}'";
  	$conn->query($sql) or die("didnt delete");



	header("Location:index.php");
?>