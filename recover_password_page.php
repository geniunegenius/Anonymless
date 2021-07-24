<!DOCTYPE>
<?php include('server.php'); ?>
<html lang="en">

	<head> 
		<title>Anonymless - recover password</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
	</head>

	<body bgcolor="#ddb0a0">
		<div class="login">
			<a class="menu" href="index.php" title="Login page!">Login</a><a class="menu" href="signup_page.php" title="Signup page!">Signup</a><a class="menu_checked" href="recover_password_page.php" title="Recover your password!">Recovery</a>
			<form class="login" method="POST">
				<img src="images/logo2.png"></img>
				<input class="text"  style="margin-top:10;" type="text" name="username" id="username" placeholder="Username" title="Enter your username!"></input>
				<input class="submit" type="submit" name="submit_recoverpwd" title="Recover password" value="Send mail"></input>
			</form>
		</div>
	</body>
	
</html>