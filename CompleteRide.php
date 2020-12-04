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
    $sq=$loc->CompletedUserRide($username,$db->conn);
    $res=$loc->Totalspent($username,$db->conn);
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
    //print_r($sq);
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

    <div id="main" style="padding: 0;margin:0; ">
       <div style="display: inline-block;">By Month:<p><select id="month">
                <option value="1">Last 1 month</option>
                <option value="2">Last 2 month</option>
                <option value="3">All Data</option>
                <input type="button" name="submit" value="Search"> <br>  </div>     
       <div style="display: inline-block;">By Week:<p><select id="week">
                <option value="7">Last 7 days</option>
                <option value="3">No Filter</option>
                <input type="button" name="submit1" value="Search">   </div>     
       <div style="display: inline-block;">Cab Type:<p><select id="type">
                <option value="CedMicro">CedMicro</option>
                <option value="CedMini">CedMini</option>
                <option value="CedRoyal">CedRoyal</option>
                <option value="CedSUV">CedSUV</option>
                <option value="3">No Filter</option>
                <input type="button" name="submit2" value="Sort"> </div>    
 <div id="error" style="display: block;"></div> 
  <table id="tbl" style="display: block;">
    <thead>
        <tr>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Cab Type</th>
            <th>Total Fare</th>
            <th>Status</th>
        </tr>
    </thead>
    <!-- <tbody id="tbody"></tbody> -->
     <?php
         echo "<tbody>";
         foreach($sq as $s){
         if($s['status']==2){
            $val="Completed";
         }
          echo "<tr>
              <td>".$s['ride_date']."</td>
              <td>".$s['from']."</td>
                 <td>".$s['to']."</td>
                  <td>".$s['total_distance']."</td>
                   <td>".$s['luggage']."</td>
                   <td>".$s['cab_type']."</td>
                    <td>".$s['total_fare']."</td>
                    <td>".$val."</td>
                </tr>";
         }
         foreach($res as $r){
                      echo "<tr id='spent' style='background-color:grey;'><td>Total Spent:".$r."</td></tr>";
                      }
          echo "</tbody>"; 
     ?> 

</table>
<table id="month_filter" style="display: block;"></table>
<table id="week_filter" style="display: block;"></table>
<table id="cab_filter" style="display: block;"></table>

    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name="submit2"]').click(function(){
                var value=$('#type').val();
               if(value=='3'){
                  $('#tbl').show();
                  $('#error').hide();
                  $('#cab_filter').hide();
                  $('#month_filter').hide(function(){
                    $(this).show(2500);
                  });
                  // $('#week_filter').fadeOut(10);
                }
                else{
                $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { type:value},
                success: function(response) {
                      //console.log(response.error);
                      if(response.error){
                          $('#error').show()
                          $('#error').html("No Data For Queried CabType!");
                           $('#month_filter').hide();
                           $('#week_filter').hide();
                           $('#cab_filter').hide();
                           $('#tbl').hide();
                           // $('input[name="month"]').focus(function(){
                          // })
                      }
                      else{
                         console.log(response.cab_type);
                          $('#error').hide();
                          $('#month_filter').hide();
                           $('#week_filter').hide();
                          $('#tbl').hide();
                        var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>CabType</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response[i]['ride_date']+"</td>";
                            text+="<td>"+response[i]['from']+"</td>";
                            text+="<td>"+response[i]['to']+"</td>";
                            text+="<td>"+response[i]['total_distance']+"</td>";
                            text+="<td>"+response[i]['total_fare']+"</td>";
                            text+="<td>"+response[i]['cab_type']+"</td>";
                          }
                          text+="</tr></tbody>";
                          // $('#month_filter').hide();
                        }
                          text+=value;
                         // $('#month_filter').html(value);
                         $('#cab_filter').html(text);
                      }
                }
            });
            }
            });
            $('input[name="submit"]').click(function(){
                var value=$('#month').val();
                if(value=='3'){
                  $('#tbl').show();
                  $('#error').hide();
                  $('#month_filter').hide(function(){
                    $(this).show(2500);
                  });
                  // $('#week_filter').fadeOut(10);
                }else{
                $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { month:value},
                success: function(response) {
                      //console.log(response.error);
                      if(response.error){
                          $('#error').html("No Data For Queried Month!");
                           $('#month_filter').hide();
                           $('#week_filter').hide();
                           $('#tbl').hide();
                           // $('input[name="month"]').focus(function(){
                          // })
                      }
                      else{
                        console.log(response);
                          $('#error').hide();
                          $('#tbl').hide();
                        var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Month</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response[i]['ride_date']+"</td>";
                            text+="<td>"+response[i]['from']+"</td>";
                            text+="<td>"+response[i]['to']+"</td>";
                            text+="<td>"+response[i]['total_distance']+"</td>";
                            text+="<td>"+response[i]['total_fare']+"</td>";
                            text+="<td>"+response[i]['monthname']+"</td>";
                          }
                          text+="</tr></tbody>";
                          // $('#month_filter').hide();
                        }
                          text+=value;
                         // $('#month_filter').html(value);
                         $('#month_filter').html(text);
                      }
                }
            });
              }
            })
                $('input[name="submit1"]').click(function(){
                var value=$('#week').val();
                if(value=='3'){
                  $('#tbl').show();
                  $('#error').hide();
                  $('#cab_filter').hide();
                  $('#month_filter').hide(function(){
                    $(this).show(2500);
                  });
                  // $('#week_filter').fadeOut(10);
                }else{
                $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { week:value},
                success: function(response) {
                      //console.log(response.error);
                      if(response.error){
                          $('#error').html("No Data For Queried Week!");
                          $('#tbl').hide();
                          // $('input[name="month"]').focus(function(){
                          // })
                      }
                      else{
                        console.log(response);
                          $('#error').hide();
                          $('#tbl').hide();
                        var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Month</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response[i]['ride_date']+"</td>";
                            text+="<td>"+response[i]['from']+"</td>";
                            text+="<td>"+response[i]['to']+"</td>";
                            text+="<td>"+response[i]['total_distance']+"</td>";
                            text+="<td>"+response[i]['total_fare']+"</td>";
                            text+="<td>"+response[i]['monthname']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }
                        text+=value;

                         // $('#week_filter').append(value);
                         $('#week_filter').html(text);
                      }
                }
            })
              };
            })

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