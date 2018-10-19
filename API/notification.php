<?php
	function sendMessage($title,$body,$token){
		define( 'API_ACCESS_KEY', 'AAAAL-aQSkw:APA91bH04d1VvpIVzuoOLudXQQVoP8MZmB9P59bYhNHolZ1zcRMA6WyMx-N2Q8SvOUc6IVercEfrCoGkqJGMD76UmToJxJ8RULZkkGFv6uy05yyPpQvyKskwjY3oTq8s-zeEVT4FPadM' );
		#$token = "dIl76QtlQ34:APA91bF40pLA3Gk1Ga6QXENIacPoCTwwwjE3lxwiFzqdiG44A0RQvflx2TtT0TewR7gPNir1XE9sAn2D1L_Z9XOYsBMABn6nRl7wsMPTr-GrJ7p7eIZWmh4x5sCsmmYl5lKRESWG-l6L";
		#prep the bundle

		$msg = array(

		'body' 	=> $body,

		'title'	=> $title,

             	'icon'	=> 'myicon',/*Default Icon*/

              	'sound' => 'mySound'/*Default sound*/

        );

		$fields = array(

				'to'		=> $token,

				'notification'	=> $msg

		);

		$headers = array(

				'Authorization: key=' . API_ACCESS_KEY,

				'Content-Type: application/json'

		);

		#Send Reponse To FireBase Server	

		$ch = curl_init();

		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

		curl_setopt( $ch,CURLOPT_POST, true );

		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

		$result = curl_exec($ch );
		
		curl_close( $ch );

		#Echo Result Of FireBase Server
		
		echo $result;

	}
	
?> 