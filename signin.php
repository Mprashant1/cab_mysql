<?php 
require_once "user.php";
$errors=array();
if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $User=new user();
    $db=new DBconnection();
    $sql=$User->login($username,$password,$db->conn);
    print_r($sql);
        if(isset($_SESSION['data'])){
            if(isset($_SESSION['username'])){
            header('Location:invoice2.php');
        }
        }

   // unset($_SESSION['username']);
    //echo $_SESSION['username'];
   

    /*if(sizeof($errors)==0) {
        
    
        $sql = 'SELECT * FROM tbl_user where
        `user_name`="'.$username.'" AND `password`="'.$password.'"' ;
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            
             //output data of each row
            while ($row = $result->fetch_assoc()) {
                if($row['isadmin']==1){
                $_SESSION['userdata'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'mobile'=>$row['mobile'] );
                header('Location:admin/admin.php');
            }else{
                header('Location:signin.php');
            }
            }
        } else {
            //$errors[]=array('input'=>'form','msg'=>'Invalid Login');
        }

        $conn->close();
    }*/
}
if (isset($_POST['registerpage'])) {
    header('Location:signup.php');
}
?>


<html>
<head>
	<title>
		Login
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</script>
</head>
<body style="background-image: url('admin/resources/images/back.jpeg');background-repeat: no-repeat;background-size: cover;">
    <div class="navigation">
        <a href="index.php" style="text-decoration: none;color: white;position: relative;left: 150px;">Home</a>
  <div style="border:2px solid white;width: 115px;border-radius: 50px;position: absolute;"><span style="color: white;font-size: 30px;color: green;">CED</span><span style="color: white;font-size: 20px;color: red;">CAB</span></div>
    
</div>
    <div id="errors">
        <?php if(sizeof($errors)>0) : ?>
            <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error['msg']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div id="main">
        <h1>Login</h1>
        <div style="margin-left: 10px;">
        <form id="signinForm" action="" method="POST">
            Username:<p><input type="text"  name="username"></p>
            Password:<p><input type="password"  name="password"></p>
            <p><input type="submit" name="submit" value="Login"><input type="submit" name="registerpage" value="Register"></p>
            <p><a href="enter_email.php">Forgot password?</a></p>
        </form>
    </div>
    </div>
    <!-- <footer class="page-footer font-small blue">
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
 </footer> -->
<footer class="page-footer font-small blue" style="margin-top: 150px;">
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
