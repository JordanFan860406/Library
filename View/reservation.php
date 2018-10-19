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
    <title>高師大座位預約系統-預約座位</title>
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
    <!-- date -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function () {
      $('#datepicker').datepicker({
        dateFormat:'yy/mm/dd',
        maxDate: '+5D',
        minDate: '-0D',
        orientation: "bottom auto"
      });
      $('#selectDate').click(function() {
        $('#datepicker').datepicker('show');
      });
    });
    </script>
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
                  <a class="nav-link" href="user.php">會員資料查詢</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="history.php">預約紀錄</a>
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
        <div class="container">
	         <div class="row">
               <div class="col-md-3 align-center" style="text-align:center">
               </div>
		           <div class="col-md-6 align-center" style="text-align:center">
                 <hr class="my-3">
                 <h1><i class="material-icons" style="font-size:35px;color:black">add_to_photos</i> 開始 <strong>座位預約</strong></h1>
                 <hr class="my-3">
                 <h3><em class="display-5">步驟一: 請選擇館別與日期。</em></h3>
                 <hr class="my-3">
                 <form id="formNext" name="formNext" method="post">
                   <!-- 選擇館別 -->
                  <div class="form-group">
                    <div class="input-group mb-3 ">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-info"><i class="material-icons" style="font-size:36px">pin_drop</i>館別</span>
                      </div>
                      <select required style="height:50px" class="custom-select form-control" id="location" name="location">
                        <option selected disabled>請選地點</option>
                        <option value="電算中心">電算中心</option>
                        <option value="和平愛閱館">和平愛閱館</option>
                        <option value="燕巢愛閱館">燕巢愛閱館</option>
                      </select>
                    </div>
                  </div>
                  <!-- 選擇日期 -->
                  <div class="form-group">
                    <div class="input-group mb-3 date">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-info"><i class="material-icons" style="font-size:36px">date_range</i>日期</span>
                      </div>
                      <input type="text" id="datepicker" name="datepicker" class="form-control" value="" placeholder="yyyy/MM/dd" readonly="true" required>
                      <div class="input-group-append">
                        <input type="button" id="selectDate" class="btn btn-info" aria-label="select" aria-describedby="basic-addon1" value="選取">
                      </div>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-info" value="下一步">
                </form>
               </div>
               <div class="col-md-3 align-center" style="text-align:center">
               </div>
             </div>
            </div>
          </div>
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
   <script type="text/javascript">
   $(document).ready(function() {
     //送出資料並判斷是否空值
     $("#formNext").submit(function() {
       if($('#location').val()==null && $('#datepicker').val()==""){
         alert('請選擇地點和日期');
       }else if($('#location').val()!=null && $('#datepicker').val()==""){
         alert('請選擇日期');
       }else if($('#location').val()==null && $('#datepicker').val()!=""){
         alert('請選擇地點');
       }else if($('#location').val()!=null && $('#datepicker').val()!=""){
         var token = "<?php echo $token;?>";
         var account = "<?php echo $input;?>";
         if(token && account){
           document.getElementById("formNext").action = "/WEB/Library/View/reservationNext.php"+"?name="+account+"&token="+token;
           document.getElementById("formNext").submit();
         }
         else{
             document.getElementById("formNext").action = "reservationNext.php";
             document.getElementById("formNext").submit();
         }
       }
     });

   });
   </script>
   <!-- jquery and js -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
