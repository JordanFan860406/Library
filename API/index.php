<?php
	require 'vendor/autoload.php';
	require_once("db_connect.php");
	$app = new \Slim\App;
	$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

	//Login check
	$app->post('/checkpwd', function ($request, $response) {
		$account=$_POST["account"];
		$password=$_POST["password"];
		$db_con = new DB();
		$db_con->connect();
		$login = $db_con->check_login($account , $password);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($login);
		return $response;
	});

	//Member Register
	$app->post('/register', function ( $request,  $response) {
		$account=$_POST["account"];
		$password=$_POST["password"];
		$re_password=$_POST["re_password"];
		$name=$_POST["name"];
		$personID=$_POST["personID"];
		$email=$_POST["email"];
		$db_con = new DB();
		$db_con->connect();
		$signup = $db_con->register($account, $password, $re_password, $name,$personID,$email);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($signup);
		return $response;
	});

	//Search member's name
	$app->post('/searchName', function ( $request, $response) {
		$account=$_POST["account"];
		$db_con = new DB();
		$db_con->connect();
		$name = $db_con->searchName($account);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($name);
		return $response;
	});

	//Searching Library seatCode
	$app->post('/searchSeat', function ( $request, $response) {
		$location=$_POST["location"];
		$db_con = new DB();
		$db_con->connect();
		$seat = $db_con->searchSeat($location);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($seat);
		return $response;
	});

	//check QRcode correct
	$app->post('/checkQR', function ( $request, $response) {
		$token=$_POST["token"];
		$date=$_POST["date"];
		$time=$_POST["time"];
		$seat=$_POST["seat"];
		$db_con = new DB();
		$db_con->connect();
		$QRcode = $db_con->checkQR($token, $time, $date, $seat);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($QRcode);
		return $response;
	});

	//seatCheck
	$app->post('/seatCheck', function ( $request, $response) {
		$date=$_POST["date"];
		$db_con = new DB();
		$db_con->connect();
		$seatCheck = $db_con->seatCheck($date);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($seatCheck);
		return $response;
	});

	$app->post('/alreadySeat', function ( $request, $response) {
		$date=$_POST["date"];
		$db_con = new DB();
		$db_con->connect();
		$already = $db_con->alreadySeat($date);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($already);
		return $response;
	});

	//reservation insert
	$app->post('/seatInsert', function ( $request, $response) {
		$account=$_POST["account"];
		$seatID=$_POST["seatID"];
		$date=$_POST["date"];
		$beginTime=$_POST["beginTime"];
		$endTime=$_POST["endTime"];
		$db_con = new DB();
		$db_con->connect();
		$seatinsert = $db_con->seatInsert($account, $seatID, $date, $beginTime, $endTime);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withJson($seatinsert);
		return $response;
	});

	$app->post('/decrypt', function ( $request,  $response) {
	  require_once("keyTest.php");
		$token=$_POST["token"];
		$getToken=decryptedToken($token);
		return $getToken;
	});


	$app->get('/logout', function ( $request, $response) {
		$db_con = new DB();
		$request=$db_con->logout();
		return $logout ;
	});
	$app->get('/test', function ( $request, $response) {
		return header('Location: http://jordanfan.ddns.net');
	});
	$app->post('/insertToken', function ( $request,  $response) {
	  require_once("fcmToken.php");
		$account=$_POST["account"];
		$token=$_POST["token"];
		$getToken=tokenInsert($account, $token);
		return $getToken;
	});
	$app->post('/notification', function ( $request,  $response) {
	  require_once("notification.php");
		$title=$_POST["title"];
		$body=$_POST["body"];
		$token=$_POST["token"];
		$push=sendMessage($title,$body,$token);
		return $push;
	});
	$app->post('/reservationInsert', function ( $request,  $response) {
	  require_once("reservationInsert.php");
		$account=$_POST["account"];
		$seatID=$_POST["seatID"];
		$date=$_POST["date"];
		$beginTime=$_POST["beginTime"];
		$endTime=$_POST["endTime"];
		$getSeat=seatInsert($account, $seatID, $date, $beginTime, $endTime);
		return $getSeat;
	});
	$app->get('/getIP', function($request, $response){
		require_once("keyTest.php");
		$getIP=get_client_ip();
		return $getIP;
	});
	$app->get('/token', function($request, $response){
		require_once("keyTest.php");
		$token=eccodeToken();
		return $token;
	});
	$app->post('/tokenCheck', function($request, $response){
		require_once("keyTest.php");
		$inputToken = $_POST['token'];
		$inputStuID = $_POST['account'];
		$checkToken = decodeToken($inputToken, $inputStuID);
		return $getIP;
	});
	$app->post('/appMessage', function ( $request,  $response) {
	  require_once("appNotification.php");
		$account=$_POST["account"];
		$seatID=$_POST["seatID"];
		$date=$_POST["date"];
		$beginTime=$_POST["beginTime"];
		$endTime=$_POST["endTime"];
		$arr=$_POST["arr"];
		$sendApp=sendNotification($account, $seatID, $date, $beginTime, $endTime, $arr);
		return $sendApp;
	});
	$app->run();
?>
