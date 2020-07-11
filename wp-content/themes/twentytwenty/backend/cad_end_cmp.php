<?php 
load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cmp = $_GET['id_cmp'];

  //$sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_cmp}'";
  $sql = $wpdb->prepare($selecionar_campanha , $id_cmp );
  $campanha = $wpdb->get_row($sql);
  $id_cli = $campanha->cd_cli;

  // $sql = "SELECT GROUP_CONCAT(DISTINCT cd_end
  // ORDER BY cd_end
  // SEPARATOR ',') as cd_ends FROM `VCL_END_CMP` where cd_cmp='{$id_cmp}' and `VCL_END_CMP`.ativo=1";
  $sql = $wpdb->prepare($selecionar_endereco_campanha_group , $id_cmp );
  $campanha_ends = $wpdb->get_row($sql);
  $selecionados = $campanha_ends->cd_ends;
}

function load(){
  global $selecionados, $id_cli, $id_cmp;

  $selecionados = str_replace("'", "", trim($_POST["selecionados"]));
  $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
  $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));
}

function form_valido() {
  global $selecionados, $id_cmp, $id_cli;

  //echo "<script language='javascript' type='text/javascript'>
  //alert('{$selecionados} , {$id_cmp} , {$id_cli}');</script>";

  $valido = false;
  if (!empty($selecionados) &&
      !empty($id_cmp) &&
      !empty($id_cli)){
        $valido = true;
  }

  return $valido;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    $arr_selecionados = explode(",", $selecionados);    

    $sucesso = true;
    $wpdb->query ("START TRANSACTION");
    foreach ( $arr_selecionados as $arr_selecionado ) 
    {
      if ($arr_selecionado > 0) {

        //$sql = "SELECT cd_vcl_end_cmp, ativo FROM VCL_END_CMP WHERE cd_cmp = '{$id_cmp}' and cd_end = '{$arr_selecionado}'";
        $sql = $wpdb->prepare($selecionar_enderecos_campanha_status , $id_cmp, $arr_selecionado );
        $vlc_end_cmp = $wpdb->get_row($sql);
        $id_vcl = $vlc_end_cmp->cd_vcl_end_cmp;
        $ativo = $vlc_end_cmp->ativo;

        // echo "<script language='javascript' type='text/javascript'>
        // alert('{$id_cmp}, {$arr_selecionado}, {$id_vcl}, ativo={$ativo}');</script>";

        if ($id_vcl > 0){
          if ($ativo <= 0){
            $linhas_afetadas = $wpdb->update(
              'VCL_END_CMP',
                array(
                  'ativo'      => '1'     
                ),
                array( 'cd_vcl_end_cmp' =>  $id_vcl),
                array(
                  '%d'
                ),
                array( '%d' )
            );
            $id_vcl = ($linhas_afetadas > 0);
          } else {
            $id_vcl = true;
          }
        } else {
          $vinculo = $wpdb->insert(
            'VCL_END_CMP',
            array(
              'cd_cmp' => $id_cmp,
              'cd_end' => $arr_selecionado
            ),
            array(
              '%d',
              '%d'
            )
          );
          $id_vcl = $wpdb->insert_id;
        }

        if ($id_vcl == false){
          $sucesso = false;
          break;
        }
      }
    }

    if($sucesso == true){
      $wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Endereço salvo com sucesso!');</script>";

      echo "<script language='javascript' type='text/javascript'>
      window.location.href='{$home}/listar-campanhas/';</script>";

    }else{
     $wpdb->query("ROLLBACK");

      echo "<script language='javascript' type='text/javascript'>
          alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
    }  
  } else {
    $msg_err = "Ops! Faltou selecionar algum endereço";
  }
}
?>