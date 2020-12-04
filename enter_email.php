<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '/home/cedcoss/vendor/autoload.php';
	include "user.php";
	include "passwordReset.php";
	


	 include_once "config.php";
	 $User=new user();
	 $pass=new PasswordReset();
    $db=new DBconnection();
	if(isset($_POST['reset-password'])){
		$user=$_POST['username'];
		$_SESSION['temp_user']=$user;
		$email=$_POST['email'];
		$sql=$User->FetchUser($user,$db->conn);
		if(count($sql)>0){
			// print_r("Yeah U have done");
			// print_r($sql);
			 $token = openssl_random_pseudo_bytes(26);
			$token = bin2hex($token);
			$result=$pass->InsertData($user,$email,$token,$db->conn);
			//print_r($result);
			if($result=='1'){
				$res=$pass->FetchData($user,$db->conn);
				//print_r($res[0]['token']);
				foreach ($res as $value) {
					// //print_r($value['email']);
					// $to = $value['email'];
				 //    $subject = "Reset your password on cedcab.com";
				 //    $msg = "Hi User, click on this <a href=\"new_password.php?token=" . $value['token'] . "\">link</a> to reset your password on our site";
				 //    $msg = wordwrap($msg,100);
				 //    $headers = "From: info@cedcab.com";
				 //    mail($to, $subject, $msg, $headers);
				 //    header('location: mailmessage.php?email=' . $value['email']);
				     $mail = new PHPMailer();

					// $mail->From = "info@cedcab.com";
					// // $mail->FromName = "Full Name";

					// $mail->addAddress($value['email']);

					// //Provide file path and name of the attachments
					// // $mail->addAttachment("file.txt", "File.txt");        
					// // $mail->addAttachment("images/profile.png"); //Filename is optional

					// $mail->isHTML(true);

					// $mail->Subject = "Reset your password on cedcab.com";
					// $mail->Body = "<i>Hi User, click on this <a href=\"new_password.php?token=" . $value['token'] . "\">link</a> to reset your password on our site</i>";
					// $mail->AltBody = "This is the plain text version of the email content";

					try {                                       
					     $mail->isSMTP(true);                                             
					    $mail->Host       = 'smtp.gmail.com';                     
					    $mail->SMTPAuth   = true;                              
					    $mail->Username   = 'mp8888719@gmail.com';                  
					    $mail->Password   = 'nationalbirds';                         
					    $mail->SMTPSecure = 'tls';                               
					    $mail->Port       = 587;   
					  
					    $mail->setFrom('pm8826336395@gmail.com', 'CedCab');            
					    $mail->addAddress($value['email']); 
					    $mail->addAddress($value['email'], 'Prashant Mishra'); 
					       
					    $mail->isHTML(true);                                   
					    $mail->Subject = 'Reset your password on cedcab.com'; 
					    $mail->Body    = 'Hi User,click on this <a href="localhost/Cab_mysql_project/new_password.php?token=' . $value["token"] . '">link</a> to reset your password on our site'; 
					    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
					    $mail->send();
					    header('location: mailmessage.php?email=' . $value['email']);
					} catch (Exception $e) {
					    echo "Mailer Error: " . $mail->ErrorInfo;
					}
									}
									
								}
		}else{
			print_r("Data doesnot match with us");
		}
	}

?>
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
			<label>Enter UserName:</label>
			<input type="text" name="username">
			<label>Enter Your Email:</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="login-btn">Submit</button>
		</div>
	</form>
	<script type="text/javascript">
		
	</script>
</body>
</html>