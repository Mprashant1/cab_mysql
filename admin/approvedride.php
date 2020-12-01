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
        //         data: {invoice:value,ride: <?php echo $_SESSION['ride_id'];?>},
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
                    $('#sorted_tbl2').hide();
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
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl1').append(value);
                        $('#sorted_tbl1').append(text);
                       }else{
                          $('#unsorted_tbl').hide();
                          $('#sorted_tbl1').hide();
                          //$('#sorted_tbl3').hide();
                          $('#sorted_tbl4').hide();
                    var text="";
                    var value="";
                    value+="<thead><tr>"
                        value+="<th>Ride Id</th>"
                        value+="<th>Date</th>"
                     value+= "<th>From</th>"
                            value+="<th>To</th>"
                            value+="<th>Total Distance</th>"
                            value+="<th>Luggage</th>"
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
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl2').append(value);
                        $('#sorted_tbl2').append(text);
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
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl3').append(value);
                        $('#sorted_tbl3').append(text);
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
                            text+="<td>"+response.result[i]['total_fare']+"</td>";
                            text+="<td>"+response.result[i]['customer_user_id']+"</td>";
                          }
                          text+="</tr></tbody>";
                        }

                        $('#sorted_tbl4').append(value);
                        $('#sorted_tbl4').append(text);
                       }

                }
            });
        })
    })
</script>
</body>
</html>