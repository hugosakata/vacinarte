<?php

if (isset($acao) && $acao == "send_email"){

    $to      = 'hugo_3wl@yahoo.com.br';
    $subject = 'teste recuperar senha';
    $message = 'hello';
    $headers = 'From: hugo_3wl@yahoo.com.br' . "\r\n" .
        'Reply-To: hugo_3wl@yahoo.com.br' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    echo "<script language='javascript' type='text/javascript'>
        alert('email enviado');</script>";
}
?>