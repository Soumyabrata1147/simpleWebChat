<?php
$servername="localhost";
$user="root";
$password="";
$dbname="webchat";
$con=mysqli_connect($servername,$user,$password,$dbname);
//checking connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    //echo "connected successfully";
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='sign.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webchat Sign In</title>
</head>
<body>
    <form action='index.php' method='post'>
    <input type='text'name='name' placeholder='Username'required>
    <input type='password'name='pass' placeholder='Password' required>
    <input class='btn'type='submit' name='submit' value='Join'><br><br><br><br>
    </form>
    <a href='signup.php'><span>Don't have an account&nbsp;&nbsp;</span>Sign up</a>
<?php
//fetching data from form
 if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['pass'])){
     $name=$_POST['name'];
     $pass=$_POST['pass'];
 //checking with database
 $sql="SELECT * FROM user WHERE name='$name' && pass='$pass'";
 $query=mysqli_query($con,$sql);
 $result=mysqli_num_rows($query);
 if($result==1){
    $_SESSION['name']=$name;
    $_SESSION['pass']=$pass;
    header("location:getchat.php");
 }else{
    die("sorry, something went wrong,try again later");
     header("location:index.php");
 }
 }
 ?>
 </body>
 </html>