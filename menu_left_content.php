<?php
	session_start();
	include("db_connection.php");

	$current_username = $_SESSION['username'];

	$sql_curr = "SELECT id FROM login_info_users WHERE username='$current_username'";
	$query_curr = mysqli_query($db, $sql_curr);
	$x = mysqli_fetch_assoc($query_curr);
	$id_current_user = $x['id'];

	$ok = 0;

	$sql = "SELECT * FROM add_friends WHERE receive_req = '$id_current_user'";
	$query = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($query)){

		$sql2 = "SELECT * FROM login_info_users";
		$query2 = mysqli_query($db, $sql2);

		if($row['pending'] == 1){
			$id_sender = $row['send_req'];

			$sql2 = "SELECT * FROM login_info_users WHERE id = '$id_sender'";
			$query2 = mysqli_query($db, $sql2);
			$row2 = mysqli_fetch_assoc($query2);

			$username_sender = $row2['username'];

			echo '<a class="menu_left_button" id="menu_left_button" href="?toUser='. $row2['id'] .'">';
				echo '<div class="menu_left_users2">';
					echo $username_sender . '<br>';
						echo '<span class="menu_left_content_mess">';
							echo $username_sender . ': I want to be friends!';
						echo '</span>';
				echo '</div>';
			echo '</a>';
			$ok = 1;
		}
	}

	$sql = "SELECT * FROM add_friends WHERE send_req = '$id_current_user'";
	$query = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($query)){
		if($row['pending'] == 1){
			$id_receiver = $row['receive_req'];

			$sql2 = "SELECT * FROM login_info_users WHERE id = '$id_receiver'";
			$query2 = mysqli_query($db, $sql2);
			$row2 = mysqli_fetch_assoc($query2);

			$username_receiver = $row2['username'];

			echo '<a class="menu_left_button" id="menu_left_button" href="?toUser='. $row2['id'] .'">';
				echo '<div class="menu_left_users2">';
					echo $username_receiver . '<br>';
						echo '<span class="menu_left_content_mess">';
							echo 'You: I want to be friends!';
						echo '</span>';
				echo '</div>';
			echo '</a>';
			$ok = 1;
		}
	}

	$sql = "SELECT * FROM add_friends WHERE (send_req = '$id_current_user' OR receive_req = '$id_current_user') AND confirmed = '1'";
	$query = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($query)){
		if($row['send_req'] == $id_current_user){
			$id_receiver = $row['receive_req'];

			$sql2 = "SELECT * FROM login_info_users WHERE id = '$id_receiver'";
			$query2 = mysqli_query($db, $sql2);
			$row2 = mysqli_fetch_assoc($query2);

			$username_receiver = $row2['username'];

			$sql3 = "SELECT * FROM text_users_msg WHERE (sender = '$id_receiver' AND receiver = '$id_current_user') OR (sender = '$id_current_user' AND receiver = '$id_receiver') LIMIT 1";
			$query3 = mysqli_query($db, $sql3);
			
			if(mysqli_num_rows($query3) == 0){
				echo '<a class="menu_left_button" id="menu_left_button" href="?toUser='. $row2['id'] .'">';
					echo '<div class="menu_left_users2">';
						echo $username_receiver . '<br>';
							echo '<span class="menu_left_content_mess">';
								echo 'You and '.$username_receiver.' are now friends!';
							echo '</span>';
					echo '</div>';
				echo '</a>';
				$ok = 1;
			}
		}
		if($row['receive_req'] == $id_current_user){
			$id_receiver = $row['send_req'];

			$sql2 = "SELECT * FROM login_info_users WHERE id = '$id_receiver'";
			$query2 = mysqli_query($db, $sql2);
			$row2 = mysqli_fetch_assoc($query2);

			$username_receiver = $row2['username'];

			$sql3 = "SELECT * FROM text_users_msg WHERE (sender = '$id_receiver' AND receiver = '$id_current_user') OR (sender = '$id_current_user' AND receiver = '$id_receiver')";
			$query3 = mysqli_query($db, $sql3);

			if(mysqli_num_rows($query3) == 0){
				echo '<a class="menu_left_button" id="menu_left_button" href="?toUser='. $row2['id'] .'">';
					echo '<div class="menu_left_users2">';
						echo $username_receiver . '<br>';
							echo '<span class="menu_left_content_mess">';
								echo 'You and '.$username_receiver.' are now friends!';
							echo '</span>';
					echo '</div>';
				echo '</a>';
				$ok = 1;
			}
		}
	}

	$sql = "SELECT l.username, l.id
		FROM login_info_users as l
		LEFT JOIN text_users_msg AS m on l.id = m.receiver
		WHERE l.id != '$id_current_user'
		ORDER BY m.data DESC";

	$query = mysqli_query($db, $sql);
			  
	$username = "";
	$current_username = "";

	$array_username = [];
	$array_id = [];

	$k = 0;

	while($row = mysqli_fetch_assoc($query)){
		$username = $row['username'];
		if($current_username != $username){
			$ok2 = 1;
			$i = 0;
			while($i < count($array_username)){
				if($row['username'] == $array_username[$i])
				{
					$ok2 = 0;
				}
				$i = $i + 1;
			}
			if($ok2){
				$array_username[$k] = $row['username'];
				$array_id[$k] = $row['id'];
				$k = $k + 1;
			}
			$current_username = $username;
		}
	}

	$row = 0;
	/*while($i < count($array)){
		echo $array[$i] . '<br>';
		$i = $i + 1;
	}*/

	$key = 'qkwjdiw239&&jdafwesd3hnan&^%$ggdna$11#daAgeQ2Gbd`4Ds';

	function decryptthis($data, $key) {
		$encryption_key = base64_decode($key);
		list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	}

	while($row < count($array_username)){
		if($array_username[$row] != $current_username){
			$id = $array_id[$row];
			$sql2 = "SELECT * FROM text_users_msg WHERE (sender='$id' AND receiver='$id_current_user') OR (receiver='$id' AND sender='$id_current_user') ORDER BY id DESC";
			$query2 = mysqli_query($db, $sql2);
			$numRows = mysqli_num_rows($query2);
			$row_msg = mysqli_fetch_assoc($query2);

			if($numRows){
				$last_msg = decryptthis($row_msg['msg'], $key);
				$id_last_msg = $row_msg['sender'];
				echo '<a class="menu_left_button" id="menu_left_button" href="?toUser='. $id .'">';
					echo '<div class="menu_left_users2">';
						echo $array_username[$row] . '<br>';
							echo '<span class="menu_left_content_mess">';
							if(strlen($last_msg) >= 20){
								if($id_last_msg == $id_current_user){
									echo 'You: ' . substr($last_msg, 0, 20) . '...';
								}
								else{
									echo $array_username[$row] . ': ' . substr($last_msg, 0, 20) . '...';
								}
							}
							else{
								if($id_last_msg == $id_current_user){
									echo 'You: ' . $last_msg;
								}
								else{
									echo $array_username[$row] . ': ' . $last_msg;
								}
							}
							echo '</span>';
					echo '</div>';
				echo '</a>';
				$ok = 1;
			}
		}
		$row = $row + 1;
	}
	
	if($ok == 0){
		echo '<div class="menu_left_add_friends">';
		echo '<div class="menu_left_users">';
			echo 'Add some friends to chat!';
		echo '</div>';
		echo '</div>';
	}

?>