<?php session_start(); ?>
<!DOCTYPE>
<html lang="en">

	<head> 
		<meta charset="UTF-8">
		<title>Anonymless - chatapp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/chat.css"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	</head>

	<body bgcolor="#e1ceb1">
		<?php
			

			echo'
				<input type="radio" id="radio_chat" name="radio_button" checked hidden></input>
				<input type="radio" id="radio_add" name="radio_button" hidden></input>
				<input type="radio" id="radio_profile" name="radio_button" hidden></input>';
		?>
		<!-- toUser info -->
		<?php
			$username = '';
			$localhost = "localhost";
			$id_db = "root";
			$pwd_db = "";
			$database_name = "anonymless";
			$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

			if(isset($_GET['toUser'])){
				$id_toUser = $_GET['toUser'];
				$sql = "SELECT * FROM login_info_users WHERE id = '$id_toUser'";
				$query = mysqli_query($db, $sql);

				$row = mysqli_fetch_assoc($query);

				echo '<input type="text" value="'. $id_toUser .'" id="toUser" hidden></input>';
			}
			else{
				$username = $_SESSION['username'];
				$sql = "SELECT * FROM login_info_users WHERE username = '$username'";
				$query = mysqli_query($db, $sql);

				$row = mysqli_fetch_assoc($query);
				$_SESSION['toUser'] = $row['id'];

				echo '<input type="text" value="'. $_SESSION['toUser'] .'" id="toUser" hidden></input>';
			}
		?>

		<div class="menu_info" id="menu_info">
			<div class="menu_info_content">
				<div class="menu_info_top">
					<div class="menu_info_top_2" style="user-select:none;">
						<img class="menu_info_top" src="./images/avatar_male.png"> </img>
						<?php 
							echo '<a class="menu_info_top" id="menu_info_top" style="margin-left:5px;" href="#" id="session">'.$_SESSION['username'].'</a>';
						?>
						<a class="menu_info_top" href="index.php?logout=1">Logout</a>
					</div>
				</div>
				<div class="menu_info_bottom" style="user-select:none;">
					<label id="label_chat" for="radio_chat">
						<?php echo '<img class="menu_chat" src="images/msg.png" alt="Logo" title="Messages"> </img>'; ?>
					</label>
					<label id="label_add" for="radio_add">
						<img class="menu_add" src="images/add_friends.png" alt="Logo" title="Add friends"> </img>
					</label>
					<label id="label_profile" for="radio_profile">
						<img class="menu_profile" src="images/profile.png" alt="Logo" title="Profile"> </img>
					</label>
				</div>
			</div>
		</div>

		<div class="menu_info2" id="menu_info2" style="user-select:none;">

		</div>

		

		<input type="radio" id="profile_private_message" name="radio_profile" checked hidden></input>
		<input type="radio" id="profile_settings" name="radio_profile" hidden></input>

		<div class="profile_div" id="profile_div">

		</div>

		<div class="search_bar" id="search_bar" style="display: none;">
			<div style="width:100%;">
				<input class="search"id="search" type="text" placeholder="Search for some friends..." autocomplete="off"></input>
				<div id="search_result"></div>
			</div>
		</div>

		<div class="chat_text" id="chat_text">
			<?php
				if(isset($_GET['toUser'])){
					$display_chatbox = 1;
				}
				else{
					$display_chatbox = 0;		
				}
			?>
		</div>
		
		<div id="menu_left" class="menu_left">
		</div>

		<div class="menu_left_add_random" id="menu_left_add_random">
			<div id="return_random_friend" style="user-select:none; padding:10px; margin: 0 auto; width:90%; border:1px solid #d86c70; border-top-left-radius:20px; border-bottom-left-radius:20px; color:#d86c70;">
				No random friends...
			</div>
			<div id="button_random" style="width:10%; margin: 0 auto; border:1px solid #d86c70; padding:4px; border-top-right-radius:20px; border-bottom-right-radius:20px; border-left: 0px; cursor: pointer;">
				<img src="./images/random_button.png" style="user-select:none;" width="30" height="30" title="Add random friends"></img>
			</div>
		</div>

		<?php
			if($display_chatbox){
				echo'	
				<div class="submit_text" id="submit_text">
					<input class="input_text" type="input" id="message" name="input_text" placeholder="Send something nice..." autocomplete="off"></input>
					<button class="submit_text" type="submit" name="submit_text" title="Send" id="send_msg" value="Send"><span style="font-size: 0.9em;user-select:none;">Send<span></button>
				</div>';
				echo '
				<script>
					document.getElementById("chat_text").style.height = "80%";
				</script>
				';
			}
			else{
				echo '
				<script>
					document.getElementById("chat_text").style.height = "90%";
				</script>
				';
			}
		?>
		
		<div id="menu_more" class="menu_more">
			<div class="menu_more_items" style="border-top-left-radius:10px; border-bottom:0;">
				<button class="menu_more_items" id="more_remove" type="submit" value="Profile">Remove Friend</button>
			</div>
			<div class="menu_more_items" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">
				<button class="menu_more_items" id="more_block" type="submit" value="Block">Block</button>
			</div>
		</div>
		
	</body>



