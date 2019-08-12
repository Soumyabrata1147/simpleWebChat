<?php
session_start();
$servername='localhost';
$user='root';
$password='';
$dbname='webchat';
//set connection
$con=mysqli_connect($servername,$user,$password,$dbname);
if(!$con){
    die("cannot connect".mysqli_connect_error());
}else{
    echo "successful";
    if(isset($_POST['save'])){
        $sendername=$_SESSION['name'];
        $recievername=$_POST['recievername'];
        $message=$_POST['message'];
        $date=$_POST['date'];
    
$sql="INSERT INTO chat (sendername,recievername,message,date) VALUES ('$sendername','$recievername','$message','$date')";
$query=mysqli_query($con,$sql);
if($query){
    echo "message sent";
    $_SESSION['recievername']=$recievername;
    header('location:getchat.php');
}
}
}
?>
