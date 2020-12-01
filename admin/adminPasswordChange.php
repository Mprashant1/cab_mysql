<?php
  include "../user.php";
  $User=new user();
  $db=new DBconnection();
    $sql=$User->approvedUser($db->conn);
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
         echo "<a href='../logout.php' id='logout' style='color: white; float: right;margin-top: 3px;'>LogOut</a>";
     }else{
        header('Location:../signin.php');
     }
    }
?></p> 
</div>
<div id="result">
  <form>
       Previous Password:<input type="password" name="pastpassword" style="width: 300px;"><br>
       New Password:<input type="password" name="newpassword" style="width: 300px;"><br>
       <input type="button" name="submit" value="Submit" ><br>
     </form>
</div>
<script>
    $(document).ready(function(){
        $('input[name="submit"]').click(function(){
            var submit=$(this).val();
            var past=$('input[name="pastpassword"]').val();
            var newpassword=$('input[name="newpassword"]').val();
            $.ajax({
                url: 'index1.php',
                type: 'post',
                dataType:'json',
                data: { submit:submit,past:past,newpassword:newpassword},
                success: function(response) {
                    console.log(response);
                }
            });
        })
        //     $('input[name="update"]').click(function(){
        //     var mobile=$('input[name="mobile"]').val();
        //     console.log(mobile);
        //     var value=$(this).attr("id");
        //     var name=$('input[name="name1"]').val();
        //     var block=$('input[name="block"]').val();
        //     var admin=$('input[name="admin"]').val();
            
        //     $.ajax({
        //         url: 'index2.php',
        //         type: 'post',
        //         dataType:'json',
        //         data: { user_id:value,name:name,mobile:mobile,block:block,admin:admin,submit:submit},
        //         success: function(response) {
        //             console.log(response);
        //         },
        //     });
        // })
         })
</script>
</body>
</html>