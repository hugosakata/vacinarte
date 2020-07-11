<?php
$razao = $nm_fant = $cnpj = $msg_err = $acao = $cd_cli = "";
$id_cli = 0;

 function load(){
    global $razao, $nm_fant, $cnpj, $acao, $id_cli;

    $acao = str_replace("'", "", trim($_POST["acao"]));
    $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
    $razao = str_replace("'", "", trim($_POST["razao"]));
    $nm_fant = str_replace("'", "", trim($_POST["nm_fant"]));
    $cnpj = str_replace("'", "", trim($_POST["cnpj"]));
    
 }

 function form_valido() {
    global $razao, $nm_fant, $cnpj, $msg_err;
    
    $valido = false;
    if (!empty($razao) && 
        !empty($nm_fant) && 
        !empty($cnpj)){
          $valido = true;
    }

    return $valido;
 }

//  function set_cliente($id){
//     global $cliente, $id_cli;
//     $sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_cli}'";
//     $cliente = $wpdb->get_row($sql);
//     $id_cli = $cliente->cd_cli;
//  }

 load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET["id"];
  $acao = $_GET["acao"];

  //$sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_cli}'";
  $sql = $wpdb->prepare($selecionar_cliente , $id_cli );
  $cliente = $wpdb->get_row($sql);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'CLIENTES',
        array(
          'nm_rz_soc' => $razao,
          'nm_fant'   => $nm_fant,
          'cpf_cnpj'  => $cnpj,
          'cd_tp_cli' => 2
        ),
        array( 'cd_cli' =>  $id_cli),
        array(
          '%s',
          '%s',
          '%s',
          '%d'
        )
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Cliente salvo com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {
      $wpdb->insert(
        'CLIENTES',
        array(
          'nm_rz_soc' => $razao,
          'nm_fant'   => $nm_fant,
          'cpf_cnpj'  => $cnpj,
          'cd_tp_cli' => 2
        ),
        array(
          '%s',
          '%s',
          '%s',
          '%d'
        )
      );
      $id_cli = $wpdb->insert_id;
      //$sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_cli}'";
      $sql = $wpdb->prepare($selecionar_cliente , $id_cli );
      $cliente = $wpdb->get_row($sql);

      echo "<script language='javascript' type='text/javascript'>
      alert('Cliente salvo com sucesso!');</script>";

      echo "<script language='javascript' type='text/javascript'>
      window.location.href='{$home}/listar-pj/';</script>";
    }
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}

?>