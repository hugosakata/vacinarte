<?php

$nm_contato = $tel_pri = $email = $obs_ctt = $id_cli = $id_cmp = $id_ctt = "";
$id_ctt = $id_vcl = 0;

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET['id'];
  $id_cmp = $_GET['id_cmp'];
  $id_ctt = $_GET['id_ctt'];
  $acao = $_GET['acao'];

  $sql = $wpdb->prepare($selecionar_contato , $id_ctt );
  $contato = $wpdb->get_row($sql);
}

 function load(){
    global $nm_contato, $tel_pri, $email, $obs_ctt, $acao, $id_ctt, $id_cli, $id_cmp;

    $acao = str_replace("'", "", trim($_POST["acao"]));
    $id_ctt = str_replace("'", "", trim($_POST["id_ctt"]));
    $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
    $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));

    $nm_contato = str_replace("'", "", trim($_POST["nm_contato"]));
    $tel_pri = str_replace("'", "", trim($_POST["tel_pri"]));
    $email = str_replace("'", "", trim($_POST["email"]));
    $obs_ctt = str_replace("'", "", trim($_POST["obs_ctt"]));
 }

 function form_valido() {
    global $nm_contato, $tel_pri;

    $valido = false;
    if (!empty($nm_contato) && 
        !empty($tel_pri)){
          $valido = true;
    }

    return $valido;
 }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'CONTATO',
        array(
          //'cd_cli'  => $id_cli,
          'nm_ctt'  => $nm_contato,
          'tel_pri' => $tel_pri,
          'email'   => $email,
          'obs_ctt' => $obs_ctt
        ),
        array( 'cd_ctt' =>  $id_ctt),
        array(
          //'%d',
          '%s',
          '%s',
          '%s',
          '%s'
        ),
        array( '%d' )
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Contato salvo com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {

      $wpdb->query ("START TRANSACTION");
      $wpdb->insert(
        'CONTATO',
        array(
          //'cd_cli'  => $id_cli,
          'nm_ctt'  => $nm_contato,
          'tel_pri' => $tel_pri,
          'email'   => $email,
          'obs_ctt' => $obs_ctt
        ),
        array(
          //'%d',
          '%s',
          '%s',
          '%s',
          '%s'
        )
      );
      $id_ctt = $wpdb->insert_id;

      if ($id_cli > 0){
        $wpdb->insert(
          'VCL_CONTATO',
          array(
            'cd_cli'      => $id_cli,
            'cd_ctt'      => $id_ctt        
          ),
          array(
            '%s',
            '%s'
          )
        );
        $id_vcl = $wpdb->insert_id;
      } else if ($id_cmp>0) {
        $wpdb->insert(
          'VCL_CTT_CMP',
          array(
            'cd_cmp'      => $id_cmp,
            'cd_ctt'      => $id_ctt        
          ),
          array(
            '%s',
            '%s'
          )
        );
        $id_vcl = $wpdb->insert_id;
      }

      if ($id_ctt > 0 && $id_vcl > 0){
        $wpdb->query("COMMIT");

        echo "<script language='javascript' type='text/javascript'>
        alert('Contato salvo com sucesso!');</script>";

        //limpa relatorio
        $nm_contato = $tel_pri = $email = $obs_ctt = "";

        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/listar-contatos/?id={$id_cli}';</script>";

      } else {
        $wpdb->query("ROLLBACK");

        $msg_err = "Ops! Algo deu errado, confirme os dados preenchidos e tente novamente";
      }
    }
   
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}
?>