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
    //echo "successful";
    if(isset($_POST['save'])){
        $sendername=$_SESSION['name'];
        $recievername=$_POST['recievername'];
        //very very importnt lines
            $status="UPDATE chat SET checked='1' WHERE recievername='".$_SESSION['name']."' && sendername='$recievername'"; 
            $statusquery=mysqli_query($con,$status);
        //yes they are
        $_SESSION['recievername']=$recievername;
        header('location:getchat.php');
}
}
?>
