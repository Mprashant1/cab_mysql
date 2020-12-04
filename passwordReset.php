<?php
	//session_start();
	include_once "config.php";

	class PasswordReset{
		public $passId;
		public $email;
		public $username;
		public $token;
		
		function InsertData($user,$email,$token,$conn){
			$sql = 'INSERT INTO `tbl_password_reset` (`email`, `user_name`,`token`)
			VALUES ("'.$email.'", "'.$user.'","'.$token.'")';
			//echo $sql;

			if ($conn->query($sql) === TRUE) {
			  $r=1;
			} else {
			  $r=0;
			}
			return $r;
			$conn->close();
		}
		function FetchData($user,$conn){
			$sql = 'SELECT * FROM `tbl_password_reset` where `user_name`="'.$user.'"';
			   $result = $conn->query($sql);
			   $row=array();
			   if ($result->num_rows > 0) {
			   		while($a = $result->fetch_assoc()){
			   	 	$row[]=$a;
	
			   	}//echo "Registered success";
			   }
			   	else {
			   		//echo "Register Failed";
			   	}
			   	//$text .= "</tbody>";
			   	return $row;
			   	$conn->close();
			   		}
		function UpdatePassword($token,$password,$conn){
			$sql = 'UPDATE `tbl_user` SET `password`="'.md5($password).'" WHERE `user_name`=(select `user_name` from `tbl_password_reset` where `token`="'.$token.'")';

				if ($conn->query($sql) === TRUE) {
				  $value="Record updated successfully";
				} else {
				  $value="Error updating record: " . $conn->error;
				}
				return $value;
				$conn->close();
		}


		}