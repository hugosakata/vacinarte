<?php
$message_body = [
	"title" => "teste push notification",
	"body" => "teste body teste",
];

$receiver_pn_users = [
    "post_title" => "ExponentPushToken[ZDYkv0J59zNuEQ0upuBrzO]"
];

$all_messages = [];
foreach ( $receiver_pn_users as $each_user ) {
	$each_message = $message_body;
	$each_message[ "to" ] = $each_user->post_title;	// post_title is the user token
	$all_messages[] = $each_message;
}

$all_messages_chucked = array_chunk( $all_messages, 99 );
$responses = [];
foreach ( $all_messages_chucked as $each_messages_chucked ) {
	// Ref: https://docs.expo.io/versions/latest/guides/push-notifications/#http2-api
	$responses[] = wp_safe_remote_post( "https://exp.host/--/api/v2/push/send", [
		'method' => 'POST',
		'timeout' => 15,
		'httpversion' => '2.0',
		'headers' => [ "content-type" => "application/json" ],
		'body' => json_encode( $each_messages_chucked ),
	] );
}