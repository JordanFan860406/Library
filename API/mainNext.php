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
  	if($_SESSION['account'] != null || checkKeyVaild($token, $input)==true)
  {
    require_once("dbtools.inc.php");
    $link=create_connection();
    $account = $_SESSION['account'];
    $date = $_POST['datepicker'];
    $Arr = $_POST['selectArr'];
    $sql = "SELECT name FROM users WHERE account='$account' or account='$input'";
		$result = execute_sql($link,"member",$sql);
		$data = mysqli_fetch_array($result);
    $reservateSql="SELECT seatID, (TIME_TO_SEC(beginTime) / 60), (TIME_TO_SEC(endTime) / 60) FROM reservationlist WHERE date='$date'";
    $sql2="SELECT seatCode FROM seatnum WHERE seatInform='$Arr'";
    $result2 = execute_sql($link,"member",$sql2);
    $reservateResult = execute_sql($link,"member",$reservateSql);
  }
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="600;url=https://henjorly.ddns.net/WEB/WebView/login.html">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.4.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/-224x225.png" type="image/x-icon">
  <meta name="description" content="Site Builder Description">
  <title>進入預約</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
  <script type="text/javascript">
  var arr = "<?php echo $Arr;?>";
  var date = "<?php echo $date;?>";
  var account = "<?php echo $account?>";
  </script>
<style type="text/css">
  .w-auto {
    width: auto;
  }
  .scrollit {
      overflow-y: hidden;
      overflow-x:auto;
      border:2px solid gray;
      width: 100%;
  }
.pointer {cursor: pointer;}

