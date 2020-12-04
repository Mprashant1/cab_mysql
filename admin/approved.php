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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">

<div class="navigation">
    <div style="border:2px solid white;width: 115px;border-radius: 50px;position: relative;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
  <a href="admin.php">Home</a>
  <div class="dropdow">
    <button class="dropbt">Manage Location 
    </button>
    <div class="dropdow-content">
      <a href="edit.php">Edit Location</a>
      <a href="addlocation.php">Add Location</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Manage Ride
    </button>
    <div class="dropdow-content">
      <a href="pendingride.php">Pending</a>
      <a href="approvedride.php">Approved</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Manage User 
    </button>
    <div class="dropdow-content">
      <a href="pending.php">Pending</a>
      <a href="approved.php">Approved</a>
    </div>
  </div> 
  <div class="dropdow">
    <button class="dropbt">Accounts 
    </button>
    <div class="dropdow-content">
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
        </tr>
    </thead>
    <?php 
        
        echo $sql['text'];
     ?>
</table>
<table id="sorted_tbl1" style="display: block;"></table>
<table id="sorted_tbl2" style="display: block;"></table>
<div id="result" style="display: none;border:none;"></div>
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
                        text+=value;
                        // $('#sorted_tbl1').html(value);
                        $('#sorted_tbl1').html(text);
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
                        text+=value;
                        // $('#sorted_tbl2').append(value);
                        $('#sorted_tbl2').html(text);
                       }

                }
            });
            })
        // $('input[name="edit"]').click(function(){
        //     var value=$(this).attr("id");
        //     console.log(value);
        //      $.ajax({
        //          url: 'index1.php',
        //          type: 'post',
        //          dataType:'json',
        //          data: {a:value},
        //          success: function(response) {
        //            $('#result').append(response);
        //            $('#result').show();
        //            $('#unsorted_tbl').hide();

        //            $('input[name="update"]').click(function(){
        //              var value=$(this).attr("id");
        //              var loc=$('input[name="locationname"]').val();
        //               var dis=$('input[name="distance"]').val();
        //               var avail=$('input[name="available"]').val();
        //              $.ajax({
        //                url: 'index1.php',
        //                type: 'post',
        //                dataType:'json',
        //                data: {location:value,loc:loc,dis:dis,avail:avail},
        //                success: function(response) {
        //                  $('#result').hide();
        //                  console.log(response);

        //                }

        //              })
        //          })
        //          }
        //      });
        // })
        // $('input[name="delete"]').click(function(){
        //     var value=$(this).attr("id");
        //     $.ajax({
        //         url: 'index1.php',
        //         type: 'post',
        //         dataType:'json',
        //         data: {delete:value},
        //         success: function(response) {
        //           console.log(response);
        //         }
        //       })
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