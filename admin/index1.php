<?php
	require_once "../user.php";
	$db=new DBconnection();
	if(isset($_POST['id'])){
			$id=$_POST['id'];
			$user=new user();
			$result = $user->edit($id,$db->conn);
			echo ($result);
		}
	require_once "location.php";
	if(isset($_POST['action'])){
			$id=$_POST['action'];
			$loc=new Location();
			$db=new DBconnection();
			$result = $loc->updatelocation($id,$db->conn);
			echo json_encode($result);
		}
	if(isset($_POST['location'])){
			$id=$_POST['location'];
			$locate=$_POST['loc'];
			$dis=$_POST['dis'];
			$avail=$_POST['avail'];
			$loc=new Location();
			$db=new DBconnection();
			$result = $loc->EditedLocation($avail,$dis,$locate,$id,$db->conn);
			echo json_encode($result);
		}
	if(isset($_POST['delete'])){
			$id=$_POST['delete'];
			$loc=new Location();
			$db=new DBconnection();
			$result = $loc->DeletedLocation($id,$db->conn);
			echo json_encode($result);
		}
	if(isset($_POST['submit'])){
		$pastpassword=$_POST['past'];
		$newpassword=$_POST['newpassword'];
		$User=new user();
		$db=new DBconnection();
		$user=$_SESSION['username'];
		$val=$User->updateUserPassword($pastpassword,$newpassword,$user,$db->conn);
		echo json_encode($val);
	}
   

?>