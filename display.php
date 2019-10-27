<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
            <meta charset="UTF-8">
            <link rel='stylesheet' href='index.css'>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
      </head>
      <body>

      <?php
      $sysdate=date("Y-m-d");
      $yesterday_date=date('Y-m-d', strtotime('-1 day'));
$sql="SELECT * FROM chat WHERE sendername='".$_SESSION['name']."' AND recievername='".$_SESSION['recievername']."' OR recievername= '".$_SESSION['name']."' AND sendername='".$_SESSION['recievername']."'";
$query=mysqli_query($con,$sql);

while($rows=mysqli_fetch_assoc($query)){
    $sendername=$rows['sendername'];
    $checked=$rows['checked'];
    if($sendername==$_SESSION['name'] && $checked==null){
        echo "<div class='messages2-cont'>";
        echo "<div class='messages2'>";
        echo "<p class='head2'>".$rows['message']."</p>";
        //echo "<p class='date'>".date('h:i a', strtotime($rows['time']))."</p>";
        if($rows['date']==$sysdate){
                    echo "<p class='date2'>Today | ".date('h:i a', strtotime($rows['time']))."&nbsp;  "."<a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></p>";
            }else if($rows['date']==$yesterday_date){
                     echo "<p class='date2'>Yesterday | ".date('h:i a', strtotime($rows['time']))."&nbsp;  "."<a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></p>";        
        }else{
                    echo "<p class='date2'>".date("F j",strtotime($rows['date']))." | ".date('h:i a', strtotime($rows['time']))."&nbsp; "."<a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></p>";
           
    }
        echo "</div>";
        echo "</div>";
}else if($sendername==$_SESSION['name'] && $checked=='1'){
            echo "<div class='messages2-cont'>";
            echo "<div class='messages2'>";
            echo "<p class='head2'>".$rows['message']."</p>";
            //echo "<p class='date'>".date('h:i a', strtotime($rows['time']))."</p>";
            if($rows['date']==$sysdate){
                     echo "<p class='date2'>Today | ".date('h:i a', strtotime($rows['time']))."&nbsp;  "."<a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></p>";
                }else if($rows['date']==$yesterday_date){
                        echo "<p class='date2'>Yesterday | ".date('h:i a', strtotime($rows['time']))."&nbsp;  "."<a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></p>";
            }else{
                    echo "<p class='date2'>".date("F j",strtotime($rows['date']))." | ".date('h:i a', strtotime($rows['time']))."&nbsp; "."<a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></p>";
        }
            echo "</div>";
            echo "</div>";
        }else{
        echo "<div class='messages-cont'>";
    echo "<div class='messages'>";
    echo "<p class='head2'>".$rows['message']."</p>";
    //echo "<p class='date'>".date('h:i a', strtotime($rows['time']))."</p>";
    if($rows['date']==$sysdate){
        echo "<p class='date'>Today | ".date('h:i a', strtotime($rows['time']))."</p>";
    }else if($rows['date']==$yesterday_date){
        echo "<p class='date'>Yesterday | ".date('h:i a', strtotime($rows['time']))."</p>";
    }else{
        echo "<p class='date'>".date("F j",strtotime($rows['date']))." | ".date('h:i a', strtotime($rows['time']))."</p>";
}
    echo "</div>";
    echo "</div>";
    }
}

?>
</body>
      </html>