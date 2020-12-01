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
       By Month:<p><select id="month">
                <option value="1">Last 1 month</option>
                <option value="2">Last 2 month</option>
                <input type="button" name="submit" value="Search"> <br>       
       By Week:<p><select id="week">
                <option value="7">Last 7 days</option>
                <input type="button" name="submit1" value="Search">         
  
  <table id="tbl" style="display: block;">
    <div id="error"></div> 
    <thead>
        <tr>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Luggage</th>
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
                    <td>".$s['total_fare']."</td>
                    <td>".$val."</td>
                </tr>";
         }
         foreach($res as $r){
                      echo "<tr id='spent'><td>Total Spent:".$r."</td></tr>";
                      }
          echo "</tbody>"; 
     ?> 

</table>
<table id="month_filter" style="display: block;"></table>
<table id="week_filter" style="display: block;"></table>

    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name="submit"]').click(function(){
                var value=$('#month').val();
                //console.log(value);
                $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { month:value},
                success: function(response) {
                      //console.log(response.error);
                      if(response.error){
                          $('#error').text("No Data For Queried Month!");
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

                         $('#month_filter').append(value);
                         $('#month_filter').append(text);
                      }
                }
            });
            })
                $('input[name="submit1"]').click(function(){
                var value=$('#week').val();
                console.log(value);
                $.ajax({
                url: 'process.php',
                type: 'post',
                dataType:'json',
                data: { week:value},
                success: function(response) {
                      //console.log(response.error);
                      if(response.error){
                          $('#error').text("No Data For Queried Week!");
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

                         $('#week_filter').append(value);
                         $('#week_filter').append(text);
                      }
                }
            });
            })
        })
    </script> 
</body>
</html>