</style>
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
    <section class="counters2 counters cid-qBNORzGXvA" id="counters2-w" data-rv-view="92">
    	<div class="row row-margin-top">
    	<div class="container  ">
           <div class="media-container">
    		<div class="col-md-12 align-center">
    			<div class="jumbotron jumbotron-fluid">
    				<div class="container">
    				<h1 id="h1"class="display-1" >歡迎<?php echo $data[0]?>進入預約</h1>
            <p class="lead">選擇日期:<?php echo $date?></p>
            <p class="lead">預約館別:<?php echo $Arr ?></p>
    				<p class="lead">下圖為座位分布圖</p>
    				</div>
        <img alt="座位分布圖" src="http://140.127.74.184/TEST/電算中心座位平面圖.png" class="img-thumbnail" />
    		</div>
        <table>
            <tbody class="table table-bordered table-responsive">
              <tr>
                <td style="background-color:rgb(255, 0, 0);">選取時段</td>
                <td style="background-color:rgb(26, 141, 241);">已借用時段(自己)</td>
                <td style="background-color:rgb(255, 226, 0);">已借用時段(他人)</td>
            </tr>
        </tbody></table>
        <div class="col-md-12 scrollit">
        <table class="col-md-12 align-center table table-striped table-responsive-md btn-table" id="dataTable" cellspacing="0" width="100%">
            <thead class="col-md-12 align-center">
              <tr>
                <th>時間\座位</th>
                  <?php
                    $index2 = 0;
                    while($data2 = mysqli_fetch_array($result2)){
                      $num= sizeof($data2['seatCode']);
                      echo "<th>&nbsp&nbsp&nbsp&nbsp" .$data2['seatCode']."</th>";
                      $index2 = $index2+1;
                    }
                  ?>
              </tr>
            </thead>
            <tbody class="col-md-12 align-center">
              <tr>
                <th scope="row">9:00~9:30</th>
                  <?php
                    $min = 540;
                    $btnNum = 1;
                    for($i=0; $i<$index2 ;$i++){
                      $str="540_".$btnNum;
                      echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str.'" value="'.$min.'"><font size=5>+</font></span></td>';
                      $btnNum = $btnNum + 1;
                    }
                  ?>
              </tr>
              <th scope="row">9:30~10:00</th>
                <?php
                  $min2 = 570;
                  $btnNum2 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str2="570_".$btnNum2;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str2.'" value="'.$min2.'"><font size=5>+</font></span></td>';
                    $btnNum2 = $btnNum2 + 1;
                  }
                ?>
              </tr>
              <th scope="row">10:00~10:30</th>
                <?php
                  $min3 = 600;
                  $btnNum3 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str3="600_".$btnNum3;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str3.'" value="'.$min3.'"><font size=5>+</font></span></td>';
                    $btnNum3 = $btnNum3 + 1;
                  }
                ?>
              </tr>
              <th scope="row">10:30~11:00</th>
                <?php
                  $min4 = 630;
                  $btnNum4 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str4="630_".$btnNum4;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str4.'" value="'.$min4.'"><font size=5>+</font></span></td>';
                    $btnNum4 = $btnNum4 + 1;
                  }
                ?>
              </tr>
              <th scope="row">11:00~11:30</th>
                <?php
                  $min5 = 660;
                  $btnNum5 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str5="660_".$btnNum5;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str5.'" value="'.$min5.'"><font size=5>+</font></span></td>';
                    $btnNum5 = $btnNum5 + 1;
                  }
                ?>
              </tr>
              <th scope="row">11:30~12:00</th>
                <?php
                  $min6 = 690;
                  $btnNum6 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str6="690_".$btnNum6;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str6.'" value="'.$min6.'"><font size=5>+</font></span></td>';
                    $btnNum6 = $btnNum6 + 1;
                  }
                ?>
              </tr>
              <th scope="row">12:00~12:30</th>
                <?php
                  $min7 = 720;
                  $btnNum7 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str7="720_".$btnNum7;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str7.'" value="'.$min7.'"><font size=5>+</font></span></td>';
                    $btnNum7 = $btnNum7 + 1;
                  }
                ?>
              </tr>
              <th scope="row">12:30~13:00</th>
                <?php
                  $min8 = 750;
                  $btnNum8 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str8="750_".$btnNum8;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str8.'" value="'.$min8.'"><font size=5>+</font></span></td>';
                    $btnNum8 = $btnNum8 + 1;
                  }
                ?>
              </tr>
              <th scope="row">13:00~13:30</th>
                <?php
                  $min9 = 780;
                  $btnNum9 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str9="780_".$btnNum9;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str9.'" value="'.$min9.'"><font size=5>+</font></span></td>';
                    $btnNum9 = $btnNum9 + 1;
                  }
                ?>
              </tr>
              <th scope="row">13:30~14:00</th>
                <?php
                  $min10 = 810;
                  $btnNum10 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str10="810_".$btnNum10;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str10.'" value="'.$min10.'"><font size=5>+</font></span></td>';
                    $btnNum10 = $btnNum10 + 1;
                  }
                ?>
              </tr>
              <th scope="row">14:00~14:30</th>
                <?php
                  $min11 = 840;
                  $btnNum11 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str11="840_".$btnNum11;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str11.'" value="'.$min11.'"><font size=5>+</font></span></td>';
                    $btnNum11 = $btnNum11 + 1;
                  }
                ?>
              </tr>
              <th scope="row">14:30~15:00</th>
                <?php
                  $min12 = 870;
                  $btnNum12 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str12="870_".$btnNum12;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str12.'" value="'.$min12.'"><font size=5>+</font></span></td>';
                    $btnNum12 = $btnNum12 + 1;
                  }
                ?>
              </tr>
              <th scope="row">15:00~15:30</th>
                <?php
                  $min13 = 900;
                  $btnNum13 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str13="900_".$btnNum13;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str13.'" value="'.$min13.'""><font size=5>+</font></span></td>';
                    $btnNum13 = $btnNum13 + 1;
                  }
                ?>
              </tr>
              <th scope="row">15:30~16:00</th>
                <?php
                  $min14 = 930;
                  $btnNum14 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str14="930_".$btnNum14;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str14.'" value="'.$min14.'"><font size=5>+</font></span></td>';
                    $btnNum14 = $btnNum14 + 1;
                  }
                ?>
              </tr>
              <th scope="row">16:00~16:30</th>
                <?php
                  $min15 = 960;
                  $btnNum15 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str15="960_".$btnNum15;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str15.'" value="'.$min15.'"><font size=5>+</font></span></td>';
                    $btnNum15 = $btnNum15 + 1;
                  }
                ?>
              </tr>
              <th scope="row">16:30~17:00</th>
                <?php
                  $min16 = 990;
                  $btnNum16 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str16="990_".$btnNum16;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str16.'" value="'.$min16.'"><font size=5>+</font></span></td>';
                    $btnNum16 = $btnNum16 + 1;
                  }
                ?>
              </tr>
              <th scope="row">17:00~17:30</th>
                <?php
                  $min17 = 1020;
                  $btnNum17 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str17="1020_".$btnNum17;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str17.'" value="'.$min17.'"><font size=5>+</font></span></td>';
                    $btnNum17 = $btnNum17 + 1;
                  }
                ?>
              </tr>
              <th scope="row">17:30~18:00</th>
                <?php
                  $min18 = 1050;
                  $btnNum18 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str18="1050_".$btnNum18;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str18.'" value="'.$min18.'"><font size=5>+</font></span></td>';
                    $btnNum18 = $btnNum18 + 1;
                  }
                ?>
              </tr>
              <th scope="row">18:00~18:30</th>
                <?php
                  $min19 = 1080;
                  $btnNum19 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str19="1080_".$btnNum19;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str19.'" value="'.$min19.'"><font size=5>+</font></span></td>';
                    $btnNum19 = $btnNum19 + 1;
                  }
                ?>
              </tr>
              <th scope="row">18:30~19:00</th>
                <?php
                  $min20 = 1110;
                  $btnNum20 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str20="1110_".$btnNum20;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str20.'" value="'.$min20.'"><font size=5>+</font></span></td>';
                    $btnNum20 = $btnNum20 + 1;
                  }
                ?>
              </tr>
              <th scope="row">19:00~19:30</th>
                <?php
                  $min21 = 1140;
                  $btnNum21 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str21="1140_".$btnNum21;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str21.'" value="'.$min21.'"><font size=5>+</font></span></td>';
                    $btnNum21 = $btnNum21 + 1;
                  }
                ?>
              </tr>
              <th scope="row">19:30~20:00</th>
                <?php
                  $min22 = 1170;
                  $btnNum22 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str22="1170_".$btnNum22;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str22.'" value="'.$min22.'"><font size=5>+</font></span></td>';
                    $btnNum22 = $btnNum22 + 1;
                  }
                ?>
              </tr>
              <th scope="row">20:00~20:30</th>
                <?php
                  $min23 = 1200;
                  $btnNum23 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str23="1200_".$btnNum23;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str23.'" value="'.$min23.'"><font size=5>+</font></span></td>';
                    $btnNum23 = $btnNum23 + 1;
                  }
                ?>
              </tr>
              <th scope="row">20:30~21:00</th>
                <?php
                  $min24 = 1230;
                  $btnNum24 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str24="1230_".$btnNum24;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str24.'" value="'.$min24.'"><font size=5>+</font></span></td>';
                    $btnNum24 = $btnNum24 + 1;
                  }
                ?>
              </tr>
              <th scope="row">21:00~21:30</th>
                <?php
                  $min25 = 1260;
                  $btnNum25 = 1;
                  for($i=0; $i<$index2 ;$i++){
                    $str25="1260_".$btnNum25;
                    echo '<td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" onclick="CheckClick(this)" check="no" id="'.$str25.'" value="'.$min25.'"><font size=5>+</font></span></td>';
                    $btnNum25 = $btnNum25 + 1;
                  }
                ?>
              </tr>
              </tr>
            </tbody>
            <!--Table body-->
          </table>
        </div>
          <button type="button" class="btn btn-primary" id="submitBtn" onclick="reservationSumit()">確定</button>
        </div>
        <!--Modal-->
        <div class="modal" id="#myModal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                <h4 class="modal-title">高師大圖資處</h4>

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
    	</div>
    	</div>
    </div>
    </section>
    <section>

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
                      © Copyright 2017 NKNU - All Rights Reserved
                  </p>
              </div>
          </div>
      </div>
  	</section>
    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/dropdown/js/script.min.js"></script>
    <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
    <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
    <script src="assets/smooth-scroll/smooth-scroll.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script type="text/JavaScript">
    <?php while($data3 = mysqli_fetch_array($reservateResult)){?>
      for(var j=<?php echo $data3['(TIME_TO_SEC(beginTime) / 60)']?>;j< <?php echo $data3['(TIME_TO_SEC(endTime) / 60)']?>;j=j+30){
        $("#"+j+"_"+<?php echo $data3['seatID']?>).prop("class","pointer btn-success btn-rounded btn-sm my-0");
        $("#"+j+"_"+<?php echo $data3['seatID']?>).attr("disabled", "disabled");
      }
    <?php } ?>
        var first_click = 0;
        var open_time = 540;
        var close_time = 1290;
        var period_minus=0;
        var seat_id_temp;
        var access_time="";
        var arrive_time="";
        var selected=0;
        var checkSelect=0;
        var seatNum;
        // $("#540_1").prop("class","pointer btn-success btn-rounded btn-sm my-0");
        // $("#540_1").attr("disabled", "disabled");
        // $("#660_1").prop("class","pointer btn-success btn-rounded btn-sm my-0");
        // $("#660_1").attr("disabled", "disabled");
        function CheckClick(check){
          var max_once = 180;
          var interval_time=30;
          $seat_id = check.id.split('_');//為陣列
          $seat_id[0] = parseInt($seat_id[0]);
          if(first_click==0){
            if($("#"+check.id).attr("disabled")!="disabled"){
              $("#"+check.id).prop("check","yes");
              $("#"+check.id).prop("class","pointer btn-primary btn-rounded btn-sm my-0");
              first_click = 1;
              if(selected<=180){
                selected = selected+30;
              }
              seat_id_temp=$seat_id;
            }
          }
          else{
            if($seat_id[1]==seat_id_temp[1] && ($seat_id[0]-seat_id_temp[0])==30 && selected<180){
                if($("#"+check.id).attr("disabled")!="disabled"){
                $("#"+check.id).prop("check","yes");
                $("#"+check.id).prop("class","pointer btn-primary btn-rounded btn-sm my-0");
                selected = selected+30;
                seat_id_temp=$seat_id;
              }
            }
            else if($seat_id[1]==seat_id_temp[1] && ($seat_id[0]-seat_id_temp[0])!=30){
              if($("#"+check.id).attr("disabled")!="disabled"){
                selected=30;
                for(i=540 ; i<1290 ; i=i+30){
                  if($("#"+i+"_"+$seat_id[1]).prop("check")=="yes"){
                    $("#"+i+"_"+$seat_id[1]).prop("check","no");
                    $("#"+i+"_"+$seat_id[1]).prop("class","pointer btn-outline-primary btn-rounded btn-sm my-0");
                  }
                }
                $("#"+check.id).prop("check","yes");
                $("#"+check.id).prop("class","pointer btn-primary btn-rounded btn-sm my-0");
                seat_id_temp=$seat_id;
              }
            }
            else if($seat_id[1]!=seat_id_temp[1]){
              if($("#"+check.id).attr("disabled")!="disabled"){
                selected=30;
                for(i=540 ; i<1290 ; i=i+30){
                  if($("#"+i+"_"+seat_id_temp[1]).prop("check")=="yes"){
                    $("#"+i+"_"+seat_id_temp[1]).prop("check","no");
                    $("#"+i+"_"+seat_id_temp[1]).prop("class","pointer btn-outline-primary btn-rounded btn-sm my-0");
                  }
                }
                $("#"+check.id).prop("check","yes");
                $("#"+check.id).prop("class","pointer btn-primary btn-rounded btn-sm my-0");
                seat_id_temp=$seat_id;
              }
            }

          }
        }
        function reservationSumit(){
          var checkArr=[];
          var index=0;
          for(var i=1; i<=<?php echo $index2?>; i+=1){
            for(var k=540 ; k<= 1260 ;k=k+30){
              if($("#"+k+"_"+i).prop("class")=="pointer btn-primary btn-rounded btn-sm my-0"){
                checkArr[index] =k;
                index=index+1;
                seatNum=i;
              }
            }
          }
          if(checkArr[0]%60==0){
            access_time=(parseInt(checkArr[0]/60))+":"+"00"+":"+"00";
          }
          else if(checkArr[0]%60==30){
            access_time=(parseInt(checkArr[0]/60))+":"+"30"+":"+"00";
          }
          if((checkArr[index-1]+30)%60==0){
            arrive_time=(parseInt((checkArr[index-1]+30)/60))+":"+"00"+":"+"00";
          }
          if((checkArr[index-1]+30)%60==30){
            arrive_time=(parseInt((checkArr[index-1]+30)/60))+":"+"30"+":"+"00";
          }
          var token = "<?php echo $token;?>";
          var accountGet = "<?php echo $input;?>";
          var finalAccount="";
          if(accountGet){
            finalAccount = accountGet;
          }
          else{
            finalAccount = account;
          }
          if(!access_time || !arrive_time){
              $('#alert').text('未選擇位子');
             $('#\\#myModal').modal('show');
          }
          else{
            $.ajax({
    					type:"POST",
    					url: "/WEB/API/reservationInsert",
    					dataType:'html',
    					data:
    					{
    						account: finalAccount,
    	          seatID : seatNum,
                date : date,
                beginTime : access_time,
                endTime : arrive_time,
    					}
    				}).done(function(data) {
    			        //成功的時候
    			        console.log(data);
    			        if(data == "success")
    			        {
                    $.ajax({
                      type:"POST",
                      url:"/WEB/API/appMessage",
                      dataType:'html',
                      data:
                      {
                        account:finalAccount,
                        seatID : seatNum,
                        date : date,
                        beginTime : access_time,
                        endTime : arrive_time,
                        arr:arr,
                      }
                    }).done(function(data){
                      console.log("YES");
                    }).fail(function(jqXHR, textStatus, errorThrown){

                    });
                    $('#alert').text('預約成功，網頁即將跳轉');
                    $('#\\#myModal').modal('show');
                    document.getElementById("check").onclick = function() {
                      window.location.href="https://henjorly.ddns.net/WEB/WebView/index.html";
                    };
    			        	//註冊新增成功，轉跳到登入頁面。

    			        	//window.location.href="http://140.127.74.184/WEB/WebView/index.html";
    			        }
                  else if(data=="NoSeat"){
                    $('#alert').text('預約失敗，請與系統人員聯繫或重新預約');
                    $('#\\#myModal').modal('show');
                    //window.location.href="http://140.127.74.184/WEB/API/mainNext.php"+"?name="+accountGet+"&token="+token;
                  }
    			        else if(data == "fail")
    			        {
                    if(token && accountGet){
                      $('#alert').text('預約失敗，請與系統人員聯繫或重新預約');
                      $('#\\#myModal').modal('show');
                      //window.location.href="http://140.127.74.184/WEB/API/mainNext.php"+"?name="+accountGet+"&token="+token;
                     }
                     else{
                       	alert("預約失敗，請與系統人員聯繫或重新預約");
                        //window.location.href="mainNext.php"
                     }
    			        }

    			      }).fail(function(jqXHR, textStatus, errorThrown) {
    			      	//失敗的時候
    					alert(data);
    			      	alert("有錯誤產生，請看 console log");
    			        console.log(jqXHR.responseText);
    			      });
              }
        }
  </script>
</body>
</html>
