<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];

$date=date("H:i:s");
$logintime = "UPDATE user SET lastLogintime ='$date' WHERE name='".$_SESSION['name']."'";
mysqli_query($con, $logintime);

?>