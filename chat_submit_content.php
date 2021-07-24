<?php
	session_start();
	include("db_connection.php");

	$fromUser = $_SESSION['id'];
	$toUser = $_POST["toUser"];
	$message = $_POST["message"];

	$output = "";

	$key = 'qkwjdiw239&&jdafwesd3hnan&^%$ggdna$11#daAgeQ2Gbd`4Ds';


	$ok = 0;
	if(substr($message, 0, 8) == "<script>"){
		$ok = 1;
	}

	function encryptthis($data, $key) {
		$encryption_key = base64_decode($key);
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
		return base64_encode($encrypted . '::' . $iv);
	}

	$encrypted_message = encryptthis($message, $key);

	if($message && $ok == 0){
		$sql = "INSERT INTO text_users_msg (sender, receiver, msg) VALUES ('$fromUser','$toUser','$encrypted_message')";
	}
	if(mysqli_query($db, $sql)){
		$output = "";
	}
	else{
		$output = "Error. Please try again.";
	}

	echo $output;
	/*if(isset($_POST['submit_text'])){
		if($_POST['input_text']){
			$username = $_POST['session'];
			$sql = "SELECT id FROM login_info_users WHERE username='$username'";
			$query = mysqli_query($db, $sql);
			if(mysqli_num_rows($query) == 1){
				$row = mysqli_fetch_assoc($query);
				$id_sender = $row['id'];
			}
			$text = $_POST['input_text'];
			$id_receiver = $_GET['id_user'];
			$date = date("Y-m-d h:i:sa");
			mysqli_query($db , "INSERT INTO text_users_msg (sender , receiver, msg) VALUES ('$id_sender' , '$id_receiver', '$text')");
		}
	}*/
	

	
	
?>