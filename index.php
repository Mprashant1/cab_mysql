<?php 
    include "user.php";
    include_once "config.php";
    include "admin/location.php";
    //session_start();
    $User=new user();
    $db=new DBconnection();
    $loc=new Location();
    $sq=$loc->SetLocation($db->conn);
    //print_r($sq[0]['name']);
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
                    alert("Pick Up point mandatory!!!");
                    return;
                    }
                    else if(drop=="Drop"){
                        alert("Drop point mandatory!!!");
                        return;
                    }else if(cab=="Cab Type"){
                        alert("Cab Type must be choosen!!!");
                            return;
                    }if(cab==='CedMicro'){
                       luggage_value=0;
                    }else if(isNaN(luggage_value ) || luggage_value==""){
                       alert("Luggage value must be numeric and not be blank!!!");
                       return;
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
                            window.location.replace("PendingRide.php");
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
<body id="book_page" style="background-image: url('admin/resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">
    
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
      <a href="updateUser.php">Update information</a>
      <a href="updatepassword.php">Change Password</a>
    </div>
  </div>
  <?php 
    if($_SESSION){
     if($_SESSION['username']!='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='signin.php' id='logout' style='color: white; float: right;margin-top:5px;'>LogOut</a>";
     }else{
        header('Location:signin.php');
     }
    }
  ?>
</div>
</div>
    <div id="main">
        <h1>Book Ride</h1>
        <form id="booking" >
            Pick Point:<p><select  id="pickup">
                <option>PickUp</option>
                <?php foreach ($sq as $key => $value) {
                    echo "<option>".$value['name']."</option>";
                }?>
                <!-- <option>Charbagh</option>
                <option>Indra Nagar</option>
                <option>BBD</option>
                <option>Barabanki</option>
                <option>Basti</option>
                <option>Faizabad</option>
                <option>Gorakhpur</option> -->
                </select></p>
            Drop Point:<p><select id="drop">
                <option>Drop</option>
                 <?php foreach (array_reverse($sq) as $key => $value) {
                    echo "<option>".$value['name']."</option>";
                }?>
                </select></p>
            Cab Type:<p><select onchange="myfun()" id="cab-type">
                <option>Cab Type</option>
                <option>CedMicro</option>
                <option>CedMini</option>
                <option>CedRoyal</option>
                <option>CedSUV</option>
                </select></p>
            Luggage:<p><input type="text"  name="luggage" id="luggage" style="width: 255px;">
            <p><input type="button" name="submit" value="Book Ride" id="submit"></p>
        </form>
    </div>
</body>
</html>