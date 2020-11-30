<?php 

session_start();
include "config.php";
$errors=array();


if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
   

    if(sizeof($errors)==0) {
        
    
        $sql = 'SELECT * FROM tbl_user where
        `user_name`="'.$username.'" AND `password`="'.md5($password).'"' ;
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row['isadmin'];
                if($row['isadmin']==1){
                $_SESSION['userdata'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'mobile'=>$row['mobile'] );
                header('Location:login.php');
            }
            }
        } else {
            $errors[]=array('input'=>'form','msg'=>'Invalid Login');
        }

        $conn->close();
        
    }
}
/*if (isset($_POST['registerpage'])) {
    header('Location:admin.php');
}*/
?>


<html>
<head>
	<title>
		Login
    </title>
    <link type="text/css" rel="stylesheet" href="resources/css/demo.css">
</head>
<body>
    <div id="errors">
        <?php if(sizeof($errors)>0) : ?>
            <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error['msg']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <di id="main">
        <img src="resources/images/admin2.jpeg">
        <h1>Login</h1>
        <form id="signinForm" action="login.php" method="POST" enctype="multipart/form-data">
            Username:<p><input type="text"  name="username"></p>
            Password:<p><input type="password"  name="password"></p>
            <p><input type="submit" name="submit" value="Login"><input type="submit" name="registerpage" value="Register"></p>
        </form>
    </div>
</body>
</html>