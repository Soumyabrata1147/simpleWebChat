<?php
    session_start();
    $servername='localhost';
$user='root';
$password='';
$dbname='webchat';
$con=mysqli_connect($servername,$user,$password,$dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='index.css'>
    <link rel='stylesheet' href='sign.css'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chats</title>
</head>
<body>
    <a href='submit.php'><i class='fa fa-plus'></i></a>
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
    ?>
</div>
</body>
</html>