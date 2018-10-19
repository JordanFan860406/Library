<?php
  session_start();
  require_once("C:\AppServ\www\WEB\Library\API\keyTest.php");
  $token = $_GET['token'];
  $input = $_GET['name'];
  if($_SESSION['account'] == null && checkKeyVaild($token, $input)==false)
  {
    echo "failure";
    header("location:https://henjorly.ddns.net/WEB/Library/View/index.html");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="picture/Nknu_logo.png" type="image/x-icon">
    <title>高師大座位預約系統-預約紀錄</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- md5 js -->
    <script type="text/javascript" src="JS/md5.js"></script>
    <!-- jquery -->
    <script type="text/javascript" src="JS/jquery-3.3.1.min.js"></script>
    <!-- my web css -->
    <link rel="stylesheet" href="CSS/web.css">
		<!-- google icons -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- style -->
    <style>
      .background-home{
        background-image: url("picture/nknu.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size:cover;
      }
    </style>
  </head>
  <body style="font-family:Microsoft JhengHei;font-weight:bold;" class="background-home">
    <div id="sitebody">
      <!-- navBAR 區塊 -->
　     <div id="header">
        <section>
          <nav class="navbar navbar-expand-lg beta-menu navbar-dropdown align-items-center fixed-top navbar-toggleable-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="https://lis.nknu.edu.tw/zh/">
              <img src="picture/Nknu_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
              高師大圖資處
            </a>
            <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                  <a class="nav-link" href="home.php">首頁<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/WEB/Library/API/logout">登出</a>
                </li>
              </ul>

              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>
        </section>
      </div>
      <!-- ************************************************************************************************* -->
      <div id="sidebar_left"></div>
      <div id="sidebar_right"></div>

      <!-- 選項區塊 -->
      <div id="content">

      </div>
		<!--Modal 用來代替alert-->
		<div class="modal" id="myModal" tabindex="-1" role="dialog" style="position: fixed;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<h4 class="modal-title">高師大圖資處</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

						</button>
					</div>
					<div class="modal-body">
						<p id="alert">123</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="check" data-dismiss="modal">確定</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
      <!-- ******************************************************************************************************* -->

      <!-- footer 區塊 -->
　     <div id="footer">
         <footer >
           <div>
             <a href="#" style="color:white;">聯絡我們</a>
           </div>
           <div>
             <p>[燕巢校區]: 82444高雄市燕巢區深中路62號 </p>
             <p>© Copyright 2018 NKNU - All Rights Reserved</p>
           </div>
         </footer>
        </div>
     </div>
     <!-- ************************************************************************************************** -->
   </div>

	 <!-- ajax 查詢使用者姓名 -->
	 <!-- <script type="text/JavaScript">
			 $(document).ready(function() {
				 	 var account = "<?php echo $_SESSION['account']?>";
					 var search={
						 account: account
					 }
					 $.ajax({
						 type:"POST",
						 url: "/WEB/Library/API/searchName",
						 dataType:'JSON',
						 data:search
					 }).done(function(data) {
								 //成功的時候
								 console.log(data);
								 if(data.msg == "success")
								 {
									document.getElementById("username").innerHTML = "歡迎"+data.name+"進行使用";
								 }
								 else if(data.msg == "fail")
								 {
									 $('#alert').text('網頁執行錯誤，請重新登入');
									 $('#myModal').modal('show');
									 document.getElementById("check").onclick = function() {
												 window.location.href="index.html";
									 };
								 }

							 }).fail(function(jqXHR, textStatus, errorThrown) {
								 //失敗的時候
						 	 	alert(data);
								 alert("有錯誤產生，請看 console log");
								 console.log(jqXHR.responseText);
							 });
					 return false;
		 });
	 </script> -->
   <!-- jquery and js -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
