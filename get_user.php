<?php
	session_start();
	include("db_connection.php");
	$k = 0;
	$output = "";

if($_POST['name'])
{
	$sql = "SELECT * FROM login_info_users WHERE username LIKE '%" . $_POST['name'] . "%'";
	$array = mysqli_query($db,$sql);
	foreach($array as $key){
		if($_SESSION['username'] != $key['username']){
			$output .= '<div id="user"> 
				<div style="width:75%;">
					<a title="Chat with '.$key['username'].'" href="./chat_app.php?toUser='.$key['id'].'" style="font-size:1em;text-decoration:none;color:#d86c70;margin:0 0 5 0;"> '. $key['username']. ' </a>
				</div>
			</div>';
		}
		
		$k = $k + 1;
	}
}

if($k == 0 && $_POST['name']){
	$output = '<div id="user"> No user found. </div>';
}
else{
	if($k == 0 && $_POST['name'] == "")
		$output = '<script>document.getElementById("search_result").style.borderBottom = "0px solid";</script>';
}

echo $output;

?>
