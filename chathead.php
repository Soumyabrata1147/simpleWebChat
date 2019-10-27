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
    <link rel='stylesheet' href='submit.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
$sysdate=date('Y-m-d');
$yesterdaydate=date('Y-m-d',strtotime("-1 days"));
$counter=0;
$userarray=array();
//my new code
$q="SELECT DISTINCT recievername FROM chat WHERE sendername='".$_SESSION['name']."' ";
$r=mysqli_query($con,$q);
while($rr=mysqli_fetch_assoc($r)){
    $rname=$rr['recievername'];
    if(in_array($rname,$userarray)){
        //pass
    }else{
                  $userarray+=array($counter=>$rname);
                  $counter++;
    }
}
//
$q2="SELECT DISTINCT sendername FROM chat WHERE recievername='".$_SESSION['name']."' ";
$r2=mysqli_query($con,$q2);
while($rrr=mysqli_fetch_assoc($r2)){
    $sname=$rrr['sendername'];
    if(in_array($sname,$userarray)){
        //pass
    }else{
                  $userarray+=array($counter=>$sname);
                  $counter++;
    }
}

foreach($userarray as $value){
    // echo $value . "<br>";
$sel="SELECT * FROM user WHERE name='$value'";
$selqu=mysqli_query($con,$sel);

$unseen="SELECT * FROM chat WHERE  ((sendername='$value' && recievername='".$_SESSION['name']."') OR (sendername='".$_SESSION['name']."' && recievername='$value')) && checked!='1'";
    $countunseen=mysqli_query($con,$unseen);
    $ucm=mysqli_num_rows($countunseen);

while($rel=mysqli_fetch_assoc($selqu)){  
    $im=$rel['im'];
$selm="SELECT * From chat WHERE sendername='$value' && recievername='".$_SESSION['name']."' OR sendername='".$_SESSION['name']."' && recievername='$value' ORDER BY date DESC, time DESC LIMIT 1";
$selmqu=mysqli_query($con,$selm);
while($rel2=mysqli_fetch_assoc($selmqu)){  
    echo "<div class='messages'>
    <form method='post' action='setchat.php'>                
    <input type='hidden' value='".$value."' name='recievername'>";
    //select the button
if($rel2['sendername']==$_SESSION['name']){
        if($rel2['checked']==1){
             if($rel2['date']==$yesterdaydate){
                echo"<button class='chathead'type='submit'name='save'>
                    <div id='main'>
                    <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                    </div>

                    <div id='middivv'>
                    <div id='nam'>".$value."</div>
                    <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                    </div>

                    <div id='rightdivv'>
                    <div id='dt'> Yesterday </div>
                    <div></div>
                    </div>

                    </div>
                    </button>";

                    }else if($sysdate==$rel2['date']){
                    echo"<button class='chathead'type='submit'name='save'>
                    <div id='main'>
                    <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                    </div>

                    <div id='middivv'>
                    <div id='nam'>".$value."</div>
                    <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                    </div>

                    <div id='rightdivv'>
                    <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                    <div></div>
                    </div>    
                        
                    </div>
                    </button>";

                    }else{
                    echo"<button class='chathead'type='submit'name='save'>
                    <div id='main'>
                    <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                    </div>

                    <div id='middivv'>
                    <div id='nam'>".$value."</div>
                    <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                    </div>

                    <div id='rightdivv'>
                    <div id='dt'> ".date("F j",strtotime($rel2['date'])). " </div>
                    <div></div>
                    </div>    
                        
                    </div>
                    </button>";
                    }
        }else{
             if($rel2['date']==$yesterdaydate){
                echo"<button class='chathead'type='submit'name='save'>
                <div id='main'>
                <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                </div>

                <div id='middivv'>
                <div id='nam'>".$value."</div>
                <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                </div>

                <div id='rightdivv'>
                <div id='dt'> Yesterday </div>
                <div></div>
                </div>

                </div>
                </button>";

                    }else if($sysdate==$rel2['date']){
                        echo"<button class='chathead'type='submit'name='save'>
                        <div id='main'>
                        <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                        </div>
    
                        <div id='middivv'>
                        <div id='nam'>".$value."</div>
                        <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                        </div>
    
                        <div id='rightdivv'>
                        <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                        <div></div>
                        </div>    
                            
                        </div>
                        </button>";
                    }else{
                        echo"<button class='chathead'type='submit'name='save'>
                    <div id='main'>
                    <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                    </div>

                    <div id='middivv'>
                    <div id='nam'>".$value."</div>
                    <div><p id='chat'><span><a class='checked'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></span>&nbsp;&nbsp;".$rel2['message']."  "."</p></div>
                    </div>

                    <div id='rightdivv'>
                    <div id='dt'> ".date("F j",strtotime($rel2['date'])). " </div>
                    <div></div>
                    </div>    
                        
                    </div>
                    </button>";
                    }
        }
}
else{
  if($rel2['checked']==1){  
    if($rel2['date']==$yesterdaydate){
        echo"<button class='chathead'type='submit'name='save'>
                <div id='main'>
                <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                </div>

                <div id='middivv'>
                <div id='nam'>".$value."</div>
                <div><p id='chat'>".$rel2['message']."  "."</p></div>
                </div>

                <div id='rightdivv'>
                <div id='dt'> Yesterday </div>
                <div id='ucm'></div>
                </div>

                </div>
                </button>";

    }else if($sysdate==$rel2['date']){
        echo"<button class='chathead'type='submit'name='save'>
                        <div id='main'>
                        <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                        </div>
    
                        <div id='middivv'>
                        <div id='nam'>".$value."</div>
                        <div><p id='chat'>".$rel2['message']."  "."</p></div>
                        </div>
    
                        <div id='rightdivv'>
                        <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                        <div id='ucm'></div>
                        </div>    
                            
                        </div>
                        </button>";
        
    }else{
        echo"<button class='chathead'type='submit'name='save'>
                        <div id='main'>
                        <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                        </div>
    
                        <div id='middivv'>
                        <div id='nam'>".$value."</div>
                        <div><p id='chat'>".$rel2['message']."  "."</p></div>
                        </div>
    
                        <div id='rightdivv'>
                        <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                        <div id='ucm'>".$ucm."</div>
                        </div>    
                            
                        </div>
                        </button>";
        
    }                
}else{
    if($rel2['date']==$yesterdaydate){
        echo"<button class='chathead'type='submit'name='save'>
                <div id='main'>
                <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                </div>

                <div id='middivv'>
                <div id='nam'>".$value."</div>
                <div><p id='chat2'>".$rel2['message']."  "."</p></div>
                </div>

                <div id='rightdivv'>
                <div id='dt'> Yesterday </div>
                <div id='ucm'>".$ucm."</div>
                </div>

                </div>
                </button>";
        
            }else if($sysdate==$rel2['date']){
                echo"<button class='chathead'type='submit'name='save'>
                        <div id='main'>
                        <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                        </div>
    
                        <div id='middivv'>
                        <div id='nam'>".$value."</div>
                        <div><p id='chat2'>".$rel2['message']."  "."</p></div>
                        </div>
    
                        <div id='rightdivv'>
                        <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                        <div id='ucm'>".$ucm."</div>
                        </div>    
                            
                        </div>
                        </button>";
            
            }else{
                echo"<button class='chathead'type='submit'name='save'>
                        <div id='main'>
                        <div id='leftdivv'><img style='border-radius:50%;width:60px;height:60px;'src='$im'>
                        </div>
    
                        <div id='middivv'>
                        <div id='nam'>".$value."</div>
                        <div><p id='chat2'>".$rel2['message']."  "."</p></div>
                        </div>
    
                        <div id='rightdivv'>
                        <div id='dt'> ".date('h:i a',strtotime($rel2['time']))." </div>
                        <div id='ucm'>".$ucm."</div>
                        </div>    
                            
                        </div>
                        </button>";
                
            } 
}

}

//end of button
echo "</form></div>";
}
}
}
?>