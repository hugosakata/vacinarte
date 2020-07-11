<?php 

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET['id'];
  $id_cmp = $_GET['id_cmp'];
  $id_ctt = $_GET['id_ctt'];
  $acao = $_GET['acao'];
}

if ($id_cli > 0) {
  $titulo = "Contatos do Cliente";
  $novo = $home.'/cadastrar-contato/?id='.$id_cli;
  $sql = $wpdb->prepare($listar_contatos_cliente , $id_cli );
} else if ($id_cmp > 0) {
  $titulo = "Contatos da Campanha"; 
  $novo = $home.'/cadastrar-contato-campanha/?id_cmp='.$id_cmp; 
  $sql = $wpdb->prepare($listar_contatos_campanha , $id_cmp );
}

if (isset($acao) && $acao == "delete"){

  if ($id_cli > 0) {
    $result = $wpdb->update(
      'CONTATO',
      array(
        'status'      => '0'     
      ),
      array( 'cd_ctt' =>  $id_ctt),
      array(
        '%d'
      ),
      array( '%d' )
    );
  } else if ($id_cmp > 0) {

    $sql = $wpdb->prepare($selecionar_contatos_campanha_status , $id_cmp, $id_ctt );

    $vlc_ctt_cmp = $wpdb->get_row($sql);
    $id_vcl = $vlc_ctt_cmp->cd_vcl_ctt_cmp;

    $result = $wpdb->update(
      'VCL_CTT_CMP',
        array(
          'ativo'      => '0'     
        ),
        array( 'cd_vcl_ctt_cmp' =>  $id_vcl),
        array(
          '%d'
        ),
        array( '%d' )
    );
  }
  
  if($result > 0){
    echo "<script language='javascript' type='text/javascript'>
    alert('Contato excluído com sucesso!');</script>";
  } else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
  }
}

?>