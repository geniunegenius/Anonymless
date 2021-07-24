<?php
	session_start();
	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	$username = $_SESSION['username'];

	$pref_db = "";

	$sql = "SELECT * FROM login_info_users WHERE username = '$username'";
	$query = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($query);

	$id_user = $row['id'];
	$pref = $_POST['pref'];
	$pref_db = $row['pref'];

	$new_string = "";

	$substring = "";

	while($pref_db){
		$substring = substr($pref_db, 0, strpos($pref_db, ';'));
		if($substring != $pref){
			$new_string .= $substring . ";";
		}
		$pref_db = str_replace($substring.";", "", $pref_db);
		$substring = "";
	}

	$sql = "UPDATE login_info_users SET pref = '$new_string' WHERE id = '$id_user'";
	mysqli_query($db, $sql);
?>