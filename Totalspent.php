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
    $sq=$loc->Totalspent($username,$db->conn);
    print_r($sq);
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
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
  <div style="border:2px solid white;width: 105px;border-radius: 50px;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
  <a href="index.php">Home</a>
  <a href="book.php">Book Ride</a>
  <div class="dropdown">
    <button class="dropbtn">Ride
    </button>
    <div class="dropdown-content">
      <a href="PendingRide.php">Pending Ride</a>
      <a href="CompleteRide.php">Completed Rides</a>
      <a href="AllRide.php">All Rides</a>
      <a href="Totalspent.php">Total Spent</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Accounts
    </button>
    <div class="dropdown-content">
      <a href="updateUser.php">Update information</a>
      <a href="updatepassword.php">Change Password</a>
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
       <table style="display: block;">
    <thead>
        <tr>
            <th>Ride Id</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Total Fare</th>
            <th>Status</th>
            <th>Customer Id</th>
        </tr>
    </thead>
   <?php 
        echo "<tbody>";
       foreach($sq as $s){
        if($s['status']==1){
            $val="Pending";
        }
        echo "<tr><td>".$s['ride_id']."</td>
              <td>".$s['ride_date']."</td>
              <td>".$s['from']."</td>
               <td>".$s['to']."</td>
                <td>".$s['total_distance']."</td>
                 <td>".$s['luggage']."</td>
                  <td>".$s['total_fare']."</td>
                  <td>".$val."</td>
                  <td>".$s['customer_user_id']."</td>
              </tr>";
       }
        echo "</tbody>";
       
     ?>
</table>
    </div>
</body>
</html>