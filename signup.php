<?php 

require_once "user.php";
$errors=array();
if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
    $User=new user();
    $db=new DBconnection();
   


/*if (isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';*/

    /*if ($password != $repassword) {
        $errors[] =array('input'=>'password', 'msg'=>'password does not match');
    }*/
    if ($username=='') {
        $errors[] =array('input'=>'password', 'msg'=>'Username is required');
    }
     if (!preg_match("/^[a-zA-Z ']*$/" ,$name)) {
            $errors[]=array('input'=>'form','msg'=>'Only letters and white space allowed in name') ;
            
        }
    /*if ($email=='') {
        $errors[] =array('input'=>'password', 'msg'=>'email is required');
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[]=array('input'=>'form','msg'=>'Invalid email format');
        }*/
    

    if (sizeof($errors)==0) {
         $sql=$User->register($username,$password,$name,$mobile,$db->conn);
         // print_r($sql);
            echo '<script>alert("<?php echo $sql;");</script>';
            header("Location:signin.php");
         // echo $sql;
}
}
// if (isset($_POST['loginpage'])) {
//     header('Location:signin.php');

// }

?>
<html>
<head>
	<title>
		Register
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
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
    <div id="main" style="height: 380px;">
        <h1>Register</h1>
        <form id="signupForm" action="" method="POST">
            Username:<p><input type="text"  name="username" required="required"></p>
            Name:<p><input type="text"  name="name" required="required"></label></p>
            Password:<p><input type="password"  name="password" required="required"></p>
            Mobile:<p><input type="text" pattern="[7-9]{1}[0-9]{9}"
       title="Phone number must be of 10 digit and not contain special character" name="mobile" required="required">
            <p><input type="submit" name="submit" value="Submit">
                <input type="submit" name="loginpage" value="Login"></p>
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