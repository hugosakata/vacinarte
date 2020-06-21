<?php /* Template Name: TelaFechamentoAgenda */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url(); 
?>

<?php

$aplic = $envio = $agenda = $atend = $cd_atend = $campanha = $dt_agenda = "";
$enfermeira = $vacina = $qtd_vcna = $qtd_retorno = $qtd_cortesia = $sql = "";
$fechamento = 1;
$ids_vacinas = array();

if(isset($_GET['id'])){
  $cd_atend = $_GET['id'];

  $sql = "
      SELECT
      ATEND.CD_ATEND,
      ATEND.CD_CMP,
      CMP.NM_CMP,
      ATEND.DT_ATEND,
      ATEND.NM_ENFERMEIRO,
      
      VCNA.NM_REG,
      
      VVA.CD_VCL_VCNA_ATEND,
      VVA.QTD_VCNA_RETORNO,
      VVA.QTD_VCNA_ENVIO,
      VVA.qtd_cortesia
    FROM
      ATENDIMENTO ATEND,
      VCL_VCNA_ATEND VVA,
      VCL_VCNA_CMP VVC,
      CAMPANHA CMP,
      VACINA VCNA
    WHERE
      ATEND.CD_ATEND = {$cd_atend} AND
      ATEND.CD_ATEND = VVA.CD_ATEND AND
      CMP.CD_CMP     = ATEND.CD_CMP AND
      VVA.cd_vcl_vcna_cmp    = VVC.cd_vcl_vcna_cmp AND
      VCNA.cd_vcna = VVC.cd_vcna
    ";
                            
    $agendas = $wpdb->get_results($sql);
    $agenda = $agendas[0];
    foreach($agendas as $agenda_item) {
      array_push($ids_vacinas, array("id" => $agenda_item->CD_VCL_VCNA_ATEND, "qtd_vcna_retorno" => "", "qtd_cortesia" => ""));
    }
}


function load(){
  global $agenda, $atend, $cd_atend, $qtd_vcna, $qtd_retorno, $qtd_cortesia, $envio, $aplic, $fechamento, $ids_vacinas;

  $cd_atend = str_replace("'", "", trim($_POST["cd_atend"]));
  // $qtd_retorno = str_replace("'", "", trim($_POST["qtd_retorno"]));
  // $qtd_cortesia = str_replace("'", "", trim($_POST["qtd_cortesia"]));

  foreach($ids_vacinas as $key => $id_vacina) {
    $id = $id_vacina["id"] . "_qtd_vcna_retorno";
    $valor = str_replace("'", "", trim($_POST[$id]));
    $ids_vacinas[$key]["qtd_vcna_retorno"] = $valor;

    $id = $id_vacina["id"] . "_qtd_cortesia";
    $valor = str_replace("'", "", trim($_POST[$id]));
    $ids_vacinas[$key]["qtd_cortesia"] = $valor;

  }
  // foreach($ids_vacinas as $id_vacina) {
  //   echo "<script language='javascript' type='text/javascript'>
  //   alert('recebi id:" . $id_vacina["id"] . 
  //   ", qtd_retorno:" . $id_vacina["qtd_vcna_retorno"] . 
  //   ", qtd_cortesia:" . $id_vacina["qtd_cortesia"] .  "');</script>";
  // }
  
}

function form_valido() {
  global $cd_atend, $qtd_retorno, $qtd_cortesia, $ids_vacinas;

  $valido = false;
  if (!empty($cd_atend)){
        $valido = true;
  }
  
  foreach($ids_vacinas as $id_vacina) {
    if (empty($id_vacina["qtd_vcna_retorno"])) $valido = false;
    if (empty($id_vacina["qtd_cortesia"])) $valido = false;
  }

  return $valido;
}

