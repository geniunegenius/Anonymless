<?php
	include("db_connection.php");
?>

<div class="d1" style="display: flex;justify-content: center;align-items: center;text-align: center;width: 100%;height: 100%;background-color: #e1ceb1;">
	<div class="d2_1" style="display: flex;flex-direction: column;justify-content: center;width: 50px;height: 75%;background-color: transparent;">
		<div class="d2_11" style="margin: 0 auto;background-color: transparent;">
			<label id="label_private_msg" for="profile_private_message" style="cursor: pointer;">
				<img class="profile_img_msg" id="profile_img_msg" src="./images/ano_message.png" style="padding: 10px;background-color: #ddb0a0;user-select: none;width: 30px;height: auto;border: 0px #d86c70; border-top-left-radius:15px; border-bottom-left-radius:15px;"> </img>
			</label>
			<label id="label_settings" style="cursor: pointer;" for="profile_settings">
				<img class="profile_img_settings" id="profile_img_settings" src="./images/ano_settings.png" style="padding: 10px;margin-top: 5px;background-color: #ddb0a0;user-select: none;width: 30px;height: auto;border: 0px solid; border-top-left-radius:15px; border-bottom-left-radius:15px;"></img>
			</label>
		</div>
	</div>
	<div class="d2_2" style="display:flex;justify-content: center;align-items: center;text-align: center;padding: 10px;width: 1000px;height: 75%;background-color: #ddb0a0;border: 0px solid;border-radius: 5px;" id="d2_2">
		<div style="color:#d86c70;width:auto;user-select:none;">
			<?php
				session_start();

				$id_current_user = $_SESSION['id'];
				$sql = "SELECT * FROM ano_msg WHERE receiver='$id_current_user'";
				$query = mysqli_query($db, $sql);
				if(mysqli_fetch_assoc($query)){
					while($row = mysqli_fetch_assoc($query)){
						echo $row['msg'] . '<br>';
					}
				}
				else{
					echo 'No anonymous messages...';
				}
			?>
		</div>
	</div>

	<input type="radio" id="setting_tab1" name="radio_settings" checked hidden></input>
	<input type="radio" id="setting_tab2" name="radio_settings" hidden></input>

	<div class="d2_3" style="display:flex;flex-direction:column;padding: 10px;display: none;width: 1000px;height: 75%;background-color: #ddb0a0;border: 0px solid;border-radius: 5px;" id="d2_3">
		<div style="flex:0.1;color:#d86c70;width:auto;user-select:none;">
			<label id="label_tab1_settings" for="setting_tab1" style="border-bottom:1px solid #d86c70; background-color:transparent; user-select:none; cursor: pointer;">Settings</label>
			<label id="label_tab2_settings" for="setting_tab2" style="margin-left:10px; background-color:transparent; user-select:none; cursor: pointer;">
				Preferences
			</label>
		</div>
		<div id="tab1_settings" style="display:flex;flex:1.5;user-select:none;color:#d86c70;width:auto;">
			<div style="width:100%;background-color:transparent;height:auto;">
				<div style="display:flex:justify-content:center;align-items: center;text-align: center;">
					<div style="width:75%;user-select:none;background-color:#e1ceb1;height:auto;margin:auto;border-radius:15px;padding:10px;">
						Settings
					</div>
				</div>
			</div>
		</div>
		<div id="tab2_settings" style="display:none;flex:1.5;user-select:none;color:#d86c70;width:auto;">
			<div style="width:100%;background-color:transparent;height:auto;">
				<div style="display:flex:justify-content:center;align-items: center;text-align: center;">
		          <div style="width:75%;user-select:none;background-color:#e1ceb1;height:auto;margin:auto;border-radius:15px;padding:10px;">
		          	<?php
		          		$username = $_SESSION['username'];
		          		$sql = "SELECT pref FROM login_info_users WHERE username = '$username'";
		          		$query = mysqli_query($db, $sql);
		          		$row = mysqli_fetch_assoc($query);
			          	$string = $row['pref'];
			          	$substring = "";

		          		if(!$string){
			            	echo '<p id="no-pref">No preferences yet...</p>';
			          	}
			          	else{
			            	echo '<p id="no-pref" style="display:none;">No preferences yet...</p>';
			          		while($string){
			          			$substring = substr($string, 0, strpos($string, ';'));
			          			echo '<button class="button removePreferences" id="remove-'. $substring .'" style="display:inline-flex;margin:10 2;padding:0;cursor:pointer;background-color: #d86c70;border:0px solid;border-radius:5px;color:#e1ceb1;user-select: none;text-align: center;" value="'. $substring .'">
				              <div style="width:auto;text-align: center;margin:0;height:20;padding:5 4 0 5;">'.$substring.'</div>

				              <div style="width:auto;text-align: center;padding:3 4 0 2;"><img style="background-color: #e1ceb1;padding:5;border-radius:10px;width:10;height:10;" src="./images/xmark.png"></img><div>
				            </button>';
				            	$string = str_replace($substring.";", "", $string);
				            	$substring = "";
			          		}
				          }
				          $hobbies = array("Fishing", "Reading", "Gaming", "Blogging", "Acting", "Animation", "Art", "Sports", "Cooking", "Drawing", "Electronics", "Fashion", "Humor", "Gardening", "Inventing", "Puzzles", "Makeup", "Painting", "Music", "Pet", "Photography", "Poetry", "Singing", "Sleeping", "Social media", "Storytelling", "Video making", "Movies", "Writing", "Teaching");
				          foreach($hobbies as $k){
					          echo '<button class="button removePreferences" id="remove-'.$k.'" style="display:none;margin:10 2;padding:0;cursor:pointer;background-color: #d86c70;border:0px solid;border-radius:5px;color:#e1ceb1;user-select: none;text-align: center;" value="'.$k.'">
					              <div style="width:auto;text-align: center;margin:0;height:20;padding:5 4 0 5;">'.$k.'</div>

					              <div style="width:auto;text-align: center;padding:3 4 0 2;"><img style="background-color: #e1ceb1;padding:5;border-radius:10px;width:10;height:10;" src="./images/xmark.png"></img><div>
					            </button>';
				          }
		            ?>
		          </div>
		          <div class="add_preferences_div" style="width:75%;background-color:transparent;height:auto;margin:10 auto;border-radius:15px;padding:10;">
		            <span style="user-select:none;">Choose what you love to do!<br></span>
		            <?php
				          $hobbies = array("Fishing", "Reading", "Gaming", "Blogging", "Acting", "Animation", "Art", "Sports", "Cooking", "Drawing", "Electronics", "Fashion", "Humor", "Gardening", "Inventing", "Puzzles", "Makeup", "Painting", "Music", "Pet", "Photography", "Poetry", "Singing", "Sleeping", "Social media", "Storytelling", "Video making", "Movies", "Writing", "Teaching");

		          		$username = $_SESSION['username'];
		          		$sql = "SELECT pref FROM login_info_users WHERE username = '$username'";
		          		$query = mysqli_query($db, $sql);
		          		$row = mysqli_fetch_assoc($query);
			          	$string = $row['pref'];
			          	$substring = "";

			          	$array_pref = array();
			          	while($string){
			          			$substring = substr($string, 0, strpos($string, ';'));
			          			array_push($array_pref, $substring);
				            	$string = str_replace($substring.";", "", $string);
				            	$substring = "";
			          	}

				          foreach($hobbies as $k){
				          	$semafor = 0;
				          	foreach($array_pref as $l){
				          			if($k == $l){
				          				$semafor = 1;
				          			}
				  						}
				  					if($semafor == 0){
							          echo '<button class="button addPreferences" id="add-'.$k.'" style="display:inline-flex;margin:10 2;padding:0;cursor:pointer;background-color: #e1ceb1;border:0px solid;border-radius:5px;color:#d86c70;user-select: none;text-align: center;" value="'.$k.'" type="submit">
				                  <div style="width:auto;text-align: center;margin:0;height:20;padding:5 4 0 5;"><span class="add_preferences_text">'.$k.'</span></div>
				                  <div style="width:auto;text-align: center;padding:3 4 0 2;"><img style="background-color: #d86c70;padding:5;border-radius:10px;width:10;height:10;" src="./images/checkmark.png"></img><div>
				                </button>';
				              }
				          }

				          $hobbies = array("Fishing", "Reading", "Gaming", "Blogging", "Acting", "Animation", "Art", "Sports", "Cooking", "Drawing", "Electronics", "Fashion", "Humor", "Gardening", "Inventing", "Puzzles", "Makeup", "Painting", "Music", "Pet", "Photography", "Poetry", "Singing", "Sleeping", "Social media", "Storytelling", "Video making", "Movies", "Writing", "Teaching");
				          foreach($hobbies as $k){
				          	echo '<button class="button addPreferences" id="add-'.$k.'" style="display:none;margin:10 2;padding:0;cursor:pointer;background-color: #e1ceb1;border:0px solid;border-radius:5px;color:#d86c70;user-select: none;text-align: center;" value="'.$k.'" type="submit">
				                  <div style="width:auto;text-align: center;margin:0;height:20;padding:5 4 0 5;"><span class="add_preferences_text">'.$k.'</span></div>
				                  <div style="width:auto;text-align: center;padding:3 4 0 2;"><img style="background-color: #d86c70;padding:5;border-radius:10px;width:10;height:10;" src="./images/checkmark.png"></img><div>
				                </button>';
				          }
		            ?>
		          </div>
		          <div id="data">
		          </div>
		        </div>
			</div>
		</div>
	</div>
