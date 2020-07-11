<?php

$endereco = $nm_end = $logra = $num_logra = $id_cli = $id_cmp = "";
$compl_logra = $bairro = $cep = $cidade = $msg_err = "";
$id_end = $id_vcl = 0;

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET['id'];
  $id_cmp = $_GET['id_cmp'];
}

 function load(){
    global $nm_end, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $uf_br, $msg_err,
    $id_cli, $id_cmp;

    $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
    $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));

    $nm_end = str_replace("'", "", trim($_POST["nm_end"]));
    $logra = str_replace("'", "", trim($_POST["logra"]));
    $num_logra = str_replace("'", "", trim($_POST["num_logra"]));
    $compl_logra = str_replace("'", "", trim($_POST["compl_logra"]));
    $bairro = str_replace("'", "", trim($_POST["bairro"]));
    $cep = str_replace("'", "", trim($_POST["cep"]));
    $cidade = str_replace("'", "", trim($_POST["cidade"]));
    $uf_br = str_replace("'", "", trim($_POST["uf_br"]));
 }

 function form_valido() {
    global $nm_end, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $uf_br, $msg_err;

    $valido = false;
    if (!empty($nm_end) &&
        !empty($logra) &&
        !empty($num_logra) &&
        !empty($bairro) &&
        !empty($cep) &&
        !empty($cidade) &&
        !empty($uf_br)){
          $valido = true;
    }

    return $valido;
 }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->query ("START TRANSACTION");
    $wpdb->insert(
      'ENDERECO',
      array(
        'nm_end'      => $nm_end,
        'logradouro'  => $logra,
        'num_end'     => $num_logra,
        'bairro'      => $bairro,
        'cep'         => $cep,
        'cidade'      => $cidade,
        'estado'      => $uf_br,
        'complemento' => $compl_logra
      ),
      array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
      )
    );
    $id_end = $wpdb->insert_id;

    // echo "<script language='javascript' type='text/javascript'>
    //   alert('{$id_cli}, {$id_end}');</script>";

    if ($id_cli > 0){
      $wpdb->insert(
        'VCL_ENDERECO',
        array(
          'cd_cli'      => $id_cli,
          'cd_end'      => $id_end        
        ),
        array(
          '%s',
          '%s'
        )
      );
      $id_vcl = $wpdb->insert_id;
    } else if($id_cmp > 0){
      $wpdb->insert(
        'VCL_END_CMP',
        array(
          'cd_cmp'      => $id_cmp,
          'cd_end'      => $id_end        
        ),
        array(
          '%s',
          '%s'
        )
      );
      $id_vcl = $wpdb->insert_id;
    }

    // echo "<script language='javascript' type='text/javascript'>
    // alert('{$id_end}, {$id_vcl}');</script>";

    if ($id_end > 0 && $id_vcl > 0){
      $wpdb->query("COMMIT");
      
      echo "<script language='javascript' type='text/javascript'>
      alert('Endereço salvo com sucesso!');</script>";

      //limpa formulario
      $endereco = $nm_end = $logra = $num_logra = "";
      $compl_logra = $bairro = $cep = $cidade = $msg_err = "";

      echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/listar-enderecos/?id={$id_cli}';</script>";

    } else {
      // $msg_err .= $wpdb->show_errors();
      // $msg_err .=$wpdb->print_error();

      $wpdb->query("ROLLBACK");

      $msg_err = "Ops! Algo deu errado, confirme os dados preenchidos e tente novamente";
    }

  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}
?>