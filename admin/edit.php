<?php
	session_start();
  include "../config.php";
    require_once "location.php";
	$loc=new Location();
	$db=new DBconnection();
    $sql=$loc->editlocation($db->conn);
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
      <a href="pending.php">Change Password</a>
      <a href="approved.php">Earningss</a>
    </div>
  </div>
   <p style="float: right;margin-left: 100px;color: white;margin-top: 10px;"><?php 
  if($_SESSION){
     if($_SESSION['username']=='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='../signin.php' id='logout' style='color: white; float: right;margin-top: 3px;'>LogOut</a>";
     }else{
        header('Location:../signin.php');
     }
    }
?></p> 
</div>
	<table style="display: block;" id="table">
    <thead>
        <tr>
            <th>Location Name</th>
            <th>Distance</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php 
     //$sql=[];
       echo "<tbody>";
       foreach($sql as $sq){
        echo "<tr><td>".$sq['name']."</td>
              <td>".$sq['distance']."</td>
              <td>".$sq['is_available']."</td>
              <td><input type='button' id=".$sq['id']." value='Edit' name='edit'>
              <input type='button' id=".$sq['id']." value='Delete' name='delete'></td>
              </tr>";
       }
        echo "</tbody>";
     ?>
</table>
 <div id="result" style="display: none;border:none;"></div>
<script>
    $(document).ready(function(){
        $('input[name="edit"]').click(function(){
            var value=$(this).attr("id");
            $.ajax({
                url: 'index1.php',
                type: 'post',
                dataType:'json',
                data: {action:value},
                success: function(response) {
                  $('#result').append(response);
                  $('#result').show();
                  $('#table').hide();

                  $('input[name="update"]').click(function(){
                    var value=$(this).attr("id");
                    var loc=$('input[name="locationname"]').val();
                     var dis=$('input[name="distance"]').val();
                     var avail=$('input[name="available"]').val();
                    $.ajax({
                      url: 'index1.php',
                      type: 'post',
                      dataType:'json',
                      data: {location:value,loc:loc,dis:dis,avail:avail},
                      success: function(response) {
                        $('#result').hide();
                        console.log(response);

                      }

                    })
                })
                }
            });
        })
        $('input[name="delete"]').click(function(){
            var value=$(this).attr("id");
            $.ajax({
                url: 'index1.php',
                type: 'post',
                dataType:'json',
                data: {delete:value},
                success: function(response) {
                  console.log(response);
                }
              })
          
            /*var mobile=$('input[name="mobile"]').val();
            console.log(mobile);
            var value=$(this).attr("id");
            var name=$('input[name="name1"]').val();
            var block=$('input[name="block"]').val();
            var admin=$('input[name="admin"]').val();
            
            $.ajax({
                url: 'index2.php',
                type: 'post',
                dataType:'json',
                data: { user_id:value,name:name,mobile:mobile,block:block,admin:admin,submit:submit},
                success: function(response) {
                    console.log(response);
                },*/
            })
        
        })
</script>
</body>
</html>