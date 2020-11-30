<?php
	require_once "../user.php";
	require_once "../ride.php";
	$db=new DBconnection();
	if(isset($_POST['id'])){
			$id=$_POST['id'];
			$user=new user();
			$result = $user->update($id,$db->conn);
			echo json_encode($result);
		}

	
	if(isset($_POST['action'])){
			$id=$_POST['action'];
			$ride=new Ride();
		     //$d=new DBconnection();
		     $result=$ride->updateRiderequest($id,$db->conn);
			echo json_encode($result);
		}
	if(isset($_POST['act'])){
			$id=$_POST['act'];
			$ride=new Ride();
		     //$d=new DBconnection();
		     $result=$ride->cancelRiderequest($id,$db->conn);
			echo json_encode($result);
		}
	if(isset($_POST['sort_fare'])){
			$value=$_POST['sort_fare'];
			$ride=new Ride();
		     //$d=new DBconnection();
		     $result=$ride->FareSortedResult($value,$db->conn);
		     //print_r($result);
			echo json_encode($result);
		}
	if(isset($_POST['sort_date'])){
			$value=$_POST['sort_date'];
			$ride=new Ride();
		     //$d=new DBconnection();
		     $result=$ride->DateSortedResult($value,$db->conn);
		     //print_r($result);
			echo json_encode($result);
		}
	if(isset($_POST['sort_user'])){
			$value=$_POST['sort_user'];
			$ride=new user();
		     //$d=new DBconnection();
		     $result=$ride->UserSortedResult($value,$db->conn);
		     //print_r($result);
			echo json_encode($result);
		}

?>