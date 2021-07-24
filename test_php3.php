<?php

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
	$output = "";
	$sql = "SELECT * FROM text_users_msg WHERE (sender = '".$fromUser."' AND receiver = '".$toUser."') OR (sender = '".$toUser."' AND receiver = '".$fromUser."')";
	$query = mysqli_query($db, $sql);

	while($row = mysqli_fetch_assoc($query)){
		if($row['sender'] == $fromUser){
			$output .= '<div style="text-align: right;">
				<p style="background-color:red; word-wrap:break-word;display:inline-block;
				padding:5px;border-radius:5px;max-width:70%;">
				'. $row['msg'] .'
				</p>
			</div>';
		}
		else{
			$output .= '<div style="text-align: left;">
				<p style="background-color:blue; word-wrap:break-word;display:inline-block;
				padding:5px;border-radius:5px;max-width:70%;">
				'. $row['msg'] .'
				</p>
			</div>';
		}
	}
	echo $output;
?>