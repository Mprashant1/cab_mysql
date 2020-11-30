<?php
	//session_start();
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
         echo "<a href='../signin.php' id='logout' style='color: white; float: right;margin-top: 3px;'>LogOut</a>";
     }else{
        header('Location:../signin.php');
     }
    }
?></p> 
</div>
<select id="user">
  <option value="ascending_user">Ascending User</option>
   <option value="descending_user">Descending User</option>
</select>
<button name="user_sort" id="user_sort_button">Sort</button>
	<table id="unsorted_tbl" style="display: block;">
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
    </thead>
    <?php 
        
        echo $sql['text'];
     ?>
</table>
<table id="sorted_tbl1"></table>
<table id="sorted_tbl2"></table>
<script>
    $(document).ready(function(){
        $('#user_sort_button').click(function(){
          var value=$('#user').val();
                 $.ajax({
                url: 'index.php',
                type: 'post',
                dataType:'json',
                data: {sort_user:value},
                success: function(response) {
                    console.log(response.result);
                    if(response.value=='0'){ 
                    //$('#sorted_tbl2').hide();
                    // $('#sorted_tbl3').hide();
                    // $('#sorted_tbl4').hide();
                    $('#unsorted_tbl').hide();
                    var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>User Id</th>"
                        value+="<th>UserName</th>"
                     value+= "<th>Name</th>"
                            value+="<th>Mobile</th>"
                            value+="<th>Block Status</th>"
                            value+="<th>Admin Status</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['user_id']+"</td>";
                            text+="<td>"+response.result[i]['user_name']+"</td>";
                            text+="<td>"+response.result[i]['name']+"</td>";
                            text+="<td>"+response.result[i]['mobile']+"</td>";
                            text+="<td>"+response.result[i]['isblock']+"</td>";
                            text+="<td>"+response.result[i]['isadmin']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl1').append(value);
                        $('#sorted_tbl1').append(text);
                       }else{
                          $('#unsorted_tbl').hide();
                          $('#sorted_tbl1').hide();
                          //$('#sorted_tbl3').hide();
                          //$('#sorted_tbl4').hide();
                    var text="";
                    var value="";
                   value+="<thead><tr>"
                        value+="<th>User Id</th>"
                        value+="<th>UserName</th>"
                     value+= "<th>Name</th>"
                            value+="<th>Mobile</th>"
                            value+="<th>Block Status</th>"
                            value+="<th>Admin Status</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['user_id']+"</td>";
                            text+="<td>"+response.result[i]['user_name']+"</td>";
                            text+="<td>"+response.result[i]['name']+"</td>";
                            text+="<td>"+response.result[i]['mobile']+"</td>";
                            text+="<td>"+response.result[i]['isblock']+"</td>";
                            text+="<td>"+response.result[i]['isadmin']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl2').append(value);
                        $('#sorted_tbl2').append(text);
                       }

                }
            });
            })
        })
</script>
</body>
</html>