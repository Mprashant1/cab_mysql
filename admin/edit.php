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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">

<div class="navigation">
  <div style="border:2px solid white;width: 115px;border-radius: 50px;position: relative;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
  <a href="admin.php">Home</a>
  <div class="dropdow">
    <button class="dropbt">Manage Location 
    </button>
    <div class="dropdow-content">
      <a href="edit.php">Edit Location</a>
      <a href="addlocation.php">Add Location</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Manage Ride
    </button>
    <div class="dropdow-content">
      <a href="pendingride.php">Pending</a>
      <a href="approvedride.php">Approved</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Manage User 
    </button>
    <div class="dropdow-content">
      <a href="pending.php">Pending</a>
      <a href="approved.php">Approved</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Accounts 
    </button>
    <div class="dropdow-content">
      <a href="pending.php">Change Password</a>
      <a href="approved.php">Earningss</a>
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
                          window.location.replace("edit.php");
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
                   window.location.replace("edit.php");
                  
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
<footer class="page-footer font-small blue">
        <div class="row align-items-center">
          <div class="col">
            <ion-icon name="logo-facebook" class="icons"></ion-icon>
            <ion-icon name="logo-twitter" class="icons"></ion-icon>
            <ion-icon name="logo-instagram" class="icons"></ion-icon>
          </div>
          <div class="col">
             <span id="ced">Ced</span><span id="cab">Cab</span>
          </div>
          <div class="col">
             <div class="footer-copyright text-center" id="copy">© 2020 Copyright:
              <a href="#" class="text-dark"><span id="taxi">Cedcab.com</span></a>
            </div>
          </div>
        </div>
 </footer>
 <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
</body>
</html>