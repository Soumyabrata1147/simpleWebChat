<?php
//server_connection variables
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='sign.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webchat Sign Up</title>
</head>
<body>
    <form action='signup.php' method='post'>
    <input type='text'name='name' placeholder='Username'required>
    <input type='password'name='pass' placeholder='Password' required>
    <input class='btn'type='submit' name='submit' value='Create'><br><br><br><br>
    </form>
    <a href='index.php'><span>Already have an account&nbsp;&nbsp;</span>Sign in</a>
<?php
    function test_data($data){
        $data=trim($data);
        $data=htmlspecialchars($data);
        $data=stripslashes($data);
        return $data;
    }
    if(isset($_POST['submit'])&& !empty($_POST['name']) && !empty($_POST['pass'])){
        $name=$_POST['name'];
        $pass=$_POST['pass'];
        $name=test_data($name);
        $pass=test_data($pass);
        $sql="INSERT INTO user (name,pass) VALUES ('$name','$pass')";
        $query=mysqli_query($con,$sql);
    }
    ?>
</body>
</html>