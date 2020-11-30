<?php 

require_once "user.php";
//$errors=array();
if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
    $User=new user();
    $db=new DBconnection();
    $sql=$User->register($username,$password,$name,$mobile,$db->conn);
    echo $sql;


/*if (isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';

    /*if ($password != $repassword) {
        $errors[] =array('input'=>'password', 'msg'=>'password does not match');
    }
    if ($username=='') {
        $errors[] =array('input'=>'password', 'msg'=>'Username is required');
    } else {
        if (!preg_match("/^[a-zA-Z-0-9-']*$/" ,$username)) {
            $errors[]=array('input'=>'form','msg'=>'Only letters and white space allowed in username') ;
            
        }
    }
    if ($password=='') {
        $errors[] =array('input'=>'password', 'msg'=>'Password is required');
    }
    /*if ($email=='') {
        $errors[] =array('input'=>'password', 'msg'=>'email is required');
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[]=array('input'=>'form','msg'=>'Invalid email format');
        }
    }

    if (sizeof($errors)==0) {
        
    
        $sql = "INSERT INTO tbl_user(`user_name`, `password`, `mobile`,`name`) VALUES('".$username."', '".$password."', '".$mobile."','".$name."')";

        if ($conn->query($sql) === true) {
            echo "New record created successfully";
            header('Location:signin.php');
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
        }
        $conn->close();
    }*/
}
if (isset($_POST['loginpage'])) {
    header('Location:signin.php');

}

?>
<html>
<head>
	<title>
		Register
    </title>
    <link type="text/css" rel="stylesheet" href="admin/resources/css/demo.css">
</head>
<body>
    <div id="main">
        <h1>Register</h1>
        <form id="signupForm" action="" method="POST">
            Username:<p><input type="text"  name="username"></p>
            Name:<p><input type="text"  name="name"></label></p>
            Password:<p><input type="password"  name="password"></p>
            Mobile:<p><input type="text"  name="mobile">
            <p><input type="submit" name="submit" value="Submit">
                <input type="submit" name="loginpage" value="Login"></p>
        </form>
    </div>
</body>
</html>