<?php
	include "user.php";
	include "ride.php";
	//session_start();
	 include_once "config.php";
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$mobile=$_POST['mobile'];
		 $User=new user();
		$db=new DBconnection();
		$user=$_SESSION['username'];
		$val=$User->updateUserData($mobile,$name,$user,$db->conn);
		echo json_encode($val);
	}
	if(isset($_POST['sub'])){
		$pastpassword=$_POST['pastpassword'];
		$newpassword=$_POST['newpassword'];
		 $User=new user();
		$db=new DBconnection();
		$user=$_SESSION['username'];
		$val=$User->updateUserPassword($pastpassword,$newpassword,$user,$db->conn);
		echo json_encode($val);
	}
	if(isset($_POST['month'])){
		$month=$_POST['month'];
		 $User=new user();
		 $loc=new Ride();
		 $db=new DBconnection();
		 $user=$_SESSION['username'];
         $sq=$loc->filterMonth($user,$month,$db->conn);
       		//print_r($sq);
       		echo json_encode($sq);
			}
	if(isset($_POST['week'])){
		$week=$_POST['week'];
		 $User=new user();
		 $loc=new Ride();
		 $db=new DBconnection();
		 $user=$_SESSION['username'];
         $sq=$loc->filterWeek($user,$week,$db->conn);
       		 //print_r($sq);
       		echo json_encode($sq);
			}
		if(isset($_POST['continue'])){
		 if(isset($_SESSION['username'])){
			$cont=$_POST['continue'];
			 $origin=$_SESSION['data']['from'];
			 $des=$_SESSION['data']['to'];
			 $total=$_SESSION['data']['total_dis'];
			 $luggage=$_SESSION['data']['luggage'];
			 $price=$_SESSION['data']['total_fare'];
			 $type=$_SESSION['data']['cab'];
			 $ride=new Ride();
			 $User=new user();
			 $db=new DBconnection();
			 // $user=$_SESSION['username'];
			 $sql=$ride->bookRide($_SESSION['username'],$origin,$des,$total,$type,$luggage,$price,$db->conn,);
	         echo json_encode($sql);
	     	}else{
				echo json_encode('error');
			}
	     }
	     if(isset($_POST['type'])){
		$type=$_POST['type'];
		 $User=new user();
		 $loc=new Ride();
		 $db=new DBconnection();
		 $user=$_SESSION['username'];
         $sq=$loc->filterCabType($user,$type,$db->conn);
       		// print_r($sq);
       		 echo json_encode($sq);
			}
			if(isset($_POST['ride_id'])){
		$id=$_POST['ride_id'];
		 $User=new user();
		 $loc=new Ride();
		 $db=new DBconnection();
         $sq=$loc->cancelRiderequest($id,$db->conn);
       		// print_r($sq);
       		 echo json_encode($sq);
			}
       		
?>