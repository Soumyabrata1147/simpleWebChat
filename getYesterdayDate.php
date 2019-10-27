<?php
include_once "connection.php";
?>
<?php
date_default_timezone_set('Asia/Kolkata');
$date=date('Y-m-d', strtotime('-1 day'));
echo $date;
?>
