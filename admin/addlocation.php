<?php
  session_start();
  require_once "location.php";
//$errors=array();
if(isset($_POST['submit'])) {
    $name=isset($_POST['location'])?$_POST['location']:'';
    $distance=isset($_POST['distance'])?$_POST['distance']:'';
    $loc=new Location();
    $db=new DBconnection();
    $sql=$loc->addlocation($name,$distance,$db->conn);
    echo $sql;
    echo $_SESSION['username'];
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="resources/css/demo.css">

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
<div id="main">
        <h1>Add Location</h1>
        <form id="location" action="" method="POST">
            Location:<p><input type="text"  name="location"></p>
            distance:<p><input type="text"  name="distance"></label></p>
            <p><input type="submit" name="submit" value="Add Location"></p>
        </form>
</div>
</body>
</html>
