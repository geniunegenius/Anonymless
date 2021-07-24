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
			<a class="recover_menu" href="index.php" title="Back to homepage">Back</a><label class="recover_menu_checked" title="Recover your password!">Recover password</label>
			<form class="login" method="POST">
				<img src="images/logo2.png" title="logo"></img>
				<input class="text"  style="margin-top:10;" type="text" name="code" id="code" placeholder="Code" title="Enter your recovery code!"></input>
				<input class="text"  style="margin-top:10;" type="password" name="pwd" id="pwd" placeholder="New password" title="Enter your new password!" minlength="8"></input>
				<input class="text"  style="margin-top:10;" type="password" name="cpwd" id="cpwd" placeholder="Confirm new password" title="Enter your new password again!" minlength="8"></input>
				<div class="errorMsg" id="errorMsg"></div>
				<input class="submit" type="submit" name="submit_newpwd" title="Change password" value="Change password"></input>
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
		if(password.onchange && confirm_password.onkeyup){
			password.onchange = validatePassword();
			confirm_password.onkeyup = validatePassword();
		}
	</script>
</html>