<?php
	session_start();
  include "location.php";
  include "../config.php";
	 $ride=new Location();
     $d=new DBconnection();
     $sq=$ride->Totallocation($d->conn);
    //$s=$User->update($db->conn);   
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="resources/css/demo.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="navbar">
  <a href="admin.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Manage Location 
    </button>
    <div class="dropdown-content">
      <a href="edit.php">Edit Location</a>
      <a href="addlocation.php">Add Location</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Manage Ride
    </button>
    <div class="dropdown-content">
      <a href="pendingride.php">Pending</a>
      <a href="approvedride.php">Approved</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Manage User 
    </button>
    <div class="dropdown-content">
      <a href="pending.php">Pending</a>
      <a href="approved.php">Approved</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Accounts 
    </button>
    <div class="dropdown-content">
      <a href="adminPasswordChange.php">Change Password</a>
    </div>
  </div> 
  <p style="float: right;margin-left: 100px;color: white;margin-top: 10px;"><?php 
  if($_SESSION){
     if($_SESSION['username']=='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='../logout.php' id='logout' style='color: white; float: right;margin-top: 3px;'>LogOut</a>";
     }else{
        header('Location:../signin.php');
     }
    }
?></p> 
</div>
	<table style="display: block;">
    <thead>
        <tr>
            <th>Location Id</th>
            <th>Location Name</th>
            <th>Distance</th>
            <th>Availability</th>
        </tr>
    </thead>
   <?php 
         echo "<tbody>";
       foreach($sq['data'] as $s){
        echo "<tr><td>".$s['id']."</td>
              <td>".$s['name']."</td>
              <td>".$s['distance']."</td>
               <td>".$s['is_available']."</td>
              </tr>";
       }
        echo "</tbody>";
     ?>
</table>
<!-- <script>
    $(document).ready(function(){
        $('input[type="button"]').click(function(){
            var value=$(this).attr("id");
            //console.log($(this).attr("id"));
            $.ajax({
                url: 'index.php',
                type: 'post',
                dataType:'json',
                data: {action:value},
                success: function(response) {
                    console.log(response); 
                    //console.log($s); 
                }
            });
        })
    })
</script> -->
</body>
</html>