<?php
	function logout(){
		session_start();
		session_destroy();
		header('Location: https://henjorly.ddns.net/WEB/Library/View/index.html');
		exit;
	}
?>
