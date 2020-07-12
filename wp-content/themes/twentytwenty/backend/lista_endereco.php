<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET['id'];
  $id_cmp = $_GET['id_cmp'];
  $id_end = $_GET['id_end'];
  $acao = $_GET['acao'];
}

if ($id_cli > 0) {
  $titulo = "Endereços do Cliente";
  $novo = $home.'/cadastrar-endereco/?id='.$id_cli;
  // $sql = "
  //       SELECT 
  //       `ENDERECO`.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `ativo` 
  //       FROM `ENDERECO`,
  //       `VCL_ENDERECO`
  //       WHERE 
  //       `ENDERECO`.cd_end=`VCL_ENDERECO`.cd_end and 
  //       `VCL_ENDERECO`.cd_cli={$id_cli} and ativo=1 order by `nm_end`, `logradouro`
  //       ";
  $sql = $wpdb->prepare($selecionar_enderecos_cliente , $id_cli );
} else if ($id_cmp > 0) {
  $titulo = "Endereços da Campanha"; 
  $novo = $home.'/cadastrar-endereco-campanha/?id_cmp='.$id_cmp; 
  // $sql = "
  //       SELECT 
  //       `ENDERECO`.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `VCL_END_CMP`.`ativo` 
  //       FROM `ENDERECO`,
  //       `VCL_END_CMP`
  //       WHERE 
  //       `ENDERECO`.cd_end=`VCL_END_CMP`.cd_end and 
  //       `VCL_END_CMP`.cd_cmp={$id_cmp} and 
  //       `VCL_END_CMP`.ativo=1 and 
  //       `ENDERECO`.ativo=1 and `VCL_END_CMP`.ativo=1 order by `nm_end`, `logradouro`
  //       ";
  
  $sql = $wpdb->prepare($selecionar_enderecos_campanha , $id_cmp );
}

if (isset($acao) && $acao == "delete"){
  if ($id_cli > 0) {
    $result = $wpdb->update(
      'ENDERECO',
      array(
        'ativo'      => '0'     
      ),
      array( 'cd_end' =>  $id_end),
      array(
        '%d'
      ),
      array( '%d' )
    );
  } else if ($id_cmp > 0) {

    // $sql = "
    //   SELECT cd_vcl_end_cmp, ativo FROM VCL_END_CMP WHERE cd_cmp = '{$id_cmp}' and cd_end = '{$id_end}'";
    $sql = $wpdb->prepare($selecionar_enderecos_campanha_status , $id_cmp, $id_end );
    $vlc_end_cmp = $wpdb->get_row($sql);
    $id_vcl = $vlc_end_cmp->cd_vcl_end_cmp;

    $result = $wpdb->update(
      'VCL_END_CMP',
        array(
          'ativo'      => '0'     
        ),
        array( 'cd_vcl_end_cmp' =>  $id_vcl),
        array(
          '%d'
        ),
        array( '%d' )
    );
  }

  if($result > 0){
    echo "<script language='javascript' type='text/javascript'>
    alert('Endereço excluído com sucesso!');</script>";

    if ($id_cli > 0){
      echo "<script language='javascript' type='text/javascript'>
      window.location.href='{$home}/listar-enderecos/?id={$id_cli}';</script>";
    } else if ($id_cmp>0) {
      echo "<script language='javascript' type='text/javascript'>
      window.location.href='{$home}/listar-enderecos/?id_cmp={$id_cmp}';</script>";
    }

  } else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
  }
}
?>