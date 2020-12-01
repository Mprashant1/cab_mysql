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
    $sq=$loc->AllUserRide($username,$db->conn);
    $val=$User->FetchUser($username,$db->conn);
    //print_r($val);
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
     <div id="result">
       <form>
       Previous Password:<input type="text" name="pastpassword" style="width: 300px;"><br>
       New Password:<input type="text" name="newpassword" style="width: 300px;"><br>
       <input type="button" name="submit" value="Submit"><br>
     </form>
     </div>
    </div>
     <script type="text/javascript">
        $(document).ready(function(){
            $('input[name="submit"]').click(function(){
              var submit=$(this).val();
              var pastpassword=$('input[name="pastpassword"]').val();
               var newpassword=$('input[name="newpassword"]').val();
               $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { sub:submit,pastpassword:pastpassword,newpassword:newpassword},
                success: function(response) {
                    console.log(response);
                }
            });
            });
        })
    </script> 
</body>
</html>