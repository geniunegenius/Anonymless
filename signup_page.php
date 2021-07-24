<!DOCTYPE>
<?php include('server.php'); ?>

<html lang="en">

	<head> 
		<title>Anonymless - signup</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
	</head>

	<body bgcolor="#ddb0a0">
		<div class="login">
			<a class="menu" href="index.php" title="Login page!">Login</a><a class="menu_checked" href="signup_page.php" title="Signup page!">Signup</a><a class="menu" href="recover_password_page.php" title="Recover your password!">Recovery</a>
			<form class="login" method="POST">
				<img src="images/logo2.png"></img>
				<input class="text" style="margin-top:10;" type="text" name="username" id="username" placeholder="Username" title="Enter your username!" minlength="8"></input>
				<input class="text" type="password" name="pwd" id="pwd" placeholder="Password" title="Enter your password!" minlength="8"></input>
				<input class="text" type="password" name="cpwd" id="cpwd" placeholder="Confirm password" title="Enter your password!" minlength="8"></input>
				<div class="errorMsg" id="errorMsg"></div>
				<input class="submit" type="submit" name="submit_signup" title="Signup" value="Signup"></input>
			</form>
		</div>
	</body>
	<script>
		var password = document.getElementById('pwd');
		var confirm_password = document.getElementById('cpwd');
		function validatePassword() {
		    if ((confirm_password.value!='')&&(password.value != confirm_password.value)) {
		        document.getElementById('errorMsg').innerHTML='Passwords Don\'t Match';
		    } else {
		        document.getElementById('errorMsg').innerHTML='';
		    }
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
</html>