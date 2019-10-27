<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];

if(isset($_POST['done'])){
    $message=$_POST['message'];
    $date=$_POST['date'];
    $time=$_POST['time'];
$sql="INSERT INTO chat (sendername,recievername,message,date,time) VALUES ('$sendername','$recievername','$message','$date','$time')";
$query=mysqli_query($con,$sql);
exit();
}
?>