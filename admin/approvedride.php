<?php
	session_start();
  include "../ride.php";
	 $ride=new Ride();
     $d=new DBconnection();
     $sql=$ride->approvedRide($d->conn);
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
<select id="fare">
  <option value="ascending_fare">Ascending Fare</option>
   <option value="descending_fare">Descending Fare</option>
</select>
<button name="fare_sort" id="fare_sort_button">Sort</button>
<select id="date">
  <option value="ascending_date">Ascending Date</option>
   <option value="descending_date">Descending Date</option>
</select>
<button name="date_sort" id="date_sort_button">Sort</button>
	<table id="unsorted_tbl" style="display: block;">
    <thead>
        <tr>
            <th>Ride Id</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Total Fare</th>
            <th>Status</th>
            <th>Cab Type</th>
            <th>Customer Id</th>
            <th>Invoice</th>
        </tr>
    </thead>
   <?php 
         echo "<tbody>";
       foreach($sql as $sq){
        echo "<tr><td>".$sq['ride_id']."</td>
              <td>".$sq['ride_date']."</td>
              <td>".$sq['from']."</td>
               <td>".$sq['to']."</td>
                <td>".$sq['total_distance']."</td>
                 <td>".$sq['luggage']."</td>
                  <td>".$sq['total_fare']."</td>
                  <td>".$sq['status']."</td>
                   <td>".$sq['cab_type']."</td>
                  <td>".$sq['customer_user_id']."</td>
              <td><a href='invoice.php?id=".$sq['ride_id']."'>Invoice</a></td>
              </tr>";
       }
        echo "</tbody>";
     ?>
</table>
 <table id="sorted_tbl1" style="display: block;">
    <!-- <thead>
        <tr>
            <th>Ride Id</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Total Fare</th>
            <th>Status</th>
            <th>Customer Id</th>
            <th>Request</th>
        </tr>
    </thead>
   <?php 
        //   echo "<tbody>";
        // foreach($sql as $sq){
        //  echo "<tr><td>".$sq['ride_id']."</td>
        //      <td>".$sq['ride_date']."</td>
        //        <td>".$sq['from']."</td>
        //         <td>".$sq['to']."</td>
        //          <td>".$sq['total_distance']."</td>
        //           <td>".$sq['luggage']."</td>
        //            <td>".$sq['total_fare']."</td>
        //            <td>".$sq['status']."</td>
        //            <td>".$sq['customer_user_id']."</td>
        //        <td><input type='button' id=".$sq['ride_id']." value='Edit' name='edit'>
        //        <input type='button' id=".$sq['ride_id']." value='Delete' name='delete'></td>
        //        </tr>";
        // }
        //  echo "</tbody>";
     ?> -->
</table> 
<table id="sorted_tbl2" style="display: block;"></table>
<table id="sorted_tbl3" style="display: block;"></table>
<table id="sorted_tbl4" style="display: block;"></table>
<script>
    $(document).ready(function(){
        // $('input[name="invoice"]').click(function(){
        //     var value=$(this).attr("id");
        //     var id=$('input[name="hiddenField"]').val();
        //     console.log(id);
        //     $.ajax({
        //         url: 'index.php',
        //         type: 'post',
        //         dataType:'json',
                // data: {invoice:value,ride: <?php ;?>},
        //         success: function(response) {
        //             console.log(response); 
        //             //console.log($s); 
        //         }
        //     });
        // })
        $('#fare_sort_button').click(function(){
          var value=$('#fare').val();
          $.ajax({
                url: 'index.php',
                type: 'post',
                dataType:'json',
                data: {sort_fare:value},
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
                        value+="<th>Ride Id</th>"
                        value+="<th>Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Luggage</th>"
                            value+="<th>Cab Type</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Customer Id</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['ride_id']+"</td>";
                            text+="<td>"+response.result[i]['ride_date']+"</td>";
                            text+="<td>"+response.result[i]['from']+"</td>";
                            text+="<td>"+response.result[i]['to']+"</td>";
                            text+="<td>"+response.result[i]['total_distance']+"</td>";
                            text+="<td>"+response.result[i]['luggage']+"</td>";
                            text+="<td>"+response.result[i]['cab_type']+"</td>";
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }
                          text+=value;
                        // $('#sorted_tbl1').(value);
                        $('#sorted_tbl1').html(text);
                       }else{
                          $('#unsorted_tbl').hide();
                          $('#sorted_tbl1').hide();
                          //$('#sorted_tbl3').hide();
                          //$('#sorted_tbl4').hide();
                    var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Id</th>"
                        value+="<th>Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Luggage</th>"
                            value+="<th>Cab Type</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Customer Id</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['ride_id']+"</td>";
                            text+="<td>"+response.result[i]['ride_date']+"</td>";
                            text+="<td>"+response.result[i]['from']+"</td>";
                            text+="<td>"+response.result[i]['to']+"</td>";
                            text+="<td>"+response.result[i]['total_distance']+"</td>";
                            text+="<td>"+response.result[i]['luggage']+"</td>";
                            text+="<td>"+response.result[i]['cab_type']+"</td>";
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
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
        $('#date_sort_button').click(function(){
          var value=$('#date').val();
          console.log(value);
          $.ajax({
                url: 'index.php',
                type: 'post',
                dataType:'json',
                data: {sort_date:value},
                success: function(response) {
                    console.log(response.result);
                    if(response.value=='0'){
                     $('#unsorted_tbl').hide();
                     $('#sorted_tbl1').hide();
                     $('#sorted_tbl2').hide();
                     // $('#sorted_tbl4').hide(); 
                    var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Id</th>"
                        value+="<th>Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Luggage</th>"
                            value+="<th>Cab Type</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Customer Id</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['ride_id']+"</td>";
                            text+="<td>"+response.result[i]['ride_date']+"</td>";
                            text+="<td>"+response.result[i]['from']+"</td>";
                            text+="<td>"+response.result[i]['to']+"</td>";
                            text+="<td>"+response.result[i]['total_distance']+"</td>";
                            text+="<td>"+response.result[i]['luggage']+"</td>";
                            text+="<td>"+response.result[i]['cab_type']+"</td>";
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }
                        text+=value;

                        // $('#sorted_tbl3').append(value);
                        $('#sorted_tbl3').html(text);
                       }else{
                          $('#unsorted_tbl').hide();
                         $('#sorted_tbl1').hide();
                         $('#sorted_tbl2').hide();
                         $('#sorted_tbl3').hide(); 
                    var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Id</th>"
                        value+="<th>Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Luggage</th>"
                            value+="<th>Cab Type</th>"
                            value+="<th>Total Fare</th>"
                            value+="<th>Customer Id</th>"
                          value+="</tr></thead>";
                          text+="<tbody>";
                        for(var i=0;i<response.result.length;i++){
                          text+="<tr>";
                          for(var j=0;j<1;j++){
                            text+="<td>"+response.result[i]['ride_id']+"</td>";
                            text+="<td>"+response.result[i]['ride_date']+"</td>";
                            text+="<td>"+response.result[i]['from']+"</td>";
                            text+="<td>"+response.result[i]['to']+"</td>";
                            text+="<td>"+response.result[i]['total_distance']+"</td>";
                            text+="<td>"+response.result[i]['luggage']+"</td>";
                            text+="<td>"+response.result[i]['cab_type']+"</td>";
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }
                          text+=value;
                        // $('#sorted_tbl4').append(value);
                        $('#sorted_tbl4').html(text);
                       }

                }
            });
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