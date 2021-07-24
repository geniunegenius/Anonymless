<?php
	
	//database con
	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	$sql = "SELECT * FROM login_info_users WHERE ip = '$ip'";
	$query = mysqli_query($db, $sql);
	$numRows = mysqli_num_rows($query);
	$row = mysqli_fetch_assoc($query);
	if($numRows == 1 && $row['connected'] == 1){
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['ip'] = $row['ip'];
		$_SESSION['email'] = $row['email'];
		echo '<script>window.location.replace("chat_app.php");</script>';
	}
?>