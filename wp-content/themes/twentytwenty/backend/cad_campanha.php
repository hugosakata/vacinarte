<?php

$id_cmp = 0;
$nm_cmp = $cd_cli = $tp_srv = $local_srv = "";

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];
  $acao = $_GET['acao'];//acao=edit
  $sql = $wpdb->prepare($selecionar_campanha_com_tratamento , $id_cmp );
  $cmp = $wpdb->get_row($sql);
}

function date_converter($_date = null) {
  $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
  if ($_date != null && preg_match($format, $_date, $partes)) {
    return $partes[3].'-'.$partes[2].'-'.$partes[1];
  }
  return false;
}

function load(){
  global $nm_cmp, $cd_cli, $tp_srv, $local_srv, $data_ini, $data_fim;

  $nm_cmp = str_replace("'", "", trim($_POST["nm_cmp"]));
  $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  $local_srv = str_replace("'", "", trim($_POST["local_srv"]));
  $data_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  $data_fim = str_replace("'", "", trim($_POST["dt_fim"]));

}

function form_valido() {
  global $nm_cmp, $cd_cli, $tp_srv, $local_srv, $dt_ini, $dt_fim, $data_ini, $data_fim, $form;
  $dt_ini = date_converter($data_ini);
  $dt_fim = date_converter($data_fim);

  // echo "<script language='javascript' type='text/javascript'>
  //   alert('{$nm_cmp}, {$cd_cli}, {$tp_srv}, {$local_srv}, {$dt_ini}, {$dt_fim}');</script>";

  $valido = false;
  if (!empty($nm_cmp) &&
      !empty($cd_cli) &&
      !empty($tp_srv) &&
      !empty($local_srv) &&
      !empty($dt_ini) && 
      !empty($dt_fim)){
    $valido = true;
  }
  return $valido;
}

load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
  if (form_valido()){
    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'CAMPANHA',
        array(
          'nm_cmp'        => $nm_cmp,
          'cd_cli'        => $cd_cli,
          'cd_tp_srv'     => $tp_srv,
          'cd_local_srv'  => $local_srv,
          'dt_ini'        => $dt_ini,
          'dt_fim'        => $dt_fim
        ),
        array ('cd_cmp'  => $id_cmp ),
        array(
          '%s',
          '%d',
          '%d',
          '%d',
          '%s',
          '%s'
        ),
        array('%d')
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Campanha salva com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {
      $wpdb->insert(
        'CAMPANHA',
        array(
          'nm_cmp'        => $nm_cmp,
          'cd_cli'        => $cd_cli,
          'cd_tp_srv'     => $tp_srv,
          'cd_local_srv'  => $local_srv,
          'dt_ini'        => $dt_ini,
          'dt_fim'        => $dt_fim
        ),
        array(
          '%s',
          '%d',
          '%d',
          '%d',
          '%s',
          '%s'
        )
      );
      $id_cmp = $wpdb->insert_id;
      $sql = $wpdb->prepare($selecionar_campanha , $id_cmp );
      $cmp = $wpdb->get_row($sql);
      if ($id_cmp > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Campanha salva com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    }
    
    //limpa formulario
    $acao = $cd_cli = $tp_srv = $local_srv = "";
    $nm_cmp = $dt_ini = $dt_fim = $form = "";

  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}

?>