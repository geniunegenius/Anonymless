<?php
	session_start();
	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	$fromUser = $_SESSION['id'];
	$toUser = $_POST["toUser"];
	$output = "";
	
	$key = 'qkwjdiw239&&jdafwesd3hnan&^%$ggdna$11#daAgeQ2Gbd`4Ds';

	function decryptthis($data, $key) {
		$encryption_key = base64_decode($key);
		list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	}

	if($fromUser != $toUser){
		$sql = "SELECT * FROM text_users_msg WHERE (sender = '".$fromUser."' AND receiver = '".$toUser."') OR (sender = '".$toUser."' AND receiver = '".$fromUser."')";
		$query = mysqli_query($db, $sql);
		$numRows = mysqli_num_rows($query);
		
		$right = 0;
		$left = 0;

		$pos = "";

		$last_div = 0;
		$last_div_id = "";
		$date_counter = 0;

		while($row = mysqli_fetch_assoc($query)){
			$last_div = $last_div + 1;
			$date_db = $row['data'];
			$format = 'Y-m-d h:i:sa';
			$date = new DateTime($date_db);
			$time = $date->format('h:i A');

			$dateToday = date('d');
			$dateMonth = date('m');
			$dateYear = date('Y');

			$calendar = $date->format('d.m.y');

			$date_counter2 = $date->format('d');
			$date_counter3 = $date->format('m');
			$date_counter4 = $date->format('Y');

			$ifnot = 0;

			//echo '<input id="data" type="text" value="'.$date->format('d').'" hidden> </input>';


			//date in conversations
			if($date_counter != $date_counter2){
				$diffofday = $dateToday - $date_counter2;
				if($diffofday < 0){
					$l = date("t", strtotime($date_db));
					$l2 = $l + $diffofday;
					$diffofday = $l2 + 1;
				}
				$diffofmonth = $dateMonth - $date_counter3;
				$diffofyear = $dateYear - $date_counter4;
				if($diffofday > 7 || $diffofmonth != 0 || $diffofyear != 0){
					$output .= '<div class="calendar">
						<div class="container_calendar">
							<p class="centered_text"><span class="centered_text">'.$calendar.'</span></p>
						</div>
					</div>';
					$ifnot = 1;
				}
				if($diffofday == 0 && $diffofmonth == 0 && $diffofyear == 0){
					$output .= '<div class="calendar">
						<div class="container_calendar">
							<p class="centered_text"><span class="centered_text">Today</span></p>
						</div>
					</div>';
					$ifnot = 1;
				}
				if($diffofday == 1 && $diffofmonth == 0 && $diffofyear == 0){
					$output .= '<div class="calendar">
						<div class="container_calendar">
							<p class="centered_text"><span class="centered_text">Yesterday</span></p>
						</div>
					</div>';
					$ifnot = 1;
				}
				if($ifnot == 0){
					$timestamp = new DateTime($date->format('y-m-d'));
					$day = $timestamp->format('l');
					$output .= '<div class="calendar">
						<div class="container_calendar">
							<p class="centered_text"><span class="centered_text">'.$day.'</span></p>
						</div>
					</div>';
				}
				
				$date_counter = $date_counter2;
			}

			$message = $row['msg'];
			$decrypted_message = decryptthis($message, $key);

			if($last_div == $numRows){
				$last_div_id = "last";
			}

			if($row['sender'] == $fromUser){
				if($right == 0){
					$pos = "right";
					$right = 1;
					$left = 0;
				}
				else{
					$pos = "right_next";
				}

				$output .= '<div class="msg_container_right" id="'.$last_div_id.'">
					<div class="'.$pos.'" id="'.$last_div_id.'">
					'. $decrypted_message .'
					<p class="time_right">'. $time .'</p>
					</div>

				</div>';
			}
			else{
				if($left == 0){
					$pos = "left";
					$left = 1;
					$right = 0;
				}
				else{
					$pos = "left_next";
				}

				$output .= '<div class="msg_container_left" id="'.$last_div_id.'">
					<div class="'.$pos.'" id="'.$last_div_id.'">
					'. $decrypted_message .'
					<p class="time_left">'. $time .'</p>
					</div>
					<!--<button class="button_chat_left content_left"></button>-->
				</div>';
			}
		}

		if($output != ""){
			echo $output;
		}
		else{
			$current_id = $_SESSION['id'];

			$sql3 = "SELECT * FROM add_friends WHERE ((send_req = '$fromUser' AND receive_req = '$toUser') OR (send_req = '$toUser' AND receive_req = '$fromUser')) LIMIT 1";
			$query3 = mysqli_query($db, $sql3);
			$row3 = mysqli_fetch_assoc($query3);

			$sql2 = "SELECT * FROM login_info_users WHERE id = '$toUser'";
			$query2 = mysqli_query($db, $sql2);
			$row2 = mysqli_fetch_assoc($query2);

			if(mysqli_num_rows($query3) == 0){
				$output .= '<div class="calendar">
					<div class="container_calendar">
						<p class="centered_text"><span class="centered_text">Add '.$row2['username'].' as friend!</span></p>
					</div>
				</div>';
			}
			else{
				if($row3['confirmed']){
					$output .= '<div class="calendar">
						<div class="container_calendar">
							<p class="centered_text"><span class="centered_text">You can chat with '.$row2['username'].' now</span></p>
						</div>
					</div>';
				}
				else{
					if($fromUser == $row3['send_req']){
						$output .= '<div class="calendar">
							<div class="container_calendar">
								<p class="centered_text"><span class="centered_text">Friend request send for '.$row2['username'].'</span></p>
							</div>
						</div>';
					}

					if($fromUser == $row3['receive_req']){
						$output .= '<div class="calendar">
							<div class="container_calendar">
								<p class="centered_text"><span class="centered_text">Friend request received from '.$row2['username'].'</span></p>
							</div>
						</div>';
					}
				}
			}
			echo $output;
		}
	}

	/*$k = 0;
	$ok = 0;
	$ok2 = 0;
	$contor = 0;
	$contor_first_next = 0;

	$username = $_SESSION['username'];

	$sql1 = "SELECT id FROM login_info_users WHERE username='$username'";
	$query1 = mysqli_query($db, $sql1);
	$row1 = mysqli_fetch_assoc($query1);
	
	if(isset($_GET)){
		$id_sender = $row1['id'];
		$id_receiver = $_GET['id'];
	}
	else{
		$id_sender = 0;
		$id_receiver = 0;
	}
	
	if($id_sender && $id_receiver){
		$sql = "SELECT * FROM text_users_msg WHERE sender='$id_sender' AND receiver='$id_receiver' OR receiver='$id_sender' AND sender='$id_receiver'";

		$query = mysqli_query($db, $sql);
		$numRows = mysqli_num_rows($query);

		while($row = mysqli_fetch_assoc($query)){
			$k = $k + 1;
			$date_db = $row['data'];
			$format = 'Y-m-d h:i:sa';
			$date = new DateTime($date_db);
			$time = $date->format('h:i A');

			$final_result = wordwrap($row['msg'], 67, '<br>', true);

			if($k < $numRows){
				if($k == 1){
					if($id_sender == $row['sender']){
						echo '<div class="msg_container_right">';
							echo '<div class="right">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo 	$final_result;
							echo '</span>';
							echo '<p class="time_right">'. $time .'</p>';
							echo '</div>';
						echo '</div>';
						$contor = 1;
					}
					else{
						echo '<div class="msg_container_left">';
							echo '<div class="left">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo 	$final_result;
							echo '</span>';
							echo '<p class="time_left">'. $time .'</p>';
							echo '</div>';
							$contor = 2;
						echo '</div>';
					}
				}
				else{
					if($id_sender == $row['sender']){
						if($contor == 1){
							echo '<div class="msg_container_right">';
								echo '<div class="right_next">';
								if($ok == 1){
									echo '<p class="name">Kranti</p>';
								}
								echo '<span id="txt'.$k.'"> ';
								echo $final_result;
								echo '</span>';
								echo '<p class="time_right">'. $time .'</p>';
								echo '</div>';
							echo '</div>';
							$contor = 1;
						}
						else{
							echo '<div class="msg_container_right">';
								echo '<div class="right">';
								if($ok == 1){
									echo '<p class="name">Kranti</p>';
								}
								echo '<span id="txt'.$k.'"> ';
								echo $final_result;
								echo '</span>';
								echo '<p class="time_right">'. $time .'</p>';
								echo '</div>';
								$contor = 1;
							echo '</div>';
						}
					}
					else{
						if($contor == 1){
							echo '<div class="msg_container_left">';
								echo '<div class="left">';
								if($ok == 1){
									echo '<p class="name">Kranti</p>';
								}
								echo '<span id="txt'.$k.'"> ';
								echo $final_result;
								echo '</span>';
								echo '<p class="time_left">'. $time .'</p>';
								echo '</div>';
								$contor = 2;
							echo '</div>';
						}
						else{
							echo '<div class="msg_container_left">';
								echo '<div class="left_next">';
								if($ok == 1){
									echo '<p class="name">Kranti</p>';
								}
								echo '<span id="txt'.$k.'"> ';
								echo $final_result;
								echo '</span>';
								echo '<p class="time_left">'. $time .'</p>';
								echo '</div>';
								$contor = 2;
							echo '</div>';
						}
					}
				}
			}
			if($k == $numRows){
				if($id_sender == $row['sender']){
					if($contor == 1){
						echo '<div class="msg_container_right" id="last">';
							echo '<div class="right_next">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo $final_result;
							echo '</span>';
							echo '<p class="time_right">'. $time .'</p>';
							echo '</div>';
						echo '</div>';
					}
					else{
						echo '<div class="msg_container_right" id="last">';
							echo '<div class="right">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo $final_result;
							echo '</span>';
							echo '<p class="time_right">'. $time .'</p>';
							echo '</div>';
						echo '</div>';
					}
				}
				else{
					if($contor == 1){
						echo '<div class="msg_container_left" id="last">';
							echo '<div class="left">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo $final_result;
							echo '</span>';
							echo '<p class="time_left">'. $time .'</p>';
							echo '</div>';
						echo '</div>';
					}
					else{
						echo '<div class="msg_container_left" id="last">';
							echo '<div class="left_next">';
							if($ok == 1){
								echo '<p class="name">Kranti</p>';
							}
							echo '<span id="txt'.$k.'"> ';
							echo $final_result;
							echo '</span>';
							echo '<p class="time_left">'. $time .'</p>';
							echo '</div>';
						echo '</div>';
					}
				}
			}
		}
	}
	else{
		usleep(500000);
		echo '<img src="./images/logo2.png"></img>';
	}*/
	
?>