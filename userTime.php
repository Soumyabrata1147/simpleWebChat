<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];

$recieverLastLogintime="SELECT lastLogintime FROM user WHERE name='".$_SESSION['recievername']."'";
$recieverLastLogintimeQuery=mysqli_query($con,$recieverLastLogintime);
while($lastlog=mysqli_fetch_assoc($recieverLastLogintimeQuery)){
    $lastseentime=date($lastlog['lastLogintime']);
    // $lastseentime=date($lastlog['lastLogintime']);
    echo $lastseentime;
}
?>
