<?php

if (isset($acao) && $acao == "send_email"){

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "suporte@vacinarte-admin.com.br";
    $to = "hugo_3wl@yahoo.com.br";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
}
?>