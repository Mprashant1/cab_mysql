<?php
require_once "../user.php";
if(isset($_POST['update'])){
			$id=$_POST['user_id'];
			$name=$_POST['name1'];
			$mobile=$_POST['mobile'];
			$block=$_POST['block'];
			$admin=$_POST['admin'];
			$user=new user();
			$db=new DBconnection();
			$result = $user->updateData($id,$user,$name,$mobile,$block,$admin,$db->conn);
			echo json_encode($result);
		}
?>