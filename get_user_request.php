<?php
	session_start();
	include_once("db_connection.php");
	$output = "";

	$sender = $_SESSION['id'];
	$receiver = $_POST['toUser'];
	
	$pending = 0;


	if($sender && $receiver){
		$sql1 = "SELECT * FROM add_friends WHERE send_req = '$sender' AND receive_req = '$receiver'";
		$query1 = mysqli_query($db, $sql1);

		$sql2 = "SELECT * FROM add_friends WHERE send_req = '$receiver' AND receive_req = '$sender'";
		$query2 = mysqli_query($db, $sql2);


		if(mysqli_num_rows($query1) == 0){
			if(mysqli_num_rows($query2)){
				mysqli_query($db, "UPDATE add_friends SET pending = '0' WHERE send_req = '$receiver'");
				mysqli_query($db, "UPDATE add_friends SET confirmed = '1' WHERE send_req = '$receiver'");
			}
			if(mysqli_num_rows($query2) == 0){
				$pending = 1;
				mysqli_query($db, "INSERT INTO add_friends (send_req, receive_req, pending) VALUES ('$sender','$receiver','$pending')");
				$output .= '<img width="35px" src="./images/pending_add_friends.png"></img>';
			}
		}
	}
	
	echo $output;

?>