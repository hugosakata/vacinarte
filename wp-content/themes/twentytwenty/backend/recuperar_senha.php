<?php

//if (isset($acao) && $acao == "send_email"){

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "suporte@vacinarte-admin.com.br";
    $to = "reidaltro@gmail.com";
    $subject = "Teste recuperação de senha";
    $message = "Seu código de segurança é: 589032";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
//}
?>