</div>

<script>
	document.querySelectorAll('.addPreferences[value]').forEach((button) => {
		k = 0;
		button.addEventListener('click', (event) => {
	    $.ajax({
	      url:"add_preferences.php",
	      method:"POST",
	      data:{
	        pref:button.getAttribute('value')
	      },
	      dataType:"text",
	      success:function(data){
	      	let hobbies = ["Fishing", "Reading", "Gaming", "Blogging", "Acting", "Animation", "Art", "Sports", "Cooking", "Drawing", "Electronics", "Fashion", "Humor", "Gardening", "Inventing", "Puzzles", "Makeup", "Painting", "Music", "Pet", "Photography", "Poetry", "Singing", "Sleeping", "Social media", "Storytelling", "Video making", "Movies", "Writing", "Teaching"];
	      	hobbies.forEach(function(item) {
					  if(button.getAttribute('value') === item){
					  	document.getElementById('no-pref').style.display = "none";
	            document.getElementById(`add-${item}`).style.display = "none";
	            document.getElementById(`remove-${item}`).style.display = "inline-flex";
					  }
					});
	        $("#data").html(data)
	      }
	    });
	  });
	});
	document.querySelectorAll('.removePreferences[value]').forEach((button) => {
		button.addEventListener('click', (event) => {
	    $.ajax({
	      url:"remove_preferences.php",
	      method:"POST",
	      data:{
	        pref:button.getAttribute('value')
	      },
	      dataType:"text",
	      success:function(data){
	      	let hobbies = ["Fishing", "Reading", "Gaming", "Blogging", "Acting", "Animation", "Art", "Sports", "Cooking", "Drawing", "Electronics", "Fashion", "Humor", "Gardening", "Inventing", "Puzzles", "Makeup", "Painting", "Music", "Pet", "Photography", "Poetry", "Singing", "Sleeping", "Social media", "Storytelling", "Video making", "Movies", "Writing", "Teaching"];
	      	hobbies.forEach(function(item) {
					  if(button.getAttribute('value') === item){
	            document.getElementById(`add-${item}`).style.display = "inline-flex";
	            document.getElementById(`remove-${item}`).style.display = "none";
					  }
					});
	        $("#data").html(data)
	      }
	    });
	  });
	});

	/*$("#fishing").click(function(){
		document.getElementById("fishing").style.display = "none";
	});*/

	$("#profile_settings").click(function() {
		if($(this).is(":checked")) {
			document.getElementById("d2_2").style.display = "none";
			document.getElementById("d2_3").style.display = "flex";
		}
	});
	$("#profile_private_message").click(function() {
		if($(this).is(":checked")) {
			document.getElementById("d2_3").style.display = "none";
			document.getElementById("d2_2").style.display = "flex";
		}
	});

	$("#setting_tab1").click(function() {
		if($(this).is(":checked")) {
			document.getElementById("tab1_settings").style.display = "flex";
			document.getElementById("label_tab1_settings").style.borderBottom = "1px solid #d86c70";
			document.getElementById("tab2_settings").style.display = "none";
			document.getElementById("label_tab2_settings").style.borderBottom = "0px solid #d86c70";
		}
	});
	$("#setting_tab2").click(function() {
		if($(this).is(":checked")) {
			document.getElementById("tab1_settings").style.display = "none";
			document.getElementById("label_tab1_settings").style.borderBottom = "0px solid #d86c70";
			document.getElementById("tab2_settings").style.display = "flex";
			document.getElementById("label_tab2_settings").style.borderBottom = "1px solid #d86c70";
		}
	});
</script>