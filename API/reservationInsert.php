<?php
	function seatInsert($account, $seatID, $date, $beginTime, $endTime){
		require_once("dbtools.inc.php");
		$link = create_connection();
		$sql="INSERT INTO reservationlist(account, seatID, date, beginTime, endTime)VALUES('$account', '$seatID', '$date', '$beginTime', '$endTime')";
		$seatCheck="SELECT seatID From reservationlist WHERE beginTime>='$beginTime' and endTime<='$endTime'";
		$getToken="SELECT token FROM tokenlist WHERE account='$account'";
		$checkResult = execute_sql($link,"member",$seatCheck);
		$result = execute_sql($link,"member",$sql);
		$tokenResult = execute_sql($link,"member",$getToken);
		if($beginTime==null || $endTime==null){
			echo "fail";
		}
    if(mysqli_num_rows($checkResult)!=0 && $result)
    {
      echo "success";

    }
    else if(mysqli_num_rows($checkResult)==0)
    {
      echo "NoSeat";
    }
		else{
			echo "fail";
		}
    mysqli_close($link);
  }
?>
