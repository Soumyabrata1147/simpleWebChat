<?php
include_once "connection.php";
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];

$status="UPDATE chat SET checked='1' WHERE recievername='".$_SESSION['name']."' && sendername='$recievername'"; 
$statusquery=mysqli_query($con,$status);
?>
