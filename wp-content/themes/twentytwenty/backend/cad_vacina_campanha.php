<?php

$id_vcna_cmp = 0;
$cd_cmp = $id_vcl_vcna = 0;
$cd_vcna = $qtd_vcna = $vlr_vcna = $vcna = $acao = "";

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $cd_cmp = $_GET['id'];
  $id_vcl_vcna = $_GET['id_vcl_vcna'];
  $acao = $_GET["acao"];

  if($id_vcl_vcna > 0){
    // $sql = "
    //   SELECT * FROM `VCL_VCNA_CMP`, `VACINA`
    //   WHERE VCL_VCNA_CMP.cd_vcna=VACINA.cd_vcna and
    //   VCL_VCNA_CMP.cd_vcl_vcna_cmp = '{$id_vcl_vcna}'";
    $sql = $wpdb->prepare($selecionar_vacinas_campanha , $id_vcl_vcna );
    $vacina = $wpdb->get_row($sql);
  }

}

function load(){
  global $cd_vcna, $qtd_vcna, $vlr_vcna, $vcna, $cd_cmp, $acao, $id_vcl_vcna;

  $acao = str_replace("'", "", trim($_POST["acao"]));
  $cd_cmp = str_replace("'", "", trim($_POST["cd_cmp"]));
  $id_vcl_vcna = str_replace("'", "", trim($_POST["id_vcl_vcna"]));
  $cd_vcna = str_replace("'", "", trim($_POST["cd_vcna"]));
  $qtd_vcna = str_replace("'", "", trim($_POST["qtd_vcna"]));
  $vlr_vcna = str_replace("'", "", trim($_POST["vlr_vcna"]));
  
}

function form_valido() {
  global $cd_vcna, $nm_vcna, $qtd_vcna, $vlr_vcna, $cd_cmp;

  $valido = false;
  if (!empty($cd_cmp) &&
      !empty($cd_vcna) &&
      !empty($qtd_vcna) &&
      !empty($vlr_vcna)){
        $valido = true;
  }
  
  return $valido;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  if (form_valido()){
    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'VCL_VCNA_CMP',
        array(
          'cd_cmp'    => $cd_cmp,
          'cd_vcna'   => $cd_vcna,
          'qtd_vcna_contratada'  => $qtd_vcna,
          'qtd_vcna_restante'  => $qtd_vcna,
          'vlr_vcna'  => $vlr_vcna
        ),
        array( 'cd_vcl_vcna_cmp' =>  $id_vcl_vcna),
        array(
          '%d',
          '%d',
          '%d',
          '%d',
          '%f'
        )
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Vacina salva com sucesso!');</script>";

        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/listar-vacinas/?id_cmp={$id_cmp}';</script>";

      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {
      $wpdb->insert(
        'VCL_VCNA_CMP',
        array(
          'cd_cmp'    => $cd_cmp,
          'cd_vcna'   => $cd_vcna,
          'qtd_vcna_contratada'  => $qtd_vcna,
          'qtd_vcna_restante'  => $qtd_vcna,
          'vlr_vcna'  => $vlr_vcna
        ),
        array(
          '%d',
          '%d',
          '%d',
          '%d',
          '%f'
        )
      );
      $id_vcna_cmp = $wpdb->insert_id;
      // $sql = "SELECT * FROM VCL_VCNA_CMP WHERE cd_vcna = '{$id_vcna_cmp}'";
      
      $sql = $wpdb->prepare($selecionar_vinculo_vacina , $id_vcna_cmp );
      $vcna = $wpdb->get_row($sql);
      if ($id_vcna_cmp > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Vacina salva com sucesso!');</script>";

        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/listar-vacinas/?id_cmp={$id_cmp}';</script>";
      } else {
        $msg_err = "Ops! Algo deu errado, confirme os dados preenchidos e tente novamente";
      }
    }
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}

?>