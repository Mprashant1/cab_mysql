<?php
  //session_start();
  include_once "../ride.php";
  include_once "../user.php";
  include_once "../config.php";
  require_once "location.php";
   $ride=new Ride();
   $User=new user();
     $d=new DBconnection();
     $db=new DBconnection();
     $s1=$ride->pendingride($d->conn);
      $s2=$User->pendingUser($db->conn);
      $s3=$User->approvedUser($db->conn);
      $sql=$ride->approvedRide($d->conn);
      $sq=$ride->countApprovedRide($d->conn);
      $earn=$ride->TotalEarning($d->conn);
      $loss=$ride->Totalloss($d->conn);
      $cancel=$ride->cancelledRide($d->conn);
      //print_r($cancel);
      $loc=new Location();
      $s=$loc->Totallocation($db->conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="resources/css/demo.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
  <div class="grid-layout">
    <div class="item span-2" style="text-align: center;" id="aprUser"><h3>Approved Users:</h3><span style="color: green;font-size: 50px;"><?php echo $_SESSION['count']=$s3['count'];?></span></div>
    <div class="item span-2" style="text-align: center;" id="penUser"><h3>Pending Users:</h3><span style="color: green;font-size: 50px;"><?php echo  $_SESSION['pend']=$s2['pend'];?></span></div>
    <div class="item span-2" style="text-align: center;" id="penRide"><h3>Ride Requests:</h3><span style="color: green;font-size: 50px;"><?php echo $_SESSION['request']=$s1['count'];?></span></div>
    <div class="item span-2" style="text-align: center;" id="aprRide"><h3>Confirmed Ride:</h3><span style="color: green;font-size: 50px;"><?php $_SESSION['confirm']=$sq;
    echo $_SESSION['confirm'];?></div>
    <div class="item span-2" style="text-align: center;" id="availLoc"><h3>Available Location:</h3><span style="color: green;font-size: 50px;"><?php $_SESSION['location']=$s['count'];
    echo $_SESSION['location'];?></div>
    <div class="item span-2" style="text-align: center;" id="totalearn"><h3>Total Earnings:</h3><span style="color: green;font-size: 50px;"><?php $_SESSION['earning']=$earn['total'];
    echo "Rs.".$_SESSION['earning'];?></div>
    <div class="item span-2" style="text-align: center;" id="totalloss"><h3>Total Loss:</h3><span style="color: green;font-size: 50px;"><?php $_SESSION['loss']=$loss['loss'];
    echo "Rs.".$_SESSION['loss'];?></div>
    <div class="item span-2" style="text-align: center;" id="loss"><h3>Cancelation:</h3><span style="color: green;font-size: 50px;"><?php $_SESSION['cancel']=$cancel;
    echo $_SESSION['cancel'];?></div>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#aprUser').click(function(){
          window.location.replace("approved.php");
        })
        $('#penUser').click(function(){
          window.location.replace("pending.php");
        })
        $('#penRide').click(function(){
          window.location.replace("pendingride.php");
        })
        $('#aprRide').click(function(){
          window.location.replace("approvedride.php");
        })
        $('#totalearn').click(function(){
          window.location.replace("approvedride.php");
        })
        $('#totalloss').click(function(){
          window.location.replace("loss.php");
        })
        $('#loss').click(function(){
          window.location.replace("loss.php");
        })
        $('#aprRide').click(function(){
          window.location.replace("approvedride.php");
        })
         $('#availLoc').click(function(){
          window.location.replace("availLocation.php");
        })
      })
    </script>
    
</body>
</html>
