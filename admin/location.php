<?php
	//include_once "../config.php";
	class Location{
			public $id;
			public $name;
			public $distance;
			public $is_available; 
		function addlocation($name,$distance,$conn){
			 $sql = 'INSERT INTO `tbl_location` (`name`, `distance`, `is_available`) VALUES("'.$name.'", "'.$distance.'", "1")';

		        if ($conn->query($sql) === true) {
		            //echo "New record created successfully";
		            header('Location:edit.php');
		        } else {
		            //echo "Error in register";
		        }
		        $conn->close();
		}
		function editlocation($conn){
			 $sql = "SELECT * FROM `tbl_location`";
			$result = $conn->query($sql);
				$row= array();
			if ($result->num_rows > 0) {
			  // output data of each row
			  while($a = $result->fetch_assoc())
			   {
			   	$row[]= $a;
			   }
			
			} else{
				return "no data";
			}
			
			$conn->close();
			return $row;
		}
		function Totallocation($conn){
			 $sql = "SELECT * FROM `tbl_location`";
			$result = $conn->query($sql);
			$row=array();
			if ($result->num_rows > 0) {
			  	$res=$result->num_rows;
			  // output data of each row
			  	while($a=$result->fetch_assoc()){
			  			$row[]=$a;
			  	}
			
			} else{
				//echo "no data";
				$res=0;
			}
			$return=array(
							'data'=>$row,
							'count'=>$res,
						);
			return $return;
			$conn->close();
			
		}
		function updatelocation($id,$conn){
			$sql = 'SELECT * FROM `tbl_location` where `id`="'.$id.'"';
			   $result = $conn->query($sql);
			   $text="";
			   if ($result->num_rows > 0) {
			   		$text .= "<form>";
			   	 while($row = $result->fetch_assoc()){
			   	 	$usercode = str_replace(' ', '', $row['name']);
			   	 	$text .= "Location Name:<input type='text' value=".$usercode." name='locationname'><br>
			   	 	   Distance:<input type='text' value=".$row['distance']." name='distance'><br>
			   	 	   Available:<input type='text' value=".$row['is_available']." name='available'><br>
			   	 	   <input type='button' name='update' id=".$row['id']." value='Edit'>";
			   	}
			   }else {
			   		//echo "Data edit Failed";
			   	}
			   	$text .= "</form>";
			   	return $text;
			   	$conn->close();
		}
		function EditedLocation($avail,$dis,$locate,$id,$conn){
				$sql = "UPDATE `tbl_location` SET `name`='$locate' ,`distance` = ".$dis." ,`is_available` = ".$avail." WHERE `id`=".$id."";

				if ($conn->query($sql) === TRUE) {
				  $value="Record updated successfully";
				} else {
				  $value="Error updating record: " . $conn->error;
				}
				return $value;
				$conn->close();
		}
		function DeletedLocation($id,$conn){
				$sql = "DELETE FROM `tbl_location` WHERE `id`= $id";

				if ($conn->query($sql) === TRUE) {
				  //echo "Record deleted successfully";
				} else {
				  //echo "Error deleting record: " . $conn->error;
				}

				$conn->close();
		}
		function SetLocation($conn){
				$sql = "SELECT `name` FROM `tbl_location`";
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
	}



?>