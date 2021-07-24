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
			<a class="recover_menu" href="index.php" title="Back to homepage">Back</a><label class="recover_menu_checked" title="Set up your e-mail!">Signup</label>
			<form class="login" method="POST">
				<img src="images/logo2.png"></img>
				<input class="text" style="margin-top:10;" type="text" name="email" id="email" placeholder="E-mail" title="Enter your mail!" minlength="8"></input>
				<div class="errorMsg" id="errorMsg"></div>
				<input class="submit" type="submit" name="submit_signup_email" title="Set up e-mail" value="Set up e-mail"></input>
			</form>
		</div>
	</body>
	<script>
		var email = document.getElementById('email');
		function ValidateEmail() {
			if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email.value))
			{
				document.getElementById('errorMsg').innerHTML='';
			}
			else{
				document.getElementById('errorMsg').innerHTML='Enter a valid email address!';
			}
		}
		email.onkeyup = ValidateEmail;
	</script>
</html>