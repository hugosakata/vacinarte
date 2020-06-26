<?php /* Template Name: TelaCadAgenda */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url();
?>

<?php

$id_cmp = $dt_atend = $data_atend = $hr_ini = $hr_fim = $qtd_vcna_envio = $nm_enfermeiro = $qtd_vcna = "";
$ids_vacinas = array();

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];//id da campanha
  $sql = "
          SELECT 
          CAMPANHA.`cd_cmp`, `nm_cmp`, `nm_fant`, `cd_vcl_end`, `nm_tp_srv`, date_format(`dt_ini`, '%d/%m/%Y') AS dt_ini, date_format(`dt_fim`, '%d/%m/%Y') AS dt_fim, `VCL_VCNA_CMP`.`cd_vcl_vcna_cmp`, `VACINA`.nm_gen, `VCL_VCNA_CMP`.`qtd_vcna_contratada`, `VCL_VCNA_CMP`.`qtd_vcna_restante`
          FROM `CAMPANHA`, `TP_SRV`, `CLIENTES`, `VCL_VCNA_CMP`, `VACINA`
          WHERE `CAMPANHA`.`cd_tp_srv`=`TP_SRV`.`cd_tp_srv` AND
          `CAMPANHA`.`cd_cli`=`CLIENTES`.`cd_cli` and
          VCL_VCNA_CMP.cd_cmp=CAMPANHA.cd_cmp AND
          VCL_VCNA_CMP.cd_vcna=VACINA.cd_vcna AND
          CAMPANHA.cd_cmp = '{$id_cmp}'
          ";

  $campanhas = $wpdb->get_results($sql);
  $campanha = $campanhas[0];
  foreach($campanhas as $campanha_item) {
    array_push($ids_vacinas, array("id" => $campanha_item->cd_vcl_vcna_cmp, "valor" => ""));
  }  
}

function date_converter($_date = null) {
  $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
  if ($_date != null && preg_match($format, $_date, $partes)) {
    return $partes[3].'-'.$partes[2].'-'.$partes[1];
  }
  return false;
  }

 function load(){
    global $id_cmp, $dt_atend, $data_atend, $hr_ini, $hr_fim, $qtd_vcna_envio, $nm_enfermeiro, $ids_vacinas;

    $data_atend = str_replace("'", "", trim($_POST["dt_atend"]));
    $hr_ini = str_replace("'", "", trim($_POST["hr_ini"]));
    $hr_fim = str_replace("'", "", trim($_POST["hr_fim"]));
    $nm_enfermeiro = str_replace("'", "", trim($_POST["nm_enfermeiro"]));
    //$qtd_vcna_envio = str_replace("'", "", trim($_POST["qtd_vcna_envio"]));

    foreach($ids_vacinas as $key => $id_vacina) {
      // echo "<script language='javascript' type='text/javascript'>
      //   alert('pegando " . $id_vacina["id"] . "');</script>";
      $valor = str_replace("'", "", trim($_POST[$id_vacina["id"]]));
      $ids_vacinas[$key]["valor"] = $valor;
      // echo "<script language='javascript' type='text/javascript'>
      // alert('recebi " . $id_vacina["valor"] . "');</script>";
    }
    // foreach($ids_vacinas as $id_vacina) {
    //   $msg = "id:" . $id_vacina["id"] . ", valor:" .  $id_vacina["valor"];
    //   echo "<script language='javascript' type='text/javascript'>
    //     alert('" . $msg . "');</script>";
    // }
 }

 function form_valido() {
    global $id_cmp, $dt_atend, $data_atend, $hr_ini, $hr_fim, $qtd_vcna_envio, $nm_enfermeiro, $ids_vacinas;  

    $dt_atend = date_converter($data_atend);

    $valido = false;
    if (!empty($id_cmp) &&
        !empty($dt_atend) &&
        !empty($hr_ini) &&
        !empty($hr_fim) &&
        !empty($nm_enfermeiro)){
          $valido = true;
    }

    foreach($ids_vacinas as $id_vacina) {
      if (empty($id_vacina["valor"])) $valido = false;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->query ("START TRANSACTION");
    $wpdb->insert(
      'ATENDIMENTO',
      array(
        'cd_cmp'          => $id_cmp,
        'dt_atend'        => $dt_atend,
        'hr_ini'          => $hr_ini,
        'hr_fim'          => $hr_fim,
        'nm_enfermeiro'   => $nm_enfermeiro
      ),
      array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s'        
      )
    );
    $id_atend = $wpdb->insert_id;

    $sucesso = true;
    foreach($ids_vacinas as $id_vacina) {
      $msg = "id:" . $id_vacina["id"] . ", valor:" .  $id_vacina["valor"];
      $wpdb->insert(
        'VCL_VCNA_ATEND',
        array(
          'cd_atend'        => $id_atend,
          'cd_vcl_vcna_cmp' => $id_vacina["id"],
          'qtd_vcna_envio'  => $id_vacina["valor"]
        ),
        array(
          '%d',
          '%d',
          '%s'
        )
      );
      $id_vcl = $wpdb->insert_id;
      if ($id_vcl <= 0){
        $sucesso = false;
        break;
      }
    }

    if ($id_atend > 0 && $sucesso){
      $wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Agendamento salvo com sucesso!');</script>";
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
 
<?php require "cad_agenda_tela.php"; ?>