<?php
	session_start();
	require_once("keyTest.php");
	$token = $_GET['token'];
	$input = $_GET['name'];
	if($_SESSION['account'] == null && checkKeyVaild($token, $input)==false)
	{
		echo "failure";
		header("location:https://henjorly.ddns.net/WEB/WebView/login.html");
	}
	if($_SESSION['account'] != null || checkKeyVaild($token, $input)==true){
		$account = $_SESSION['account'];
		require_once("dbtools.inc.php");
    $link=create_connection();
		$sql = "SELECT name FROM users WHERE account='$account' or account='$input'";
		$result = execute_sql($link,"member",$sql);
		$data = mysqli_fetch_array($result);
	}
?>
<!DOCTYPE html>
<html>
	<head>
  <!-- Site made with Mobirise Website Builder v4.4.1, https://mobirise.com -->
	  <meta charset="UTF-8">
	  <meta http-equiv="refresh" content="600;url=https://henjorly.ddns.net/WEB/WebView/login.html">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="generator" content="Mobirise v4.4.1, mobirise.com">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="shortcut icon" href="assets/images/-224x225.png" type="image/x-icon">
	  <meta name="description" content="Site Builder Description">
	  <title>進入預約</title>
	  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
	  <link rel="stylesheet" href="assets/tether/tether.min.css">
	  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
	  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
	  <link rel="stylesheet" href="assets/socicon/css/styles.css">
	  <link rel="stylesheet" href="assets/dropdown/css/style.css">
	  <link rel="stylesheet" href="assets/theme/css/style.css">
	  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
		<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
	  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
	  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	  <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->
		<script>
		  $( function() {
		    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd", minDate : "0d",
	      maxDate : "+7d"});
		  } );
	  </script>
	</head>
	<body>
		<section class="menu cid-qBp6owYd0o" once="menu" id="menu1-o" data-rv-view="494">
		    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
		        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		            <div class="hamburger">
		                <span></span>
		                <span></span>
		                <span></span>
		                <span></span>
		            </div>
		        </button>
		        <div class="menu-logo">
		            <div class="navbar-brand">
		                <span class="navbar-logo">
		                    <a href="https://w3.nknu.edu.tw">
		                         <img src="assets/images/-224x225.png" alt="Mobirise" title="" media-simple="true" style="height: 3.8rem;">
		                    </a>
		                </span>
		                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="https://w3.nknu.edu.tw"><span class="socicon socicon-hellocoton mbr-iconfont mbr-iconfont-btn" style="font-size: 18px;"></span>
		                        NKNU國立高雄師範大學</a></span>
		            </div>
		        </div>
		        <div class="collapse navbar-collapse" id="navbarSupportedContent">
		            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item">
		                    <a class="nav-link link text-white display-5" href="https://henjorly.ddns.net/WEB/WebView/index.html">
		                        <span class="mbri-home mbr-iconfont mbr-iconfont-btn">&nbsp;Home</span></a>
		                </li></ul>

		        </div>
		    </nav>
			</section>


		<section class="engine"><a href="https://mobirise.co/f">free bootstrap builder</a></section><section class="counters2 counters cid-qBNORzGXvA" id="counters2-w" data-rv-view="92">
			<div class="row row-margin-top">
			<div class="container  ">
		       <div class="media-container">
				<div class="col-md-12 align-center">
					<div class="jumbotron jumbotron-fluid">
						<h1 id="h1" class="display-1" >歡迎<?php echo $data[0]?>進入預約</h1>
						<p class="lead">請選擇想預約的日期以及館別</p>
						<hr class="my-4">
						<form class="px-4 py-3" name="reservation" id="reservation" method="post">
						<p>選擇日期</p>
						<p><input type="text" class="btn-primary" id="datepicker" name="datepicker" required></p>
						<p>選擇館別</p>
						<p class="lead">
							<select class="btn btn-secondary dropdown-toggle" id="selectArr" name="selectArr" required>
								<option value="" selected disabled>請選擇</option>
								<option>電算中心</option>
							</select>
						</p>
						<input type="button" class="btn btn-primary" value="下一步" onclick="gotoNext()">
					</form>

					</div>
				</div>
				</div>
			</div>
			</div>
		</section>

			<section once="" class="cid-qBpoeO4jcL mbr-reveal" id="footer7-l" data-rv-view="475">
		    <div class="container">
		        <div class="media-container-row align-center mbr-white">
		            <div class="row row-links">
		                <ul class="foot-menu">
		                <li class="foot-menu-item mbr-fonts-style display-7"><a href="https://w3.nknu.edu.tw">&nbsp; &nbsp;About us</a></li></ul>
		            </div>
		            <div class="row social-row">
		                <div class="social-list align-right pb-2">
		                <div class="soc-item">
		                        <a href="http://line.me/ti/p/%40nknu" target="_blank">
		                            <span class="mbr-iconfont mbr-iconfont-social socicon-line socicon" media-simple="true"></span>
		                        </a>
		                    </div><div class="soc-item">
		                        <a href="https://www.facebook.com/nknu2015/" target="_blank">
		                            <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon" media-simple="true"></span>
		                        </a>
		                    </div><div class="soc-item">
		                        <a href="mailto:ab@nknu.edu.tw">
		                            <span class="mbr-iconfont mbr-iconfont-social socicon-mail socicon" media-simple="true"></span>
		                        </a>
		                    </div><div class="soc-item">
		                        <a href="tel:07-717-2930">
		                            <span class="mbr-iconfont mbr-iconfont-social socicon-viber socicon" media-simple="true"></span>
		                        </a>
		                    </div></div>
		            </div>
		            <div class="row row-copirayt">
		                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
		                    © Copyright 2018 NKNU - All Rights Reserved
		                </p>
		            </div>
		        </div>
		    </div>
			</section>

		  <!-- <script src="assets/web/assets/jquery/jquery.min.js"></script> -->
			<script type="text/javascript">
				function gotoNext(){
					var token = "<?php echo $token;?>";
					var account = "<?php echo $input;?>";
					if(token && account){
						document.getElementById("reservation").action = "/WEB/API/mainNext.php"+"?name="+account+"&token="+token;
						document.getElementById("reservation").submit();
					}
					else{
							document.getElementById("reservation").action = "mainNext.php";
							document.getElementById("reservation").submit();
					}
				}
			</script>
			<!-- <script src="assets/web/assets/jquery/jquery.min.js"></script> -->
		  <script src="assets/popper/popper.min.js"></script>
		  <script src="assets/tether/tether.min.js"></script>
		  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		  <script src="assets/dropdown/js/script.min.js"></script>
		  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
		  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
		  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
		  <script src="assets/theme/js/script.js"></script>
		</body>
</html>
