<?php

load();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $acao = $_GET['acao'];
    $to_mail = $_GET['to_mail'];

    if (isset($acao) && $acao == "send_email") {

        if (filter_var($to_mail, FILTER_VALIDATE_EMAIL)) {

            $code_generate = rand(1000, 9999);

            $linhas_afetadas = $wpdb->update(
                'LOG_USU',
                array(
                    'code_password'   => $code_generate
                ),
                array ('email'  => $to_mail ),
                array(
                    '%d'
                ),
                array('%s')
            );

            if ($linhas_afetadas > 0) {
                $from = "suporte@vacinarte-admin.com.br";
                $subject = "Vacinarte - Recuperação de senha";
                $message = "Seu código de segurança é:\r\n{$code_generate}";
                $headers = "From:" . $from;
                mail($to_mail,$subject,$message, $headers);

                echo "<script language='javascript' type='text/javascript'>
                alert('Email enviado com sucesso!');</script>";
            } else {
                $msg_err = "Email não encontrado!";
            }
        } else
            $msg_err = "Email inválido!";
    }
}

function load(){
    global $to_mail, $new_password, $code;

    $to_mail = str_replace("'", "", trim($_POST["to_mail"]));
    $new_password = str_replace("'", "", trim($_POST["new_password"]));
    $code = str_replace("'", "", trim($_POST["code"]));
}

 function form_valido() {
    global $to_mail, $code, $new_password;

    $valido = false;
    if (!empty($to_mail) &&
        !empty($code) &&
        !empty($new_password)){
          $valido = true;
    }

    return $valido;
 }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    $sql = $wpdb->prepare($valida_codigo, $to_mail, $code);
    $user = $wpdb->get_row($sql);
    if ($user->total == 1) {
        $linhas_afetadas = $wpdb->update(
            'LOG_USU',
            array(
                'pw_usu'   => $new_password
            ),
            array ('email'  => $to_mail ),
            array(
                '%s'
            ),
            array('%s')
        );

        if ($linhas_afetadas > 0) {
            echo "<script language='javascript' type='text/javascript'>
                alert('Senha salva com sucesso!');</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
        }
    } else {
        $msg_err = "Código inválido!";
    }
    
  }
}
?>