<?php
	session_start();
	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	$current_username = $_SESSION['username'];
	$id_current_user = $_SESSION['id'];

	$output = "";

	$sql = "SELECT * FROM login_info_users WHERE username != '$current_username'";
	$query = mysqli_query($db, $sql);

	$ids = array();

	while($row = mysqli_fetch_assoc($query)){
		$id = $row['id'];
		$sql2 = "SELECT * FROM add_friends WHERE (send_req = '$id' AND receive_req = '$id_current_user') OR (send_req = '$id_current_user' AND receive_req = '$id') AND confirmed = '1'";
		$query2 = mysqli_query($db, $sql2);
		if(!mysqli_num_rows($query2)){
			$ids[] = $row['id'];
		}
	}

	$max = 0;
	$count = 0;

	foreach($ids as $k){
		$sql3 = "SELECT * FROM login_info_users WHERE id = '$k'";
		$query3 = mysqli_query($db, $sql3);
		$row_candidate = mysqli_fetch_assoc($query3);

		$sql4 = "SELECT * FROM login_info_users WHERE id = '$id_current_user'";
		$query4 = mysqli_query($db, $sql4);
		$row_session = mysqli_fetch_assoc($query4);

		//candidate
		$string = $row_candidate['pref'];
		$array_candidate = array();

		while($string){
			$substring = substr($string, 0, strpos($string, ';'));
			array_push($array_candidate, $substring);
			$string = str_replace($substring.";", "", $string);
			$substring = "";
		}

		//current
		$string = $row_session['pref'];
		$array_session = array();

		while($string){
			$substring = substr($string, 0, strpos($string, ';'));
			array_push($array_session, $substring);
			$string = str_replace($substring.";", "", $string);
			$substring = "";
		}

		$p = 0;
		foreach($array_candidate as $m){
			foreach($array_session as $n){
				if($m == $n){
					$p = $p + 1;
				}
			}
		}

		if($count == 0){
			$id_prob_max = $ids[array_rand($ids)];
			$prob = $p;
		}
		else{
			if($p > $max){
				$prob = $p;
				$id_prob_max = $k;
				$max = $p;
			}	
		}
		$count = $count + 1;
	}

	$user_chosen = "";

	$query3 = mysqli_query($db, $sql);

	while($row3 = mysqli_fetch_assoc($query3)){
		if($row3['id'] == $id_prob_max){
			$user_chosen = $row3['username'];
		}
	}

	$output .= '<a style="text-decoration:none; color:#d86c70;" href="?toUser='.$id_prob_max.'">';
	$output .= $user_chosen;
	$output .= '</a>';
	echo $output;

?>