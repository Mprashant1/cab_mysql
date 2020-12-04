<?php 
    include "user.php";
    include_once "config.php";
    include "admin/location.php";
    //session_start();
    $User=new user();
    $db=new DBconnection();
    $loc=new Location();
    $sq=$loc->SetLocation($db->conn);
    // print_r($_SESSION['data']['total_fare']);
?>
<!DOCTYPE html>
<html>
<head>
  <title>
    Register
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     <script type="text/javascript">
        
        function myfun(){
            var cab=document.getElementById('cab-type').value;
            
            if(cab=='CedMicro'){
                 let luggage = document.getElementById('luggage');
                
                luggage.setAttribute("disabled", true);
                document.getElementById('luggage').value="";

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
                    // ev.preventDefault();
                    $.ajax({
                    url: "process1.php",
                    type: "post",
                    dataType:'json',
                    data:{p:pick, d:drop, l:luggage_value, c:cab},
                    success: function(result) {
                        // if(result==="error"){
                          var modal = document.getElementById("myModal");
                          var span = document.getElementsByClassName("close")[0];
                            $('.modal').css({"display":"block","width":"500px","margin-left":"250px"});
                             $('#modaltext').html("Your Total Fare is: "+result.total);
                              $('#bookRide').click(function(){
                                 window.location.replace("signin.php");
                             })
                            $('span').click(function() {
                              $('.modal').hide();   
                           })

                              
                            // window.location.replace("signin.php");
                        // }else{
                        //     window.location.replace("PendingRide.php");
                        // }
                    },
                });
            });
            $('#logout').click(function(){
                 //session_destroy();
                window.location.replace("signin.php");
            })
        })
//         var modal = document.getElementById("myModal");

// // Get the button that opens the modal
//       var btn = document.getElementById("myBtn");

//       // Get the <span> element that closes the modal
//       var span = document.getElementsByClassName("close")[0];

//       // When the user clicks the button, open the modal 
//       btn.onclick = function() {
//         modal.style.display = "block";
//       }

//       // When the user clicks on <span> (x), close the modal
//       span.onclick = function() {
//         modal.style.display = "none";
//       }

//       // When the user clicks anywhere outside of the modal, close it
//       window.onclick = function(event) {
//         if (event.target == modal) {
//           modal.style.display = "none";
//         }

        
    </script>
</head>
<body style="background-image: url('admin/resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;"> 
<div class="navigation">
        <a href="index.php" style="text-decoration: none;color: white;position: relative;left: 150px;">Home</a>
  <div style="border:2px solid white;width: 115px;border-radius: 50px;position: absolute;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
    
</div>
<div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                            <p id="modaltext"></p>
                            <button name="bookRide" id="bookRide">Book Ride</button>
                          </div>
                        </div>
    
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
    
         echo "<div class='navigation'><p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo "<a href='logout.php' id='logout' style='color: white; float: right;margin-top:5px;'>LogOut</a>";
         echo '<a href="book.php">Book Ride</a>
              <div class="dropdow">
                <button class="dropbt">Ride
                </button>
                <div class="dropdow-content">
                  <a href="PendingRide.php">Pending Ride</a>
                  <a href="CompleteRide.php">Completed Rides</a>
                  <a href="AllRide.php">All Rides</a>
                  <a href="CompleteRide.php">Total Spent</a>
                </div>
              </div> 
              <div class="dropdow">
                <button class="dropbt">Accounts
                </button>
                <div class="dropdow-content">
                  <a href="updateUser.php">Update information</a>
                  <a href="updatepassword.php">Change Password</a>
                </div>
              </div>';
              // echo '<pre>';
              //print_r($_SESSION['data']);
     }else{
        header('Location:signin.php');
     }
    }else{
      echo "<a href='signin.php' id='login' style='color: white; float: right;margin-top:-40px;'>LogIn</a>";
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