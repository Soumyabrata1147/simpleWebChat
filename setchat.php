<?php
include_once "connection.php";
?>
<?php
session_start();
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
