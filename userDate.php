<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];

$recieverLastLogindate="SELECT lastLogindate FROM user WHERE name='".$_SESSION['recievername']."'";
$recieverLastLogindateQuery=mysqli_query($con,$recieverLastLogindate);
while($lastlog=mysqli_fetch_assoc($recieverLastLogindateQuery)){
    // $lastseendate=date("Y-m-d",strtotime($lastlog['lastLogindate']));
    $lastseendate=date($lastlog['lastLogindate']);
    // $lastseentime=date("h:i a",strtotime($lastlog['lastLogintime']));
    echo $lastseendate;
}
?>
