<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cmp = $_GET['id_cmp'];
  $id_vcl_vcna = $_GET['id_vcl_vcna'];
  $acao = $_GET['acao'];
}

$titulo = "Vacinas da Campanha"; 
$novo = $home.'/cadastrar-vacina-campanha/?id='.$id_cmp; 
// $sql = "
//       SELECT `VCL_VCNA_CMP`.cd_vcl_vcna_cmp, `VACINA`.`cd_vcna`, `nm_reg`, `nm_gen`, `FBCNTE_VCNA`.`nm_fbcnte_vcna`,
//       `obs_vcna`, `VCL_VCNA_CMP`.qtd_vcna_contratada, `VCL_VCNA_CMP`.vlr_vcna, `VCL_VCNA_CMP`.qtd_vcna_restante
//       FROM `VACINA`, `VCL_VCNA_CMP`, `FBCNTE_VCNA`
//       WHERE 
//       `VCL_VCNA_CMP`.`cd_vcna`=`VACINA`.`cd_vcna` and
//       `VCL_VCNA_CMP`.`cd_cmp`={$id_cmp} and `VCL_VCNA_CMP`.`ativo`=1 and `VACINA`.`ativo`=1 and
//       `FBCNTE_VCNA`.`cd_fbcnte_vcna`=`VACINA`.`cd_fbcnte_vcna` order by `nm_reg`
//       ";
$sql = $wpdb->prepare($listar_vacinas_campanha , $id_cmp );

if (isset($acao) && $acao == "delete"){

  $result = $wpdb->update(
    'VCL_VCNA_CMP',
    array(
      'ativo'      => '0'     
    ),
    array( 'cd_vcl_vcna_cmp' =>  $id_vcl_vcna),
    array(
      '%d'
    ),
    array( '%d' )
  );
  
  if($result > 0){
    echo "<script language='javascript' type='text/javascript'>
    alert('Vacina excluída com sucesso!');</script>";

    echo "<script language='javascript' type='text/javascript'>
    window.location.href='{$home}/listar-vacinas/?id_cmp={$id_cmp}';</script>";
  } else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
  }
}

?>