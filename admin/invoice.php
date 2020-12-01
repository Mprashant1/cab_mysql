<?php
	session_start();
  include "../ride.php";
	 $ride=new Ride();
     $d=new DBconnection();
     $id=$_GET['id'];
     $sql=$ride->invoiceGenerate($id,$d->conn);
     //print_r($sql);

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
         echo "<a href='../signin.php' id='logout' style='color: white; float: right;margin-top: 3px;'>LogOut</a>";
     }else{
        header('Location:../signin.php');
     }
    }
?></p> 
</div>
<div class="row panel panel-default" style="background-color: lightgrey;">
<div class="text-center panel-heading" style="background-image: linear-gradient(to left ,lightgreen,white,grey, yellow,deeppink);"><h1 style="color: black;">Invoice</h1></div>
<div class="panel-body">
<div class="col-md-6 col-lg-6" style="margin-left: 50px;">
<h3>Date:</h3>
<h3>Ride Id:</h3>
<h3>From:</h3>
<h3>To:</h3>
<h3>Total Distance: </h3>
<h3>Total Fare: </h3>
<!-- <h3>CabType: </h3> -->
<h3>Luggage:</h3>
</div>
<div class="col-md-6 col-lg-6" style="position: absolute;left: 400px;top: 85px;margin:10px;padding-top:10 px;color: green;">
<?php foreach($sql as $data) {
?>
<h3><?php echo $data['ride_date']; ?></h3>
<h3><?php echo $data['ride_id']; ?></h3>
<h3><?php echo $data['from']; ?></h3>
<h3><?php echo $data['to']; ?></h3>
<h3><?php echo $data['total_distance']; ?></h3>
<h3><?php echo $data['luggage']; ?> &#13199;</h3>


<?php
} ?>
</div>
</div>
<div class="panel-footer text-center" style="margin-left: 50px;">
<h2>Total Fare:Rs.<?php echo ucfirst($data['total_fare']); ?></h2>
</div>
</div>
</body>
</html>