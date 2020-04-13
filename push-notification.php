<?php

global $wpdb;

$sql = "select nm_usu, ";
        $sql .="ifnull(bl_sit_usu, 0) as ativo, ";
        $sql .="count(tx_log_usu) as existe from LOG_USU ";
        $sql .="where tx_log_usu = 'hugousu' and pw_usu = 'hugo123'";
        $user = $wpdb->get_row($sql);
        if($user->ativo == 1 && $user->existe == 1){
			$msg_err="Bem-vindo " . $user->nm_usu;
		} else {
			$msg_err="deu ruim";
		}

$message_body = array(
	'title' => 'teste push notification cron',
	'body' => $msg_err
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
	echo "registro push para " . $each_user;
}

$all_messages_chucked = array_chunk( $all_messages, 99 );
$responses = [];
foreach ( $all_messages_chucked as $each_messages_chucked ) {

    // $msg_teste = $each_messages_chucked['to'];
    // echo "<script language='javascript' type='text/javascript'>
    // alert('enviando push {$msg_teste}');</script>";

	echo "tentando enviar push";

	sendPostData_v1("https://exp.host/--/api/v2/push/send", json_encode( $each_messages_chucked ));
	echo "push enviado";
}

function sendPostData_v1($url, $data) {
	$opts = array('http' => array(
	  'method' => 'POST', 
	  'header' => "Content-type: application/json\r\n",
	  'content' => $data
	  )); 
	$stream = stream_context_create($opts); 
	$fp = fopen($url, 'rb', false, $stream); 
	if (!$fp) { // Some error handling 
	} 
   
	// Find out what the page returns as its body 
	$reply = stream_get_contents($fp); 
	if ($reply === false) { // Some error handling 
	} 
   
	return $reply; 
  }

// echo "<script language='javascript' type='text/javascript'>
// alert('push enviado');</script>";
?>