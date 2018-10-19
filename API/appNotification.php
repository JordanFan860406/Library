<?php
  function sendNotification($account, $seatID, $date, $beginTime, $endTime, $arr){
    require_once("dbtools.inc.php");
    require_once("notification.php");
    $link = create_connection();
    //查詢座位代碼
    $seatCode = "SELECT seatCode FROM seatnum WHERE seatID='$seatID'";
    $seatResult = execute_sql($link,"member",$seatCode);
    $seatData = mysqli_fetch_array($seatResult);
    //查詢裝置token
    $token= "SELECT token FROM tokenlist WHERE account='$account'";
    $tokenResult = execute_sql($link,"member",$token);
    //$tokenData = mysqli_fetch_array($tokenResult);
    //傳送通知(+$date+" "+$beginTime+"~"+$endTime+"在"+$arr+"的"+$seatData[0]+"座位")
    $index=1;
    while($tokenData = mysqli_fetch_array($tokenResult)){
      $title = "高師大";
      $body = "成功預約"." ".$date." ".$beginTime."~".$endTime." ".$arr.$seatData[0]."座位";
      $tokenlist = $tokenData['token'];
      //$tokenlist="dwLXco_HHwI:APA91bH6vB5PVnFmQXDJ6Kd9hTBqUB-TyQeRj_GAAvKFuvWMe1yUIUjn9-6yM06kSezpdkwoTH8vB0uXmp1aHFMzLXSO0gjeCFUN3zk9CcWCNZBZY4HbWuyuEu3nvZK--N30hcvKUr1G";
      echo $tokenlist;
      $push=sendMessage($title,$body,$tokenlist);
      $index = $index+1;
     }
    // echo $index;
  }
?>
