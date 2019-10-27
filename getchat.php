<?php
include_once "connection.php";
date_default_timezone_set('Asia/Kolkata');
session_start();
$sendername=$_SESSION['name'];
$recievername=$_SESSION['recievername'];
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
    <style>
    .box{
        box-sizing:border-box;
        padding-left:20px;
        padding-top:5px;
        padding-bottom:10px;
        height:70px;
    }
    .uimage{
      padding-top:20px;
        float:left;
        width:45px;
        height:70px;
    }
    .rig{
        float:right;
        width:calc(100%-45px);
        margin:0;
        padding:0;
        height:70px;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!--AJAX-->
        <script>
            $(document).ready(function() {
                $('html, body').animate({scrollTop:$(document).height()}, 'fast');
                setInterval(() => {
                    getTime();
                    getDate();
                    setTime();
                    userTime();
                   messageSeen();
                    userDate();
                    // checking();
                    yesDate();
                    setDate();
                    displayFromDatabase();
                }, 100);
                setInterval(() => {
                  checking();
                }, 5000);
                // displayFromDatabase();
                $("#save").click(function(){
                   var message=$("#message").val();
                   var date=$("#date").val();
                   var time=$("#time").val();
                   $.ajax({
                       url:"insert.php",
                       type:"post",
                       async:false,
                       data:{
                           "done":1,
                           "message":message,
                           "date":date,
                           "time":time
                       },
                       success:function(data){
                        // displayFromDatabase();
                          $("#message").val('');
                          $('html, body').animate({scrollTop:$(document).height()}, 'fast');
                       }
                   });
                });
            });
            // function gobottom(){
            //     $('html, body').animate({scrollTop:$(document).height()}, 'fast');
            // }
            function messageSeen(){
                $.ajax({
                    url:"messageSeen.php",
                })
            }
            function setTime(){
                $.ajax({
                    url:"setTime.php",
                })
            }
            function setDate(){
                $.ajax({
                    url:"setDate.php",
                })
            }
            function userDate(){
                $.ajax({
                    url:"userDate.php",
                    success:function(data){
                        $("#curdate").html(data);

                    }
                })
            }
            function yesDate(){
                $.ajax({
                    url:"getYesterdayDate.php",
                    success:function(data){
                        $("#yesdate").html(data);

                    }
                })
            }
            function userTime(){
                $.ajax({
                    url:"userTime.php",
                    success:function(data){
                        $("#curtime").html(data);

                    }
                })
            }
            function displayFromDatabase(){
                $.ajax({
                    url:"display.php",
                    type:"POST",
                    async:false,
                    data:{
                        "display":1
                    },
                    success:function(data){
                        $("#display").html(data);
                    }
                })
            }
            function getTime(){
                $.ajax({
                    url:"getTime.php",
                    success:function(data){
                        $("#time").val(data);
                        $("#curt").html(data);
                    }
                })
            }
            function getDate(){
                $.ajax({
                    url:"getDate.php",
                    success:function(data){
                        $("#date").val(data);
                        $("#curd").html(data);
                    }
                })
            }
            function checking(){
                curd=$("#curd").html();
                curt=$("#curt").html();
                curdate=$("#curdate").html();
                curtime=$("#curtime").html();
                yesdate=$("#yesdate").html();
                if(curd==curdate && curt==curtime){
                    $("#lastseen").html("online");
                }else if(curd==curdate && curt!=curtime){
                    $("#lastseen").html("last seen Today at "+curtime);
                }else if(curdate==yesdate){
                    $("#lastseen").html("last seen Yesterday at "+curtime);
                }else{
                    $("#lastseen").html("last seen on "+curdate);
                }
            }
        </script>

</head>
<body>
<div style='display:none;'id='curt' ></div>
<div style='display:none;'id='curd'></div>
<div style='display:none;'id='curtime'></div>
<div style='display:none;'id='yesdate'></div>
<div style='display:none;'id='curdate'></div>

<div class='section'>
    <div class='left1'>
    <div class='box'>
    <div class='uimage'>
<?php
$userimg="SELECT * FROM user WHERE name='".$_SESSION['name']."'";
$userimgqu=mysqli_query($con,$userimg);
while($rowuserimg=mysqli_fetch_assoc($userimgqu)){
  $uim=$rowuserimg['im'];
      echo "<img style='border-radius:50%;'width='45px' height='45px' src=".$uim.">";
}
?>
    </div>
    <div class='rig'>
    <div class='heading'><?php echo $_SESSION['recievername']." ";?></div>
    <div id='lastseen' style="padding:0px;color:#fff;font-size:14px;font-weight:400;"></div>
    </div>
    </div>
</div>
<div class='right1'></div>
</div>

<div id='display'></div>

<?php
echo "<div class='section2'><div class='left2'>
    <div class='input'>
    <input   id='message' autocomplete='false' type='text' placeholder='Message' required><br>
    <input  id='date' type='hidden'>
    <input  id='time' type='hidden'>
</div></div>
<div class='right2'>
   <input class='btn'type='submit' id='save'  value='Send'>
</div></div>";
    ?>
</div>
</body>
</html>
