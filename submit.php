<?php
session_start();
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,,500,700&display=swap" rel="stylesheet"> 
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel='stylesheet' href='submit.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Webchatter</title>
</head>
<body>
<?php
echo "<form method='post' action='setchat.php'>
    <div class='input'> 
    <input type='text' name='recievername' placeholder='Whom to send' required><br>
</div>
    <input class='btn'type='submit' name='save'value='Save'>
</form>";
?>
</body>
</html>