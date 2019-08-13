<?php
date_default_timezone_set('Asia/Kolkata');
    session_start();
    $servername='localhost';
$user='root';
$password='';
$dbname='webchat';
$con=mysqli_connect($servername,$user,$password,$dbname);
if(isset($_POST['save'])){
    $sendername=$_SESSION['name'];
    $recievername=$_SESSION['recievername'];
    $message=$_POST['message'];
    $date=$_POST['date'];
$sql="INSERT INTO chat (sendername,recievername,message,date) VALUES ('$sendername','$recievername','$message','$date')";
$query=mysqli_query($con,$sql);
if($query){
//echo "message sent";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='index.css'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chats</title>
</head>
<body>
<div class='section'>
    <div class='left1'><p class='heading'><?php echo $_SESSION['recievername'];?></p></div>
<div class='right1'><a href='submit.php'><i class="fa fa-search" aria-hidden="true"></i></a></div>
</div>
    <?php
if(!$con){
    die("cannot connect".mysqli_connect_error());
}else{
$sql="SELECT * FROM chat WHERE sendername='".$_SESSION['name']."' AND recievername='".$_SESSION['recievername']."' OR recievername= '".$_SESSION['name']."' AND sendername='".$_SESSION['recievername']."'";
$query=mysqli_query($con,$sql);
while($rows=mysqli_fetch_assoc($query)){
    $sendername=$rows['sendername'];
    if($sendername==$_SESSION['name']){
        echo "<div class='messages2'>";
        echo "<p class='head'>You</p>".$rows['message']."<br>";
        echo "<p class='date'>".$rows['date']."</p>";
        echo "</div>";
    }else{
    echo "<div class='messages'>";
    echo "<p class='head'>".$rows['sendername']."</p>".$rows['message']."<br>";
    echo "<p class='date'>".$rows['date']."</p>";
    echo "</div>";
    }
}
}
echo "<div class='section2'><div class='left2'><form method='post' action='getchat.php'>
    <div class='input'> 
    <input name='message' type='text'placeholder='Message' required><br>
    <input name='date' type='hidden' value='".date('Y-m-d H:i:s')."'>
</div></div>
<div class='right2'> 
   <input class='btn'type='submit' name='save'value='Save'>
</form></div></div>";
    ?>
</div>
</body>
</html>