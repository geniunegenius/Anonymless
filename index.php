<!DOCTYPE html>
<html lang="en">

<head> 
	<title>Anonymless</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="New Folder/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="icon.png"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
</head>

<body>
	<div class="main" style="background-image: url('bkgrpic.jpg'); background-size:100% 100%; background-repeat: no-repeat; ">
		<div class="container-login">
			<div class="text">
				<span class="login-form-title m-l-125 m-t-175 m-b-50" id="welcome">Welcome to</span>
				<span class="login-form-title2 m-l-125" id="anonymless">Anonymless</span>
			</div>
			<form class="form" id="myForm">
				<div class="wrap-input validate-input m-t-60 m-b-35">
					<input class="input" type="text" name="username" id="username" placeholder="Username" title="Enter your username!"></input>
					<input class="input m-t-25" type="password" name="password" id="password" placeholder="Password" title="Enter your password!"></input>
					<input class="input-button m-b-10 m-t-25" type="submit" name="submit" title="Login" value="Login"></input>
					<div class="fp-link-div">
						<a class="fp-link" href="#" name="Forgot password?">Forgot password?</a>
					</div>
				</div>
				<div class="wrap-q validate-q">
					<input class="input-button m-b-25" type="submit" name="submit" value="Signup" title="Login"></input>
				</div>
			</form>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
	
	<script src="New Folder/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="New Folder/vendor/animsition/js/animsition.min.js"></script>
	<script src="New Folder/vendor/bootstrap/js/popper.js"></script>
	<script src="New Folder/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="New Folder/vendor/select2/select2.min.js"></script>
	<script src="New Folder/vendor/daterangepicker/moment.min.js"></script>
	<script src="New Folder/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="New Folder/vendor/countdowntime/countdowntime.js"></script>
	<script>
		/*setTimeout(function() {
			document.location.reload();
		}, 1000);*/
		const myForm = document.getElementById("myForm");
		
		myForm.addEventListener("submit", (e) => {
			e.preventDefault();
			
			const request = new XMLHttpRequest();
			
			request.open("post", "server.php");
			request.onload = function() {
				console.log(request.responseText);
			}
			request.send(new FormData(myForm));
		});
	</script>
</body>


</html>