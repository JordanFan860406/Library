<?php

	function tokenInsert($account, $token){
		require_once("dbtools.inc.php");
		$link = create_connection();
		$sql="SELECT account FROM tokenlist Where token='$token' and account='$account'";
		$result = execute_sql($link,"member",$sql);

		if(mysqli_num_rows($result)!=0)
		{
			mysqli_free_result($result);
			echo "fail";
		}

		else
		{
			mysqli_free_result($result);
			$sql="INSERT INTO tokenlist(account,token)VALUES('$account','$token')";
			$result = execute_sql($link,"member",$sql);
			echo "success";
		}

		mysqli_close($link);
	}

?>
