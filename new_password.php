<?php
	//session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '/home/cedcoss/vendor/autoload.php';
	include "user.php";
	include "passwordReset.php";
	 include_once "config.php";
	 $User=new user();
	 $db=new DBconnection();
	 $pass=new PasswordReset();
	 if(isset($_POST['resetpassword'])){
		$password=$_POST['password'];
		$repassword=$_POST['repassword'];
		
		if($password==$repassword){
			$token=$_GET['token'];
			$user=$_SESSION['temp_user'];
			$res=$pass->FetchData($user,$db->conn);
			unset($_SESSION['temp_user']);
			foreach($res as $r)
			if($r['token']===$token){
				$result=$pass->UpdatePassword($token,$password,$db->conn);
			<script type="text/javascript">alert("Your password is reset")</script>;
				header("Location:signin.php");
		}
			
	}else{
		echo '<script type="text/javascript">alert("Both the passwords must be same");</script>';
}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="admin/resources/css/demo.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<form class="login-form" action=" " method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
		<!-- <?php include('messages.php'); ?> -->
		<div class="form-group">
			<label>Enter Password:</label>
			<input type="password" name="password">
			<label>Re-Password:</label>
			<input type="password" name="repassword">
		</div>
		<div class="form-group">
			<button type="submit" name="resetpassword" class="login-btn">Submit</button>
		</div>
	</form>
	<script type="text/javascript">
		
	</script>
</body>
</html>