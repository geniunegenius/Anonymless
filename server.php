<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once "PHPMailer/PHPMailer.php";
	require_once "PHPMailer/SMTP.php";
	require_once "PHPMailer/Exception.php";
	session_start();
	
	//database con
	$username = '';
	$localhost = "localhost";
	$id_db = "root";
	$pwd_db = "";
	$database_name = "anonymless";
	$db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);

	


	$code = "";

	/*if ($_SERVER['REQUEST_METHOD']!='POST' && realpath('chat_app.php') == realpath( $_SERVER['SCRIPT_FILENAME'])) {

        die(header( 'location:chat_app.php' ));
        echo '<a href="index.php">Go back home</a>';
        echo $_SERVER['REQUEST_METHOD'];
        echo realpath('chat_app.php');
        echo realpath( $_SERVER['SCRIPT_FILENAME']);

    }*/

	//echo var_dump($_POST);
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	
	if(isset($_POST['submit_signup'])){
		if($_POST['pwd'] == $_POST['cpwd']){
			$username = trim($_POST['username']);
			$password = trim($_POST['pwd']);
			$sql = "SELECT username FROM login_info_users WHERE username = '$username'";
			$query = mysqli_query($db, $sql);
			$numRows = mysqli_num_rows($query);
			if($numRows == 0){
				$_SESSION['username'] = $username;
				$_SESSION['ip'] = $ip;
				$_SESSION['id'] = $row['id'];
				$hash = password_hash($password, PASSWORD_ARGON2I);
				mysqli_query($db , "INSERT INTO login_info_users (username , password, ip) VALUES ('$username' , '$hash', '$ip')");
				header("location:signup_email_conf.php");
			}
			else{
				echo '<script>alert("Username not available!")</script>'; 
			}
		}
	}

	if(isset($_POST['submit_signup_email'])){
		$email = trim($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo '<script>alert("Enter a valid email address!")</script>';
		}
		else
		{
			$username = $_SESSION['username'];
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;

			$query = mysqli_query($db, "SELECT id FROM login_info_users WHERE username = '$username'");
			$row = mysqli_fetch_assoc($query);
			$_SESSION['id'] = $row['id'];

			mysqli_query($db , "UPDATE login_info_users SET email = '$email' WHERE username='$username'");
			header("location:chat_app.php");
		}
	}

	if(isset($_POST['submit_login'])){
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$sql = "SELECT * FROM login_info_users WHERE username='$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($query);
		if(password_verify($password, $row['password'])){
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['ip'] = $row['ip'];
			mysqli_query($db, "UPDATE login_info_users SET connected='1' WHERE username='$username'");
			header("location:chat_app.php");
		}
	}

	if (isset($_POST['submit_recoverpwd'])) {
		$username = trim($_POST['username']);
		$_SESSION['username'] = $username;
		$sql = "SELECT * FROM login_info_users WHERE username='$username'";
		$query = mysqli_query($db, $sql);
		$code = rand(100000, 999999);
		$_SESSION['code'] = $code;
		
		$row = mysqli_fetch_assoc($query);
		$user = $row['email'];

		$mail = new PHPMailer(true);
		
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		//Set SMTP host name
		$mail->Host = "smtp.gmail.com";
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;
		//Provide username and password
		$mail->Username = "anonymless.recoverpwd@gmail.com";
		$mail->Password = "Georgeilie12!@";
		$mail->Port = 587; //587
		$mail->SMTPSecure = "tls"; //tls
		$mail->From = "anonymless.recoverpwd@gmail.com";
		$mail->FromName = "Anonymless Team - recover password";
		
		$mail->isHTML(true);
		$mail->addAddress($user, ucfirst($user));
		
		$mail->Subject = "Password Reset Link";
		$mail->Body = "Code:" . $code;

		if($mail->send()){
			header("location:forgot-password.php");
		}
		else{
			alert("We can't send the mail! Please try again!");
		}
	}

	if(isset($_POST['submit_newpwd'])){
		if($_POST['pwd'] == $_POST['cpwd']){
			if($_SESSION['code'] == $_POST['code']){
				$username = $_SESSION['username'];
				$password = $_POST['pwd'];

				$query = mysqli_query($db, "SELECT id FROM login_info_users WHERE username = '$username'");
				$row = mysqli_fetch_assoc($query);
				$_SESSION['id'] = $row['id'];

				$hash = password_hash($password, PASSWORD_ARGON2I);
				mysqli_query($db , "UPDATE login_info_users SET password='$hash' WHERE username='$username'");
				header("location:chat_app.php");
			}
		}
	}

	if(isset($_GET['logout'])){
		$username = $_SESSION['username'];
		$sql = "SELECT connected FROM login_info_users WHERE username = '$username'";
		$query = mysqli_query($db, $sql);
		$numRows = mysqli_num_rows($query);
		$row = mysqli_fetch_assoc($query);
		if($row['connected'] == 1){
			mysqli_query($db, "UPDATE login_info_users SET connected='0' WHERE username='$username'");
		}
		session_destroy();
		unset($_SESSION['username']);
		header('location:index.php');
	}
?>