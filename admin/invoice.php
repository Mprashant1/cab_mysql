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
<div class="row panel panel-default" style="background-color: lightgrey;">
<div class="text-center panel-heading" style="background-image: linear-gradient(to left ,lightgreen,white,grey, yellow,deeppink);"><h1 style="color: black;">Invoice</h1></div>
<div class="panel-body">
<div class="col-md-6 col-lg-6" style="margin-left: 50px;">
<h3>Date:</h3>
<h3>Ride Id:</h3>
<h3>From:</h3>
<h3>To:</h3>
<h3>Total Distance: </h3>
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