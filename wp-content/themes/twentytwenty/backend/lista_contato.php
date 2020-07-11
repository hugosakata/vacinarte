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
  $sql = "
        SELECT `CONTATO`.`cd_ctt`, `nm_ctt`, `tel_pri`, 
        `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
        FROM `CONTATO`, `VCL_CONTATO`
        WHERE 
        `VCL_CONTATO`.`cd_ctt`=`CONTATO`.`cd_ctt` and
        `VCL_CONTATO`.`cd_cli`={$id_cli} and status=1 order by `nm_ctt`
        ";
} else if ($id_cmp > 0) {
  $titulo = "Contatos da Campanha"; 
  $novo = $home.'/cadastrar-contato-campanha/?id_cmp='.$id_cmp; 
  $sql = "
        SELECT `CONTATO`.`cd_ctt`, `nm_ctt`, `tel_pri`, 
        `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
        FROM `CONTATO`, `VCL_CTT_CMP`
        WHERE 
        `VCL_CTT_CMP`.`cd_ctt`=`CONTATO`.`cd_ctt` and
        `VCL_CTT_CMP`.`cd_cmp`={$id_cmp} and `CONTATO`.`status`=1 and `VCL_CTT_CMP`.`ativo`=1 order by `nm_ctt`
        ";
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

    $sql = "SELECT cd_vcl_ctt_cmp, ativo FROM VCL_CTT_CMP WHERE cd_cmp = '{$id_cmp}' and cd_ctt = '{$id_ctt}'";
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