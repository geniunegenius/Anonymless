<?php
	include("db_connection.php");
	session_start();

	$id = 0;
	$toUser = $_POST['toUser'];
	$fromUser = $_SESSION['id'];

	$output = "";

	if($toUser != $fromUser){
		$output .= '<script>
			var btn = document.getElementById("menu_info2");
			btn.style.transition = "all 0.5s ease";
			btn.style.display = "block";

			var info = document.getElementById("menu_info");
			info.style.width = "30%";
		</script>';

		$sql = "SELECT * FROM login_info_users WHERE id='$toUser'";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($query);

		echo '<div style="display:flex;flex-wrap:wrap;width:100%;height:100%;">';
			echo '<div style="flex:1;padding:15 50 15 50; color:#d86c70;">';	
				echo $row['username'];
			echo '</div>';

		$sql1 = "SELECT * FROM add_friends WHERE (send_req = '$fromUser' AND receive_req = '$toUser') OR (send_req = '$toUser' AND receive_req = '$fromUser')";
		$query1 = mysqli_query($db, $sql1);
		$row1 = mysqli_fetch_assoc($query1);

		if(mysqli_num_rows($query1)){
			if($row1['confirmed'] == 0){
				if($row1['send_req'] == $fromUser){
					if(mysqli_num_rows($query1)){
						if($row1['pending'] == 1){
							echo '<div id="add_friends_div" style="background-color: transparent;margin:20 40 0 0;">';
							echo '<img width="35px" src="./images/pending_add_friends.png"></img>';
							echo '</div>';
						}
					}
					if(mysqli_num_rows($query1) == 0){
						echo '<div id="add_friends_div" style="background-color: transparent;margin:20 40 0 0;">';
						echo '<button class="button_add_friends" type="submit" name="button_add_friends" title="Add friend" id="button_add_friends" value="Add"><img width="35px" src="./images/add_friends.png"></img></button>';
						echo '</div>';
					}
				}

				if($row1['send_req'] == $toUser){
					if($row1['pending'] == 1){
						echo '<div id="add_friends_div" style="background-color: transparent;margin:20 40 0 0;">';
						echo '<button class="button_add_friends" type="submit" name="button_add_friends" title="Add friend" id="button_add_friends" value="Add"><img width="35px" src="./images/add_friends.png"></img></button>';
						echo '</div>';
					}
				}
			}
		}
		else{
			echo '<div id="add_friends_div" style="background-color: transparent;margin:20 40 0 0;">';
			echo '<button class="button_add_friends" type="submit" name="button_add_friends" title="Add friend" id="button_add_friends" value="Add"><img width="35px" src="./images/add_friends.png"></img></button>';
			echo '</div>';
		}
		echo '<div id="more_menu" style="background-color:transparent;margin:12.5 20 0 0;cursor:pointer;">';
		echo '<button style="background-color:transparent;border:0px solid;cursor:pointer;padding:10px;" type="submit" title="More" id="button_more_menu" value="More"><img src="./images/3dots.png" width="5" height="25" title="More"></img></button>';
		echo '</div>';
		
	}
	else
	{
		echo '<script>
			var btn = document.getElementById("menu_info2");
			btn.style.display = "none";
		</script>';
	}

	echo $output;			
?>