<?php
	session_start();
	include_once "config.php";
	class user{
		public $userId;
		public $username;
		public $name;
		public $dateofsignup;
		public $mobile;
		public $isblock;
		public $password;
		public $isadmin;


		function login($username,$password,$conn){
			$sql = 'SELECT * FROM `tbl_user` where`user_name`="'.$username.'" AND `password`="'.md5($password).'"' ;
			   $result = $conn->query($sql);
			   if ($result->num_rows > 0) {
			   	 //$_SESSION['username']=$username;
			   	 //$_SESSION['isadmin']=;
			   	 while($row = $result->fetch_assoc()){
			   	 if($row['isadmin']==1){
			   	 	$_SESSION['username']=$username;
			   	 	header('Location:admin/admin.php');
			   	 }elseif($row['isblock']==1){
			   	 	$rtn="U r blocked pls contact admin!!!";
			   	 	
			   	 }else{
			   	 	$_SESSION['username']=$username;
			   	 	header('Location:index.php');
			   	 }
			   	}
			   	 
			   	}else{
			   		$rtn="Login Failed";
			   	}
			   	return $rtn;
		}
		function register($username,$password,$name,$mobile,$conn){
			 $sql = 'INSERT INTO `tbl_user` (`user_name`, `password`, `mobile`,`name`,`isblock`,`isadmin`) VALUES("'.$username.'", "'.md5($password).'", "'.$mobile.'","'.$name.'","0","0")';

		        if ($conn->query($sql) === true) {
		            //echo "New record created successfully";
		            header('Location:signin.php');
		        } else {
		            //echo "Error in register";
		        }
		        $conn->close();
		}
		function pendingUser($conn){
			$sql = 'SELECT * FROM `tbl_user` where `isblock`=1 and `isadmin`=0';
			   $result = $conn->query($sql);
			   $text="";
			   if ($result->num_rows > 0) {
			   	$res=$result->num_rows;
			   		echo "<tbody>";
			   	 while($row = $result->fetch_assoc()){
			   	 	$text .= "<tr><td>".$row['user_id']."</td><td>".$row['user_name']."</td><td>".$row['name']."</td><td>".$row['mobile']."</td><td>".$row['isblock']."</td><td>".$row['isadmin']."</td><td ><a href='#' name='yes' id=".$row['user_id'].">Yes</a><a href='#' name='no' id=".$row['user_id'].">No</a></td></tr>";
	
			   	}//echo "Registered success";
			   }

			   	else {
			   		//echo "Register Failed";
			   		$res=0;
			   	}
			   	$text .= "</tbody>";
			   	$arr=array(
			   				'text'=>$text,
			   				'pend'=>$res,
			   			);
			   	return $arr;
			   	$conn->close();
		}
		function approvedUser($conn){
			$sql = 'SELECT * FROM `tbl_user` where `isblock`=0 and `isadmin`=0';
			//$count = 'SELECT COUNT(*) FROM `tbl_user` where `isblock`=0 and `isadmin`=0';
			 $result=$conn->query($sql);
			   $text="";
			   if ($result->num_rows > 0) {
			   	$res=$result->num_rows;
			   		echo "<tbody>";
			   	 while($row = $result->fetch_assoc()){
			   	 	$text .= "<tr><td>".$row['user_id']."</td><td>".$row['user_name']."</td><td>".$row['name']."</td><td>".$row['mobile']."</td><td>".$row['isblock']."</td><td>".$row['isadmin']."</td></tr>";
	
			   	}//echo "Registered success";
			   }

			   	else {
			   		//echo "Register Failed";
			   	}
			   	$text .= "</tbody>";
			   	$arr=array(
			   				'text'=>$text,
			   				'count'=>$res,
			   			);
			   	return $arr;
			   	$conn->close();
		}
		function update($id,$conn){
				$sql = 'UPDATE `tbl_user` SET `isblock`=0 WHERE `user_id`="'.$id.'"';

				if ($conn->query($sql) === TRUE) {
				  $value="Record updated successfully";
				} else {
				  $value="Error updating record: " . $conn->error;
				}

				return $value;
				$conn->close();
		}
		function edit($id,$conn){
			$sql = 'SELECT * FROM `tbl_user` where `user_id`="'.$id.'"';
			   $result = $conn->query($sql);
			   $text="";
			   if ($result->num_rows > 0) {
			   			echo "<form method='post'>";
			   	 while($row = $result->fetch_assoc()){
			   	 	$text .= "User Name:<input type='text' value=".$row['user_name']." name='username'><br>Name:<input type='text' value=".$row['name']." name='name1'><br>Mobile<input type='text' value=".$row['mobile']." name='mobile'><br>Is Block<input type='text' value=".$row['isblock']." name='block'><br>Is Admin<input type='text' value=".$row['isadmin']." name='admin'><br><button name='update'id=".$row['user_id'].">Edit</button>";
			   	}
			   }else {
			   		//echo "Data edit Failed";
			   	}
			   	$text .= "</form>";
			   	return $text;
			   	$conn->close();
		}
		function updateData($id,$user,$name,$mobile,$block,$admin,$conn){
			$sql = 'UPDATE `tbl_user` SET `name`="'.$name.'" `mobile`="'.$mobile.'" `isblock`="'.$block.'" `isadmin`="'.$admin.'" WHERE id="'.$id.'"';

			if ($conn->query($sql) === TRUE) {
			  $rtn ="Record updated successfully";
			} else {
			  $rtn="Error updating record: " . $conn->error;
			}
			return $rtn;
			$conn->close();
		}
		function FetchUser($user,$conn){
			$sql = 'SELECT * FROM `tbl_user` where `user_name`="'.$user.'"';
			$result = $conn->query($sql);
				$row=array();
			if ($result->num_rows > 0) {
			  // output data of each row
			  while($a = $result->fetch_assoc()) {
			    $row[]=$a;
			  }
			} else {
			  //echo "0 results";
			}
			//print_r($row);
			return $row;
			$conn->close();
		}
		function updateUserData($mobile,$name,$user,$conn){
			$sql = 'UPDATE `tbl_user` SET `name`="'.$name.'" ,`mobile`="'.$mobile.'" WHERE `user_name`="'.$user.'"';

			if ($conn->query($sql) === TRUE) {
			  $rtn ="Record updated successfully";
			} else {
			  $rtn="Error updating record: " . $conn->error;
			}
			return $rtn;
			$conn->close();
		}
		function updateUserPassword($pastpassword,$newpassword,$user,$conn){
			$sql = 'UPDATE `tbl_user` SET `password`="'.md5($newpassword).'" WHERE `user_name`="'.$user.'" and `password`="'.md5($pastpassword).'"';
			print_r($sql);

			if ($conn->query($sql) === TRUE) {
			  $rtn ="Password updated successfully";
			} else {
			  $rtn="Error updating record: " . $conn->error;
			}
			return $rtn;
			$conn->close();
		}
		function updateAdminPassword($pastpassword,$newpassword,$user,$conn){
			$sql = 'UPDATE `tbl_user` SET `password`="'.md5($newpassword).'" WHERE `user_name`="'.$user.'" and `password`="'.md5($pastpassword).'"';
			print_r($sql);

			if ($conn->query($sql) === TRUE) {
			  $rtn ="Password updated successfully";
			} else {
			  $rtn="Error updating record: " . $conn->error;
			}
			return $rtn;
			$conn->close();
		}
	function UserSortedResult($value,$conn){
			if($value=='ascending_user'){
					$sql='SELECT * FROM `tbl_user` where `isblock` = 0 ORDER BY `user_name`';
					$result = $conn->query($sql);
					$row=array();
					if ($result->num_rows > 0) {
				  while($a = $result->fetch_assoc()) {
				     $row[]=$a;
				  }
				 } else {
				   $row['error']="Error";
				 }
				 $res=array(
				 			'value'=>'0',
				 			'result'=>$row,
				 			);
					return $res;
					}elseif($value=='descending_user'){
						$sql='SELECT * FROM `tbl_user` where `isblock` = 0 ORDER BY `user_name` DESC ';
						$result = $conn->query($sql);
						$row=array();
						if ($result->num_rows > 0) {
					  while($a = $result->fetch_assoc()) {
					     $row[]=$a;
					  }
					 } else {
					   $row['error']="Error";
					 }
					$res=array(
				 			'value'=>'1',
				 			'result'=>$row,
				 			);
					return $res;
					$conn->close();
					}
		}
	}
	
?>