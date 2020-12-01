<?php 
    include "user.php";
    include "ride.php";
    include_once "config.php";
    include "admin/location.php";
    //session_start();
    $User=new user();
    $db=new DBconnection();
    $loc=new Ride();
    $username=$_SESSION['username'];
    $sq=$loc->filterMonth($username,$db->conn);
   //print_r($sq);
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Register
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script type="text/javascript">
        
        function myfun(){
            var cab=document.getElementById('cab-type').value;
            
            if(cab==='CedMicro'){
                 let luggage = document.getElementById('luggage');
                luggage.setAttribute("disabled", true);
            }else{
                    luggage.removeAttribute("disabled", false);   
                    }
        }
        $(document).ready(function() {
            
            $('#submit').click(function(ev) {
                var pick=document.getElementById('pickup').value;
                var drop=document.getElementById('drop').value;
                var luggage_value=document.getElementById('luggage').value;
                var cab=document.getElementById('cab-type').value;
                    
                  if (pick == "PickUp") {
                    console.log("Pick Up point mandatory!!!");
                    }
                    else if(drop=="Drop"){
                        console.log("Drop point mandatory!!!");
                    }else if(cab=="Cab Type"){
                        console.log("Cab Type must be choosen!!!");

                    }if(isNaN(luggage_value)  || luggage_value ==""){
                       alert("Luggage value must be numeric and not be blank!!!");
                       return;
                    }else if(cab==='CedMicro'){
                        document.getElementById('luggage').value=0;
                    }
                    ev.preventDefault();
                    $.ajax({
                    url: "process1.php",
                    type: "post",
                    dataType:'json',
                    data:{p:pick, d:drop, l:luggage_value, c:cab},
                    success: function(result) {
                        if(result==="error"){
                            window.location.replace("signin.php");
                        }else{
                            window.location.replace("book.php");
                        }
                    },
                });
            });
            $('#logout').click(function(){
                 //session_destroy();
                window.location.replace("signin.php");
            })
        })
        
    </script>
</head>
<body>
    
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="book.php">Book Ride</a>
  <div class="dropdown">
    <button class="dropbtn">Ride
    </button>
    <div class="dropdown-content">
      <a href="PendingRide.php">Pending Ride</a>
      <a href="CompleteRide.php">Completed Rides</a>
      <a href="AllRide.php">All Rides</a>
      <a href="CompleteRide.php">Total Spent</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Accounts
    </button>
    <div class="dropdown-content">
      <a href="#">Update information</a>
      <a href="#">Change Password</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Filters
    </button>
    <div class="dropdown-content">
      <a href="filterMonth.php">By Months</a>
      <a href="filterWeek.php">By Weeks</a>
    </div>
  </div> 
  <p style="float: right;margin-left: 100px;color: white;margin-top: 10px;"><?php 
  if($_SESSION){
    echo $_SESSION['username'];
    echo "<a href='signin.php' id='logout' style='color: white; float: left;'>LogOut</a>";
    }
    else{
        echo "<a href='signin.php'>Login</a>";
    }
?></p>

</div>
</div>
    <div id="main">
       <table>
    <thead>
        <tr>
            <th>Ride Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Total Fare</th>
            <th>Status</th>
            <th>Month Name</th>
        </tr>
    </thead>
   <?php 
        echo "<tbody>";
       foreach($sq as $s){
        if($s['status']==2){
           $val="Completed";
        }else if($s['status']==1){
           $val="Pending";
        }else{
          $val="Cancelled";
        }
        echo "<tr>
              <td>".$s['ride_date']."</td>
              <td>".$s['from']."</td>
               <td>".$s['to']."</td>
                <td>".$s['total_distance']."</td>
                  <td>".$s['total_fare']."</td>
                  <td>".$val."</td>
                  <td>".$s['monthname']."</td>
              </tr>";
       }
        echo "</tbody>";
       
     ?>
</table>
    </div>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $('#status').html("Completed");
        })
    </script> -->
</body>
</html>