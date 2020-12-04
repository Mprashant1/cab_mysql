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
    if(isset($_SESSION['username'])){
     if($_SESSION['username']!='admin'){
         echo "<div style='position:absolute; right:30px;'><p style='color:white;float: right;margin-top: 60px;'>".$_SESSION['username']."</p>";
         echo "<a href='logout.php' id='logout' style='color: white; float: right;margin-top:60px;margin-right:10px;'>LogOut</a></div>";
     }else{
        header('Location:logout.php');
    }
    }else{
        header('Location:index.php');
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
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
<body style="background-image: url('admin/resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">
    
<div class="navigation">
  <div style="border:2px solid white;width: 115px;border-radius: 50px;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
  <a href="index.php">Home</a>
  <a href="book.php">Book Ride</a>
  <div class="dropdow">
    <button class="dropbt">Ride
    </button>
    <div class="dropdow-content">
      <a href="PendingRide.php">Pending Ride</a>
      <a href="CompleteRide.php">Completed Rides</a>
      <a href="AllRide.php">All Rides</a>
      <a href="Totalspent.php">Total Spent</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Accounts
    </button>
    <div class="dropdow-content">
      <a href="updateUser.php">Update information</a>
      <a href="updatepassword.php">Change Password</a>
    </div>
  </div> 
  <!-- <?php 
    if($_SESSION){
     if($_SESSION['username']!='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='logout.php' id='logout' style='color: white; float: right;margin-top:5px;'>LogOut</a>";
     }else{
        header('Location:signin.php');
     }
    }else{
      echo "<a href='signin.php' id='login' style='color: white; float: right;margin-top:5px;'>LogIn</a>";
    }
  ?> -->
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
                    if(response=="Password updated successfully"){
                      alert("Your Password is changed");
                      window.location.replace("signin.php");
                    }else{
                      alert("Your Previous password doesnot match");
                    }
                }
            });
            });
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