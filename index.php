<!DOCTYPE>
<?php include('server_chat_redirect.php'); ?>
<?php include('server.php'); ?>

<html lang="en">
	<style>
		input::-ms-clear, input::-ms-reveal {
		    display: none;
		}
	</style>
	<head> 
		<title>Anonymless - login</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	</head>

	<body bgcolor="#ddb0a0">
		<div class="login">
			<a class="menu_checked" href="index.php" title="Login page!">Login</a><a class="menu" href="signup_page.php" title="Signup page!">Signup</a><a class="menu" href="recover_password_page.php" title="Recover your password!">Recovery</a>
			<form class="login" method="POST">
				<img class="logo" src="images/logo2.png" alt="Logo" title="Anonymless"></img>
				<input class="text" style="margin-top:10;" type="text" name="username" id="username" placeholder="Username" title="Enter your username!"></input>
				<input class="text" type="password" name="password" id="password" placeholder="Password" title="Enter your password!"></input>
				<label class="container">Show Password
					<input type="checkbox" onclick="myFunction()">
					<span class="checkmark"></span>
				</label>
				<input class="submit" type="submit" name="submit_login" title="Login" value="Login"></input>
			</form>
		</div>
	</body>
	<script>
		function myFunction() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
			} 
			else {
				x.type = "password";
			}
		}
	</script>
</html>