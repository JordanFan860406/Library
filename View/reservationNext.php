<?php
  session_start(600);
  require_once("C:\AppServ\www\WEB\Library\API\keyTest.php");
  $token = $_GET['token'];
  $input = $_GET['name'];
  $date = $_POST['datepicker'];
  $location = $_POST['location'];
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
    <!-- jquery -->
    <script type="text/javascript" src="JS/jquery-3.3.1.min.js"></script>
    <!-- bootstrap css -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- md5 js -->
    <script type="text/javascript" src="JS/md5.js"></script>
    <!-- my web css -->
    <link rel="stylesheet" href="CSS/web.css">
    <!-- other CSS -->
    <script type="text/javascript" src="JS/owl.carousel.js"></script>
    <link rel="stylesheet" href="CSS/owl.carousel.css">
    <link rel="stylesheet" href="CSS/owl.theme.default.css">
    <link rel="stylesheet" href="CSS/owl.theme.green.css">
		<!-- google icons -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- style -->
    <!-- end -->
    <!-- my setting style -->
    <style>
      .background-home{
        background-image: url("picture/nknu.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size:cover;
      }
      .table {
            background-color: #FFF;
      }

      .th{
          background-color: #3c8376;
          color: #FFF;
          width:500px;
      }
      .pointer {
        cursor: pointer;
      }
      td{
        width: 250px;
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
	         <div class="row align-center" style="text-align:center">
             <div class="col-md-2 ">
             </div>
             <div class="col-md-8 ">
               <hr class="my-3">
               <h1><i class="material-icons" style="font-size:35px;color:black">add_to_photos</i> 開始 <strong>座位預約</strong></h1>
               <hr class="my-3">
               <h3><em class="display-5">步驟二: 請選擇借用時段。</em></h3>
               <h5><em class="display-5">若無預約表格請重新整理網頁</em></h5>
               <hr class="my-3">
               <!-- 預約館別與時間 -->
               <table class="table table-bordered table-responsive" style="width:100%">
                 <tbody style="text-align:center">
                   <tr>
                     <th class="th bg-info" width="30%">
                       <i class="material-icons" style="font-size:20px">pin_drop</i> 館別
                     </th>
                     <td class="bg-white" style="width:600px"><?php echo $location;?>&nbsp&nbsp&nbsp&nbsp<input type="button" data-toggle="modal" data-target="#myModal" id="seat" class="btn btn-info" value="座位預覽"></td>
                    </tr>
                    <tr>
                      <th class="th bg-info" width="30%">
                        <i class="material-icons" style="font-size:20px">date_range</i> 日期
                      </th>
                      <td class="bg-white" style="width:600px"><?php echo $date;?> </td>
                    </tr>
                  </tbody>
                </table>
                <!-- 預約相關時間規定 -->
                <table class="table table-bordered table-responsive" style="width:100%">
                  <tbody style="text-align:center">
                    <tr>
                      <th class="th bg-info" width="50%">
                        <i class="material-icons" style="font-size:20px">timer</i> 使用者單次最少借用
                      </th>
                      <td class="bg-white" style="width:500px">30分鐘</td>
                     </tr>
                     <tr>
                       <th class="th bg-info" width="50%">
                         <i class="material-icons" style="font-size:20px">timer</i>使用者單次最多借用
                       </th>
                       <td class="bg-white" style="width:500px">180分鐘</td>
                     </tr>
                   </tbody>
                 </table>

                 <!-- 預約狀態表 -->
                 <table class="table table-bordered table-responsive" style="width:100%">
                   <td class="bg-primary" style="width:500px">選取時段</td>
                   <td class="bg-warning" style="width:500px">已被借用時段</td>
                   <td class="bg-danger" style="width:500px">停用時段</td>
                 </table>
                 <!-- 預約表單選擇 -->
                 <div id="table">
                   <div class="owl-carousel owl-theme">
                     <table class="table table-bordered table-responsive">
                       <tbody>
                         <tr>
                           <th class="th"> </th>
                           <td>A01</td>
                           <td>A02</td>
                           <td>A03</td>
                           <td>A04</td>
                           <td>A05</td>
                           <td>A06</td>
                           <td>A07</td>
                           <td>A08</td>
                           <td>A09</td>
                           <td>A10</td>
                         </tr>
                         <tr id="tr_one">
                           <th class="th">8:00~8:30</th>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_1" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_2" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_3" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_4" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_5" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_6" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_7" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_8" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_9" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                           <td><span class="pointer btn-outline-primary btn-rounded btn-sm my-0" id="480_10" onclick="CheckClick(this)" check="no" value="480"><font size="5">+</font></span></td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
                 <script>
                    var local = "<?php echo $location?>";
                    var date = "<?php echo $date;?>";
                    var account = "<?php echo $_SESSION['account'];?>";
                    var colnum;
                    var firstSeatID;
                    var page;//頁數
                    var table;// 表單tag
                    var tempNum;
                    var index = 0;
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
                    if(local == "電算中心"){
                      var temp = $('#tr_one').clone();
                      var counter = 0;
                      for(var i=0 ; i<300 ; i++){
                        var element = $(temp).clone();
                        $('#table tbody').append(element);
                      }

                      // $('#table').load( "CCtable.html", function( response, status, xhr ) {
                      //   if ( status == "error" ) {
                      //     $('#table').load( "CCtable.html");
                      //     console.log("error");
                      //   }
                      //   if(status == "success"){
                      //     console.log("success");
                      //     $.ajax({
                      //       type:"POST",
                      //       url: "/WEB/library/API/alreadySeat",
                      //       dataType:'JSON',
                      //       data:{
                      //         date:date
                      //       }
                      //     }).done(function(data) {
                      //           //成功的時候
                      //           console.log(data);
                      //           if(data.msg == "success")
                      //           {
                      //             // alert(data.already[0].seatID)
                      //             for(var i=0 ; i<data.already.length ; i++){
                      //               for(var j=parseInt(data.already[i].begin) ; j<parseInt(data.already[i].end) ; j=j+30){
                      //                 $("#"+j+"_"+data.already[i].seatID).prop("class","pointer btn-warning btn-rounded btn-sm my-0");
                      //                 $("#"+j+"_"+data.already[i].seatID).attr("disabled", "disabled");
                      //               }
                      //             }
                      //           }
                      //           else if(data.msg == "fail")
                      //           {
                      //             // $('#alert').text('失敗');
                      //             // $('#myModal').modal('show');
                      //           }
                      //         }).fail(function(jqXHR, textStatus, errorThrown) {
                      //           //失敗的時候
                      //           alert(data);
                      //           alert("有錯誤產生，請看 console log");
                      //           console.log(jqXHR.responseText);
                      //         });
                      //   }
                      // });
                      // firstSeatID=12;
                    }else if(local == "和平愛閱館"){

                    }else if(local == "燕巢愛閱館"){

                    }

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
                              for(i=480 ; i<1320 ; i=i+30){
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
                              for(i=480 ; i<1320 ; i=i+30){
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

                      function send(){
                        var checkArr=[];
                         var index=0;
                         for(var i=1; i<=firstSeatID; i+=1){
                           for(var k=480 ; k< 1320 ;k=k+30){
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

                         // ajax 處理 預約資訊
                         //alert(access_time + "~"+arrive_time);
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
                            $('#myModal').modal('show');
                         }else{
                           $.ajax({
                             type:"POST",
                             url: "/WEB/library/API/seatInsert",
                             dataType:'JSON',
                             data:{
                               account: finalAccount,
                               seatID:seatNum,
                               date:date,
                               beginTime : access_time,
                               endTime : arrive_time
                             }
                           }).done(function(data) {
                                 //成功的時候
                                 console.log(data);
                                 if(data.msg == "success")
                                 {
                                   $('#alert').text('預約成功，網頁即將跳轉');
                                   $('#myModal').modal('show');
                                   //註冊新增成功，轉跳到登入頁面。
                                   document.getElementById("check").onclick = function() {
                                         window.location.href="home.php";
                                   };
                                 }
                                 else if(data.msg == "fail")
                                 {
                                   $('#alert').text('登入失敗，請與系統人員聯繫或重新登入');
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
                         }

                        }
                 </script>
                 <!-- css use by table -->
                 <input type="button" class="btn btn-primary" value="送出預約" id="submitBtn" onclick="send()">
                 <hr class="my-3">
             </div>
             <div class="col-md-2 ">
             </div>
           </div>
         </div>
       </div>

		<!--Modal 用來代替alert-->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" style="position: fixed;background-color:rgba(0, 0, 0, 0.6);">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:rgba(255, 255, 255, 0.1);color:white">
          <div class="modal-header">
              <h1>高師大圖資處</h1>
              <h4 class="modal-title" id="ModalTitle"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

            </button>
          </div>
          <div class="modal-body" id="modalBody">
            <p id="alert"></p>
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
      <!-- 圖片 -->
      <div class="modal" id="Modal" tabindex="-1" role="dialog" style="position: fixed;background-color:rgba(0, 0, 0, 0.6);">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="background-color:rgba(255, 255, 255, 0.1);color:white">
            <div class="modal-header">
                <h4 class="modal-title" id="Title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

              </button>
            </div>
            <div class="modal-body" id="Body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="Imgcheck" data-dismiss="modal">確定</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
   <!-- javascript -->
   <script type="text/javascript">
     $(document).ready(function(){
       //查詢位置並建立表單
       $('.owl-carousel').owlCarousel({
        nav:true,
        items:1
      })
      var loc = "<?php echo $location?>";
      $('#seat').click(function(){
       if(loc == "電算中心"){
         document.getElementById("Title").innerHTML = loc +" 座位表";
         document.getElementById("Body").innerHTML = "<img width='400' height='250' src='picture/center.png'>";
         $('#Modal').modal('show');
       }else if(loc=="和平愛閱館"){
         document.getElementById("Title").innerHTML = loc +" 座位表";
         $('#Modal').modal('show');
       }else if(loc=="燕巢愛閱館"){
         document.getElementById("Title").innerHTML = loc +" 座位表";
         $('#Modal').modal('show');
       }
    });
       // $.ajax({
       //   type:"POST",
       //   url: "/WEB/Library/API/searchSeat",
       //   dataType:'JSON',
       //   data:search
       // }).done(function(data) {
       //       //成功的時候
       //       console.log(data);
       //       colnum = data.seat.length;
       //       firstSeatID = parseInt(data.seat[0].seatID);
       //       if(data.msg == "success"){
       //         if(colnum%10==0){
       //           page = colnum/10;
       //         }else{
       //           page = parseInt(colnum/10)+1;
       //         }
       //         if(page == 1){
       //            table="";
       //             table +="<div class='owl-item'><table class='table table-bordered table-responsive'><tbody><tr><th class='th'>     </th>";
       //             for(var j=index ; j<colnum ; j++){
       //               table += "<td>" + data.seat[j].seatCode+"</td>";
       //             }
       //             table +="</tr>";
       //             for(var k=0; k<seatvalue.length; k++){
       //               table +="<tr><th class='th'>"+time[k]+"</th>";
       //               for(var i=index; i<colnum ; i++){
       //                 table +="<td><span class='pointer btn-outline-primary btn-rounded btn-sm my-0' id='"+seatvalue[k]+"_"+data.seat[i].seatID+"' class='pointer btn-outline-primary btn-rounded btn-lg my-0' onclick='CheckClick(this)' check='no' value='"+seatvalue[k]+"'><font size=5>+</font></span></td>";
       //               }
       //               table +="</tr>"
       //             }
       //             table +="</tbody></table></div>";
       //         }else {
       //           var temp;
       //           for(var a=0; a<page ; a++){
       //             table="";
       //             table +="<div class='owl-item'><table class='table table-bordered table-responsive'><tbody><tr><th class='th'>     </th>";
       //             if((a+1)==page){
       //               temp = colnum%10;
       //             }else{
       //               temp = 10;
       //             }
       //             for(var b=index ; b<(index+temp);b++){
       //               table += "<td>" + data.seat[b].seatCode+"</td>";
       //             }
       //             table +="</tr>";
       //             for(var c=0; c<seatvalue.length; c++){
       //               table +="<tr><th class='th'>"+time[c]+"</th>";
       //               for(var d=index; d<(index+temp) ; d++){
       //                 table +="<td><span class='pointer btn-outline-primary btn-rounded btn-sm my-0' id='"+seatvalue[c]+"_"+data.seat[d].seatID+"' class='pointer btn-outline-primary btn-rounded btn-lg my-0' onclick='CheckClick(this)' check='no' value='"+seatvalue[c]+"'><font size=5>+</font></span></td>";
       //               }
       //               table +="</tr>"
       //             }
       //             index+=10;
       //             table +="</tbody></table></div>";
       //            $('#table').append(table);
       //           }
       //
       //         }
       //
       //
       //       }else if(data.msg == "fail"){
       //         $('#alert').text('網頁執行錯誤，請重新登入');
       //         $('#myModal').modal('show');
       //       }
       //
       //     }).fail(function(jqXHR, textStatus, errorThrown) {
       //       //失敗的時候
       //      alert(data);
       //       alert("有錯誤產生，請看 console log");
       //       console.log(jqXHR.responseText);
       //     });
       //     //表單建立結束

           //位子圖Modal
           //var local ="<?php echo $location;?>";


         //預約送出處理


       });

    //表單方法

      //表單事件結束
   </script>
   <!-- jquery and js -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
