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
    $time=$_POST['time'];
$sql="INSERT INTO chat (sendername,recievername,message,date,time) VALUES ('$sendername','$recievername','$message','$date','$time')";
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
    $sysdate=date("Y-m-d");
    $yesterday_date=date('Y-m-d', strtotime('-1 day'));
    //echo $yesterday_date;
if(!$con){
    die("cannot connect".mysqli_connect_error());
}else{
$sql="SELECT * FROM chat WHERE sendername='".$_SESSION['name']."' AND recievername='".$_SESSION['recievername']."' OR recievername= '".$_SESSION['name']."' AND sendername='".$_SESSION['recievername']."'";
$query=mysqli_query($con,$sql);
while($rows=mysqli_fetch_assoc($query)){
    $sendername=$rows['sendername'];
    if($sendername==$_SESSION['name']){
        echo "<div class='messages2-cont'>";
        echo "<div class='messages2'>";
        echo "<p class='head2'>".$rows['message']."</p>";
        if($rows['date']==$sysdate){
            echo "<p class='date'>Today | ".date('h:i a', strtotime($rows['time']))."</p>";
        }else if($rows['date']==$yesterday_date){
            echo "<p class='date'>Yesterday | ".date('h:i a', strtotime($rows['time']))."</p>";
        }else{
        echo "<p class='date'>".date("F j",strtotime($rows['date']))." | ".date('h:i a', strtotime($rows['time']))."</p>";
    }
        echo "</div>";
        echo "</div>";
    }else{
        echo "<div class='messages-cont'>";
    echo "<div class='messages'>";
    echo "<p class='head2'>".$rows['message']."</p>";
    if($rows['date']==$sysdate){
        echo "<p class='date'>Today | ".date('h:i a', strtotime($rows['time']))."</p>";
    }else if($rows['date']==$yesterday_date){
        echo "<p class='date'>Yesterday | ".date('h:i a', strtotime($rows['time']))."</p>";
    }else{
        echo "<p class='date'>".date("F j",strtotime($rows['date']))." | ".date('h:ia', strtotime($rows['time']))."</p>";
}
    echo "</div>";
    echo "</div>";
    }
}
}
echo "<div class='section2'><div class='left2'><form method='post' action='getchat.php'>
    <div class='input'> 
    <input name='message' type='text'placeholder='Message' required><br>
    <input name='date' type='hidden' value='".date('Y-m-d')."'>
    <input name='time' type='hidden' value='".date("H:i:sa")."'>
</div></div>
<div class='right2'> 
   <input class='btn'type='submit' name='save'value='Send'>
</form></div></div>";
    ?>
</div>
</body>
</html>