<script>
	//check for Navigation Timing API support
	if (window.performance) {
		console.info("window.performance works fine on this browser");
	}
	console.info(performance.navigation.type);
	if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
		console.info( "This page is reloaded");
	}else{
		console.info( "This page is not reloaded");
	}

	function scrollBottom(){
		$("#chat_text").scrollTop(function() { return this.scrollHeight; });
	}
	setTimeout(function () {
		scrollBottom();
    }, 1100);

	$(document).ready(function(){
		setTimeout(function(){
			$("#button_add_friends").on("click",function(){
				$.ajax({
					url:"get_user_request.php",
					method:"POST",
					data:{
						toUser:$("#toUser").val()
					},
					dataType:"text",
					headers: {
					    'Cache-Control': 'no-cache' 
					},
					success:function(data){
						$("#add_friends_div").html(data)
					}
				});
			});	
		
			$("#button_more_menu").on("click",function(){
				if(document.getElementById("menu_more").style.display === "none"){
					document.getElementById("menu_more").style.display = "flex";
				}
				else{
					document.getElementById("menu_more").style.display = "none";
				}
			});
		}, 1100);

		setTimeout(function(){
			$("#more_profile").on("click",function(){
				document.getElementById("menu_info").style.width = "100%";
				document.getElementById("menu_info").style.transition = "all 0.5s ease";
				document.getElementById("menu_info2").style.display = "none";
				document.getElementById("search_bar").style.display = "none";
				document.getElementById("submit_text").style.display = "none";
				document.getElementById("chat_text").style.display = "none";
				document.getElementById("menu_more").style.display = "none";
				document.getElementById("menu_left").style.display = "none";
				document.getElementById("menu_left_add_random").style.display = "none";
				document.getElementById("profile_div2_button").checked = true;
				$.ajax({
					url:"profile2_content.php",
					method:"POST",
					data:{
						toUser:$("#toUser").val()
					},
					dataType:"text",
					headers: {
					    'Cache-Control': 'no-cache' 
					},
					success:function(data){
						$("#profile_div2").html(data)
					}
				});
			});
			$("#more_remove").on("click",function(){
				document.getElementById("more_profile").style.color = "red";
			});
			$("#more_block").on("click",function(){
				document.getElementById("more_profile").style.color = "red";
			});
		}, 1100);

		$('#button_random').on('click',function(){
			$.ajax({
				url:'get_random_friend.php',
				method:'POST',
				dataType:'text',
				headers: {
				    'Cache-Control': 'no-cache' 
				},
				success:function(data){
					$('#return_random_friend').html(data);
				}
			});
		});

		$('#send_msg').on("click",function(){
			$.ajax({
				url:"chat_submit_content.php",
				method:"POST",
				data:{
					toUser: $('#toUser').val(),
					message: $('#message').val()
				},
				dataType:"text",
				headers: {
				     'Cache-Control': 'no-cache' 
				},
				success:function(data){
					$('#message').val("");
					setTimeout(function () {
						scrollBottom();
					}, 1100);
				}
			});
		});

		$('#send_msg').on("click",function(){
			setTimeout(function () {
				scrollBottom();
			}, 1100);
		});


		setInterval(function(){
			if($('#radio_chat').is(':checked')){
				$.ajax({
					url:"chat_content.php",
					method:"POST",
					data:{
						toUser:$("#toUser").val()
					},
					dataType:"text",
					headers: {
					     'Cache-Control': 'no-cache' 
					},
					success:function(data){
						$("#chat_text").html(data)
					}
				});
			}
		}, 1000);

		$.ajax({
			url:"menu_info_about.php",
			method:"POST",
			data:{
				toUser:$("#toUser").val()
			},
			dataType:"text",
			headers: {
			     'Cache-Control': 'no-cache' 
			},
			success:function(data){
				$("#menu_info2").html(data)
			}
		});


		$('#radio_add').click(function() {
			if($(this).is(':checked')) {
				document.getElementById("search_bar").style.display = "flex";
				document.getElementById("menu_left").style.height = "74%";
				document.getElementById("menu_left_add_random").style.height = "10%";
				document.getElementById("radio_add").checked = true;
			}
		});

		$('#radio_chat').click(function() {
			if($(this).is(':checked')) {
				$('#profile_div').html("");
				document.getElementById("search_bar").style.display = "none";
				document.getElementById("menu_left").style.height = "80%";
				document.getElementById("menu_left_add_random").style.display = "flex";
				document.getElementById("menu_left_add_random").style.height = "10%";
				document.getElementById("radio_chat").checked = true;
			}
		});

		$('#radio_add').click(function() {
			if($(this).is(':checked')) {
				$('#profile_div').html("");
				document.getElementById("menu_left_add_random").style.display = "flex";
				document.getElementById("radio_add").checked = true;
			}
		});

		$('#radio_profile').click(function() {
			if($(this).is(':checked')) {
				document.getElementById("menu_info").style.width = "100%";
				document.getElementById("menu_info").style.transition = "all 0.5s ease";
				document.getElementById("menu_info2").style.display = "none";
				document.getElementById("search_bar").style.display = "none";
				document.getElementById("menu_left_add_random").style.display = "none";
				document.getElementById("menu_more").style.display = "none";
				document.getElementById("radio_profile").checked = true;
				
				$("#profile_div").load('profile_content.php');
			}
		});

		$('#menu_info_top').click(function() {
			document.getElementById("radio_profile").checked = true;
			document.getElementById("menu_info").style.width = "100%";
			document.getElementById("menu_info").style.transition = "all 0.5s ease";
			document.getElementById("menu_info2").style.display = "none";
			document.getElementById("search_bar").style.display = "none";
			document.getElementById("menu_left_add_random").style.display = "none";

			$("#profile_div").load('profile_content.php');
		});

		$('#search').keyup(function(){
			var name = $('#search').val();
			$.ajax({ 
				type:'POST', 
				url:'get_user.php',
				data:{name:name},
				success:function(data){
			$('div#search_result').css({
				'display':'block',
				'border':'1px solid #d86c70',
				'border-top':'0px solid #d86c70',
			});
				$('div#search_result').html(data);}
			});
		});
		
	});

	
</script>

<script type="text/javascript" src="js/chat.js"></script>

<script type="text/javascript">
</script>

</html>