load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
  if (form_valido()){
    $wpdb->query ("START TRANSACTION");
    $linhas_afetadas = $wpdb->update(
        'ATENDIMENTO',
        array(
        'bl_fechamento'     => $fechamento
        ),
        array(
        'cd_atend' => $cd_atend
        ),
        array(
        '%d'
        )
    );

    if ($linhas_afetadas > 0){

      foreach($ids_vacinas as $id_vacina) {
        $msg = "id:" . $id_vacina["id"] . ", qtd_vcna_retorno:" .  $id_vacina["qtd_vcna_retorno"] . ", qtd_cortesia:" .  $id_vacina["qtd_cortesia"];

        $resultado = $wpdb->update(
            'VCL_VCNA_ATEND',
            array(
            'qtd_vcna_retorno'	=> $id_vacina["qtd_vcna_retorno"],
            'qtd_cortesia'	    => $id_vacina["qtd_cortesia"]
            ),
            array(
            'cd_vcl_vcna_atend' => $id_vacina["id"]
            ),
            array(
            '%d',
            '%d'
            ),
            array( '%d' )
        );
        if ($resultado <= 0){
          break; 
        }
      }
    }

    if($linhas_afetadas > 0 && $resultado > 0){
      $wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Agenda fechada com sucesso!');</script>";
    } else {
      $wpdb->query("ROLLBACK");

      echo "<script language='javascript' type='text/javascript'>
      alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
    }
  } else {
    $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}

        // $atendimento = $wpdb->get_results("SELECT cd_cmp, qtd_vcna_envio FROM ATENDIMENTO WHERE cd_atend = '{$cd_atend}'");
        // foreach( $atendimento as $at ) {
        //    $cmp = $at->cd_cmp;
        //    $envio = $at->qtd_vcna_envio;
        //  };
        // $uso_dia = $envio - $qtd_retorno;
        // echo "<script language='javascript' type='text/javascript'>
        //   alert('CD_CMP = '+{$cmp}+' / ENVIO = '+{$envio}+' / USADAS = '+{$uso_dia});</script>";

        // $aplicacoes = $wpdb->get_results("SELECT qtd_vcna, qtd_vcna_aplic FROM VCL_VCNA_CMP WHERE CD_CMP = '{$cmp}'");
        // foreach( $aplicacoes as $ap ){
        //   $aplic = $ap->qtd_vcna_aplic;
        //   $qt_total = $ap->qtd_vcna;
        // };
        
        // $tot_aplic = $aplic + $uso_dia;

        // $resultado = $wpdb->update(
        //   'VCL_VCNA_ATEND',
        //   array(
        //     'qtd_vcna_retorno'	=> $qtd_vcna_retorno,
        //     'qtd_cortesia'	=> $qtd_cortesia,
        //   ),
        //   array(
        //     'cd_cmp' => $cmp
        //   ),
        //   array(
        //     '%d'
        //   )
        // );
        // if($resultado > 0){
        //   $qtdes = $wpdb->get_results("SELECT qtd_vcna_aplic FROM VCL_VCNA_CMP WHERE cd_cmp = '{$cmp}'");
        //   foreach( $qtdes as $qt ) {
        //      $aplic_atual = $qt->qtd_vcna_aplic;
        //    };
        //    //$restante = $qt_total - $aplic_atual;
        //   //$wpdb->query("COMMIT");
        //   echo "<script language='javascript' type='text/javascript'>
        //   alert('Fechamento salvo com sucesso! Foram aplicadas {$aplic_atual} de {$qt_total}');</script>";
        // }else{
        //   echo "<script language='javascript' type='text/javascript'>
        //   alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
        // }
  //     } else {
  //       echo "<script language='javascript' type='text/javascript'>
  //       alert('Ops! Algo deu errado, tente novamente mais tarde!!');</script>";
  //     }
      
  //     //limpa formulario
  //     //$cd_atend = $campanha = $dt_agenda = $enfermeira = "";
  //     //$qtd_vcna = $qtd_retorno = $qtd_cortesia = "";

  //   } else {
  //       $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  //   }
  // }


?>

<?php require "tela_fechamento_agenda_frontend.php"; ?>