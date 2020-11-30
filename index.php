<?php
  include "user.php";
  $User=new user();
  $db=new DBconnection();
    
    //$s=$User->update($db->conn);
    
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="navbar">
  <!-- <p style="float: right;color: white;margin-top: 10px;"> --><?php
  if($_SESSION){
     if($_SESSION['username']!='admin'){
         echo "<p style='color:white;float: right;margin-top: 17px;'>".$_SESSION['username']."</p>";
         echo '<a href="book.php">Book Ride</a>';
         echo "<a href='signin.php' id='logout' style='color: white; float: right;margin-top:5px;'>LogOut</a>";
     }else{
        header('Location:signin.php');
     }
    }
  ?></p>
  <!-- <div class="dropdown">
    <button class="dropbtn">Ride
    </button>
    <div class="dropdown-content">
      <a href="#">Pending Ride</a>
      <a href="#">Completed Rides</a>
      <a href="#">All Rides</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Accounts
    </button>
    <div class="dropdown-content">
      <a href="#">Update information</a>
      <a href="#">Change Password</a>
    </div>
  </div>  -->
  <!-- <div class="dropdown">
    <button class="dropbtn">Filter 
    </button>
    <div class="dropdown-content">
      <a href="pending.php">By Month</a>
      <a href="approved.php">By Week</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Organise 
    </button>
    <div class="dropdown-content">
      <a href="pending.php">By Date</a>
      <a href="approved.php">By Ride</a>
      <a href="approved.php">By Fare</a>
    </div> -->
    <!-- <p style="float: right;margin-left: 500px;color: white;margin-top: 10px;"><?php //if($_SESSION){
    // echo $_SESSION['username'];
    // echo "<a href='signin.php' id='logout' style='color: white; float: left;'>LogOut</a>";
    // }
    // else{
    //     echo "<a href='signin.php'>Login</a>";
    }?></p> -->
  </div> 
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
            Luggage:<p><input type="text"  name="luggage" id="luggage">
            <p><input type="button" name="submit" value="Book Ride" id="submit"></p>
        </form>

 <!--  <table>
    <thead>
        <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Block Status</th>
            <th>Admin Status</th>
            <th>Actions</th>
        </tr>
    </thead> <?php 
        //echo $sql;
     ?> 
</table> -->
<!-- <div id="result"></div> -->
<script>
    $(document).ready(function(){
        $('input[type="button"]').click(function(){

            var value=$(this).attr("id");
            $(this).addClass("update")
            $.ajax({
                url: 'index1.php',
                type: 'post',
                dataType:'html',
                data: { id:value},
                success: function(response) {
                    $('#result').html(response);
                    $(this).unbind('click');
                }
            });
        })
            $('button').click(function(){
            var mobile=$('input[name="mobile"]').val();
            console.log(mobile);
            var value=$(this).attr("id");
            var name=$('input[name="name1"]').val();

            var mobile=$('input[name="mobile"]').val();
            console.log(mobile);
            var block=$('input[name="block"]').val();
            var admin=$('input[name="admin"]').val();
            
            $.ajax({
                url: 'index2.php',
                type: 'post',
                dataType:'json',
                data: { user_id:value,name:name,mobile:mobile,block:block,admin:admin,submit:submit},
                success: function(response) {
                    console.log(response);
                }
            });
        })
        })
</script>
</body>
</html>