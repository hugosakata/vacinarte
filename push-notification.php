<?php

$message_body = array(
	'title' => 'teste push notification cron',
	'body' => 'teste pelo cron teste'
);
// $msg_teste = $message_body['title'];
// echo "<script language='javascript' type='text/javascript'>
// alert('message_body->title: {$msg_teste}');</script>";

$receiver_pn_users = array( 
    'ExponentPushToken[ZDYkv0J59zNuEQ0upuBrzO]'
);
// $msg_teste = $receiver_pn_users;
// echo "<script language='javascript' type='text/javascript'>
// alert('receiver_pn_users->post_title: {$msg_teste}');</script>";

$all_messages = [];
foreach ( $receiver_pn_users as $each_user ) {
	$each_message = $message_body;
	$each_message[ "to" ] = $each_user;	// post_title is the user token
    $all_messages[] = $each_message;
   
    // $msg_teste = $each_user;
    // echo "<script language='javascript' type='text/javascript'>
    // alert('each_message {$msg_teste}');</script>";
}

$all_messages_chucked = array_chunk( $all_messages, 99 );
$responses = [];
foreach ( $all_messages_chucked as $each_messages_chucked ) {

    // $msg_teste = $each_messages_chucked['to'];
    // echo "<script language='javascript' type='text/javascript'>
    // alert('enviando push {$msg_teste}');</script>";

	// Ref: https://docs.expo.io/versions/latest/guides/push-notifications/#http2-api
	$responses[] = wp_safe_remote_post( "https://exp.host/--/api/v2/push/send", [
		'method' => 'POST',
		'timeout' => 15,
		'httpversion' => '2.0',
		'headers' => [ "content-type" => "application/json" ],
		'body' => json_encode( $each_messages_chucked ),
	] );
}

// echo "<script language='javascript' type='text/javascript'>
// alert('push enviado');</script>";