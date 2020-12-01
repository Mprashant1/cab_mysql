<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["data"]);
header("Location:signin.php");
?>