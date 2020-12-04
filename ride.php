<?php
	//session_start();
	include_once "config.php";

	class Ride{
		public $rideId;
		public $user;
		public $ridedate;
		public $from;
		public $to;
		public $totaldistance;
		public $luggage;
		public $totalfare;
		public $status;
		public $customerid;
		function bookRide($user,$from,$to,$total,$type,$luggage,$price,$conn){
			$date = date('Y/m/d');
			$sql = 'INSERT INTO `tbl_ride` (`ride_date`, `from`, `to`,`total_distance`,`luggage`,`total_fare`,`status`,`cab_type`,`customer_user_id`)
			VALUES ("'.$date.'", "'.$from.'", "'.$to.'","'.$total.'","'.$luggage.'","'.$price.'","1","'.$type.'",(SELECT `user_id` FROM `tbl_user` where `user_name`="'.$user.'"))';
			//echo $sql;

			if ($conn->query($sql) === TRUE) {
			  $r="New record created successfully";
			} else {
			  $r= "Error: " . $sql . "<br>" . $conn->error;
			}
			return $r;
			$conn->close();
		}
		function pendingride($conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status`=1';
			   $result = $conn->query($sql);
			   $text="";
			   if ($result->num_rows > 0) {
			   	$res=$result->num_rows;
			   		echo "<tbody>";
			   	 while($row = $result->fetch_assoc()){
			   	 	$text .= "<tr><td>".$row['ride_id']."</td><td>".$row['ride_date']."</td><td>".$row['from']."</td><td>".$row['to']."</td><td>".$row['total_distance']."</td><td>".$row['luggage']."</td><td>".$row['total_fare']."</td><td>".$row['status']."</td><td>".$row['cab_type']."</td><td>".$row['customer_user_id']."</td><td ><input type='button' name='yes' id=".$row['ride_id']." value='Yes'><input type='button' name='no' id=".$row['ride_id']." value='No'></td></tr>";
	
			   	}//echo "Registered success";
			   }

			   	else {
			   		//echo "Register Failed";
			   		$res=0;
			   	}
			   	$text .= "</tbody>";
			   	$arr=array(
			   				'text'=>$text,
			   				'count'=>$res,
			   			);
			   	return $arr;
			   	$conn->close();
		}
		function updateRiderequest($id,$conn){
				$sql = 'UPDATE `tbl_ride` SET `status`=2 WHERE `ride_id`="'.$id.'"';

				if ($conn->query($sql) === TRUE) {
				  $value="Record updated successfully";
				} else {
				  $value="Error updating record: " . $conn->error;
				}
				return $value;
				$conn->close();
		}
		function cancelRiderequest($id,$conn){
				$sql = 'UPDATE `tbl_ride` SET `status`=0 WHERE `ride_id`="'.$id.'"';

				if ($conn->query($sql) === TRUE) {
				  $value="Record updated successfully";
				} else {
				  $value="Error updating record: " . $conn->error;
				}
				return $value;
				$conn->close();
		}
		function approvedRide($conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status`=2';
			   $result = $conn->query($sql);
			   //$text="";
			   $row=array();
			   if ($result->num_rows > 0) {
			   		//echo "<tbody>";
			   	 while($a = $result->fetch_assoc()){
			   	 	$row[]=$a;
			   	 	/*$text .= "<tr><td>".$row['user_id']."</td><td>".$row['user_name']."</td><td>".$row['name']."</td><td>".$row['mobile']."</td><td>".$row['isblock']."</td><td>".$row['isadmin']."</td><td ><input type='button' name='edit' id=".$row['user_id']." value='Edit'></td><td><input type='button' name='delete' id=".$row['user_id']." value='Delete'></td></tr>";*/
	
			   	}//echo "Registered success";
			   }

			   	else {
			   		//echo "Register Failed";
			   	}
			   	//$text .= "</tbody>";
			   	return $row;
			   	$conn->close();
		}
		function cancelledRide($conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status`=0';
			   $result = $conn->query($sql);
			   //$text="";
			   if ($result->num_rows > 0) {
			   		//echo "<tbody>";
			   	 $row=$result->num_rows;
			   	 	
			   	 	/*$text .= "<tr><td>".$row['user_id']."</td><td>".$row['user_name']."</td><td>".$row['name']."</td><td>".$row['mobile']."</td><td>".$row['isblock']."</td><td>".$row['isadmin']."</td><td ><input type='button' name='edit' id=".$row['user_id']." value='Edit'></td><td><input type='button' name='delete' id=".$row['user_id']." value='Delete'></td></tr>";*/
	
			   	//echo "Registered success";
			   }

			   	else {
			   		//echo "Register Failed";
			   	}
			   	//$text .= "</tbody>";
			   	return $row;
			   	$conn->close();
		}
		function countApprovedRide($conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status`=2';
			   $result = $conn->query($sql);
			   if ($result->num_rows > 0) {
			   		$res=$result->num_rows;}
			   		else{
			   			$res=0;
			   		}
			   		return $res;
		}
		function LossEarningData($conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status`=0';
			   $result = $conn->query($sql);
			   $row=array();
			   if ($result->num_rows > 0) {
			   	while($a = $result->fetch_assoc()){
			   	 	$row[]=$a;
			   	 	}//echo "Registered success";
			   }else {
			   		//echo "Register Failed";
			   	}
			   	//$text .= "</tbody>";
			   	return $row;
			   	$conn->close();
			   		
		}
		function TotalEarning($conn){
			$sql = 'SELECT sum(`total_fare`)as total FROM `tbl_ride` where `status`=2';
			   $result = $conn->query($sql);
			   if ($result->num_rows > 0) {
				$row=$result->fetch_assoc();
			 }
			return $row;
			$conn->close();
		}
		function Totalloss($conn){
			$sql = 'SELECT sum(`total_fare`)as loss FROM `tbl_ride` where `status`=0';
			   $result = $conn->query($sql);
			   if ($result->num_rows > 0) {
				$row=$result->fetch_assoc();
			 }
			return $row;
			$conn->close();
		}
		function PendingUserRide($username,$conn){
			$sql = 'SELECT * FROM `tbl_ride` where `customer_user_id` =(select `user_id` from `tbl_user` where `user_name`="'.$username.'") and `status`=1';
			$result = $conn->query($sql);
				$row=array();
			if ($result->num_rows > 0) {
			  // output data of each row
			  while($a = $result->fetch_assoc()) {
			     $row[]=$a;
			  }
			} else {
			  echo "0 results";
			}
			return $row;
			$conn->close();
		}
		function CompletedUserRide($username,$conn){
			$sql = 'SELECT * FROM `tbl_ride` where `status` = 2 and `customer_user_id` =(select `user_id` from `tbl_user` where `user_name`="'.$username.'")';
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
			return $row;
			$conn->close();
		}
		function AllUserRide($username,$conn){
			$sql = 'SELECT * FROM `tbl_ride` where`customer_user_id` =(select `user_id` from `tbl_user` where `user_name`="'.$username.'")';
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
			return $row;
			$conn->close();
		}
		function Totalspent($username,$conn){
			$sql = 'SELECT sum(`total_fare`) FROM `tbl_ride` where`customer_user_id` =(select `user_id` from `tbl_user` where `user_name`="'.$username.'")';
			$result = $conn->query($sql);
			 //print_r($result);
				 //$row=array();
			if ($result->num_rows > 0) {
				$row=$result->fetch_assoc();
			  // output data of each row
			//   while($a = $result->fetch_assoc()) {
			//      $row[]=$a;
			//   }
			// } else {
			//   echo "0 results";
			 }
			return $row;
			$conn->close();
		}
		function filterMonth($user,$month,$conn){
			$sql = 'SELECT `ride_date`,`from`,`to`,`total_distance`,`total_fare`,`status`,MONTHNAME(`ride_date`)as monthname FROM `tbl_ride` where MONTH(ride_date) = MONTH(NOW()-INTERVAL "'.$month.'" month) and `customer_user_id` =(select `user_id` from `tbl_user` where `user_name`="'.$user.'")';
			$result = $conn->query($sql);
			 //print_r($result);
				 $row=array();
			if ($result->num_rows > 0) {
				//$row=$result->fetch_assoc();
			  // output data of each row
			  while($a = $result->fetch_assoc()) {
			     $row[]=$a;
			  }
			 } else {
			   $row['error']='error';
			 }
			return $row;
			$conn->close();
		}
		function filterWeek($user,$week,$conn){
			 $sql = 'SELECT `ride_date`,`from`,`to`,`total_distance`,`total_fare`,`status`,MONTHNAME(`ride_date`)as monthname FROM `tbl_ride` where DATE(ride_date) = DATE_SUB(CURDATE(), INTERVAL "'.$week.'" day) and `customer_user_id` = (select `user_id` from `tbl_user` where `user_name`="'.$user.'")';
			 //print_r($sql);
			$result = $conn->query($sql);
			 //print_r($result);
				 $row=array();
			if ($result->num_rows > 0) {
				//$row=$result->fetch_assoc();
			  // output data of each row
			  while($a = $result->fetch_assoc()) {
			     $row[]=$a;
			  }
			 } else {
			   $row['error']='error';
			 }
			return $row;
			$conn->close();
		}
		function FareSortedResult($value,$conn){
				if($value=='ascending_fare'){
					$sql='SELECT * FROM `tbl_ride` where `status` = 2 ORDER BY ABS(`total_fare`)';
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
					}elseif($value=='descending_fare'){
						$sql='SELECT * FROM `tbl_ride` where `status` = 2 ORDER BY ABS(`total_fare`) DESC ';
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
		function DateSortedResult($value,$conn){
				if($value=='ascending_date'){
					$sql='SELECT * FROM `tbl_ride` where `status` = 2 ORDER BY `ride_date`';
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
					}elseif($value=='descending_date'){
						$sql='SELECT * FROM `tbl_ride` where `status` = 2 ORDER BY `ride_date` DESC ';
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
		function invoiceGenerate($id,$conn){
			$sql = 'SELECT * FROM `tbl_ride` where `ride_id` ="'.$id.'"';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				  while($a = $result->fetch_assoc()) {
				     $row[]=$a;
				  }
				 } else {
				   $row['error']="Error";
				 }
				 // $res=array(
				 // 			'value'=>'0',
				 // 			'result'=>$row,
				 // 			);
					return $row;
		}
		function filterCabType($user,$type,$conn){
			$sql = 'SELECT * FROM `tbl_ride` where `customer_user_id` = (select `user_id` from `tbl_user` where `user_name`="'.$user.'") and `cab_type` ="'.$type.'" and `status` = 2';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				  while($a = $result->fetch_assoc()) {
				     $row[]=$a;
				  }
				 } else {
				   $row['error']="Error";
				 }
				  // $res=array(
				  // 			'error'=>'error',
				  // 			'result'=>$row,
				  // 			);
					return $row;
		}
		
	}
?>