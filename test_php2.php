<?php
	session_start();
  header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
  //or, if you DO want a file to cache, use:

	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	$fromUser = $_POST["fromUser"];
	$toUser = $_POST["toUser"];
	$message = $_POST["message"];

	$output = "";

	$sql = "INSERT INTO text_users_msg (sender, receiver, msg) VALUES ('$fromUser','$toUser','$message')";

	if(mysqli_query($db, $sql)){
		$output = "";
	}
	else{
		$output = "Error. Please try again.";
	}

	echo $output;


?>