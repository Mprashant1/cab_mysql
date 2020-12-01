<?php 
    include "user.php";
    include_once "config.php";
    include "admin/location.php";
    //session_start();
    $User=new user();
    $db=new DBconnection();
    $loc=new Location();
    $sq=$loc->SetLocation($db->conn);
    //print_r($_SESSION['data']);
    //print_r($sq[0]['name']);
    print_r($_SESSION['username']);
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
        // $(document).ready(function() {
            
        //     $('#submit').click(function(ev) {
        //         var pick=document.getElementById('pickup').value;
        //         var drop=document.getElementById('drop').value;
        //         var luggage_value=document.getElementById('luggage').value;
        //         var cab=document.getElementById('cab-type').value;
                    
        //           if (pick == "PickUp") {
        //             alert("Pick Up point mandatory!!!");
        //             return;
        //             }
        //             else if(drop=="Drop"){
        //                 alert("Drop point mandatory!!!");
        //                 return;
        //             }else if(cab=="Cab Type"){
        //                 alert("Cab Type must be choosen!!!");
        //                     return;
        //             }if(cab==='CedMicro'){
        //                luggage_value=0;
        //             }else if(isNaN(luggage_value ) || luggage_value==""){
        //                alert("Luggage value must be numeric and not be blank!!!");
        //                return;
        //             }
        //             ev.preventDefault();
        //         //     $.ajax({
        //         //     url: "process1.php",
        //         //     type: "post",
        //         //     dataType:'json',
        //         //     data:{p:pick, d:drop, l:luggage_value, c:cab},
        //         //     success: function(result) {
        //         //       console.log(result);
        //         //         window.location.replace("PendingRide.php");
        //         //     },
        //         // });
        //     });
        //     $('#logout').click(function(){
        //          //session_destroy();
        //         window.location.replace("signin.php");
        //     })
        // })
        
    </script>
</head>
<body id="book_page" style="background-image: url('admin/resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">
    
<div class="navbar">
  <div style="border:2px solid white;width: 105px;border-radius: 50px;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
    <a href="index.php">Home</a>
  <!-- <a href="book.php">Book Ride</a>
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
      <a href="updateUser.php">Update information</a>
      <a href="updatepassword.php">Change Password</a>
    </div>
  </div> -->
  <?php 
    if(isset($_SESSION['username'])){
     if($_SESSION['username']!='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='logout.php' id='logout' style='color: white; float: right;margin-top:5px;'>LogOut</a>";
         echo '<a href="book.php">Book Ride</a>
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
                  <a href="updateUser.php">Update information</a>
                  <a href="updatepassword.php">Change Password</a>
                </div>
              </div>';
              echo '<pre>';
              //print_r($_SESSION['data']);
     }else{
        header('Location:signin.php');
     }
    }else{
      echo "<a href='signin.php' id='login' style='color: white; float: right;margin-top:5px;'>LogIn</a>";
    }
  ?>
</div>
</div>
    <div id="main">
        <div class="row panel panel-default" style="background-color: lightgrey;height: 300px;">
<div class="text-center panel-heading" style="background-image: linear-gradient(to left ,lightgreen,white,grey, yellow,deeppink);"><h1 style="color: black;">Invoice</h1></div>
<div class="panel-body">
<div class="col-md-6 col-lg-6" style="margin-left: 50px;">
<h3>From:</h3>
<h3>To:</h3>
<h3>Cab Type:</h3>
<h3>Luggage: </h3><!-- <h3>CabType: </h3> -->
<h3>Total Distance:</h3>
<h3>Total Fare:</h3>
</div>
 <div class="col-md-6 col-lg-6" style="position: absolute;left: 600px;top: 135px;margin:10px;padding-top:10 px;color: green;">
 <h3><?php echo $_SESSION['data']['from']; ?></h3>
<h3><?php echo $_SESSION['data']['to']; ?></h3>
<h3><?php echo $_SESSION['data']['cab']; ?></h3>
<h3><?php echo $_SESSION['data']['luggage']; ?></h3>
<h3><?php echo $_SESSION['data']['total_dis']; ?></h3>
<h3><?php echo $_SESSION['data']['total_fare']; ?></h3>
</div>
</div>
<div class="panel-footer text-center" style="margin-left: 50px;">
<input type="button" name="continue" value="Continue" id="continue">
</div>
</div>
    </div>
    <script type="text/javascript">
       $(document).ready(function() { 
            $('#continue').click(function(ev) {
               var con=$(this).val();
                    ev.preventDefault();
                    $.ajax({
                    url: "process.php",
                    type: "post",
                    dataType:'json',
                    data:{continue:con},
                    success: function(result) {
                      if(result==="New record created successfully"){
                         window.location.replace("PendingRide.php");
                     }

                    },
                });
            });
            // $('#logout').click(function(){
            //      //session_destroy();
            //     window.location.replace("signin.php");
            // })
        })
    </script>
</body>
</html>