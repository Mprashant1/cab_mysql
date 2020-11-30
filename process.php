<?php
	include "user.php";
	include "ride.php";
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
?>