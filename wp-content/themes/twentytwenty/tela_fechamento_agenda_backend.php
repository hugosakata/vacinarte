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

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $cd_atend = $_GET['id'];

  $sql = "
      SELECT
      ATEND.CD_ATEND,
      ATEND.CD_CMP,
      CMP.NM_CMP,
      ATEND.DT_ATEND,
      ATEND.NM_ENFERMEIRO,
      VVC.CD_VCL_VCNA_CMP,
      VVC.CD_VCNA,
      VCNA.NM_REG,
      VVC.QTD_VCNA,
      ATEND.QTD_VCNA_ENVIO,
      ATEND.qtd_cortesia
    FROM
      ATENDIMENTO ATEND,
      CAMPANHA CMP,
      VCL_VCNA_CMP VVC,
      VACINA VCNA
    WHERE
      ATEND.CD_ATEND = {$cd_atend} AND
      CMP.CD_CMP     = ATEND.CD_CMP AND
      VVC.CD_CMP     = ATEND.CD_CMP AND
      VCNA.CD_VCNA   = VVC.CD_VCNA
    ";
                            
    $agendas = $wpdb->get_results($sql);
    $agenda = $agendas[0];
    foreach($agendas as $agenda_item) {
      array_push($ids_vacinas, array("id" => $agenda_item->cd_vcl_vcna_cmp, "qtd_retorno" => "", "qtd_cortesia" => ""));
    }
}


function load(){
  global $agenda, $atend, $cd_atend, $qtd_vcna, $qtd_retorno, $qtd_cortesia, $envio, $aplic, $fechamento;

  $cd_atend = str_replace("'", "", trim($_POST["cd_atend"]));
  $qtd_retorno = str_replace("'", "", trim($_POST["qtd_retorno"]));
  $qtd_cortesia = str_replace("'", "", trim($_POST["qtd_cortesia"]));
  
}

function form_valido() {
  global $cd_atend, $qtd_retorno, $qtd_cortesia;

  $valido = false;
  if (!empty($cd_atend) &&
      !empty($qtd_retorno) &&
      !empty($qtd_cortesia)){
        $valido = true;
  }
  
  return $valido;
}

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if (form_valido()){
      //$wpdb->query ("START TRANSACTION");
      $linhas_afetadas = $wpdb->update(
        'ATENDIMENTO',
        array(
          'qtd_vcna_retorno'	=> $qtd_retorno,
          'qtd_cortesia'      => $qtd_cortesia,
          'bl_fechamento'     => $fechamento
        ),
        array(
          'cd_atend' => $cd_atend
        ),
        array(
          '%d',
          '%d'
        )
      );

      if ($linhas_afetadas > 0){
        
        $atendimento = $wpdb->get_results("SELECT cd_cmp, qtd_vcna_envio FROM ATENDIMENTO WHERE cd_atend = '{$cd_atend}'");
        foreach( $atendimento as $at ) {
           $cmp = $at->cd_cmp;
           $envio = $at->qtd_vcna_envio;
         };
        $uso_dia = $envio - $qtd_retorno;
        // echo "<script language='javascript' type='text/javascript'>
        //   alert('CD_CMP = '+{$cmp}+' / ENVIO = '+{$envio}+' / USADAS = '+{$uso_dia});</script>";

        $aplicacoes = $wpdb->get_results("SELECT qtd_vcna, qtd_vcna_aplic FROM VCL_VCNA_CMP WHERE CD_CMP = '{$cmp}'");
        foreach( $aplicacoes as $ap ){
          $aplic = $ap->qtd_vcna_aplic;
          $qt_total = $ap->qtd_vcna;
        };
        
        $tot_aplic = $aplic + $uso_dia;

        $resultado = $wpdb->update(
          'VCL_VCNA_CMP',
          array(
            'qtd_vcna_aplic'	=> $tot_aplic
          ),
          array(
            'cd_cmp' => $cmp
          ),
          array(
            '%d'
          )
        );
        if($resultado > 0){
          $qtdes = $wpdb->get_results("SELECT qtd_vcna_aplic FROM VCL_VCNA_CMP WHERE cd_cmp = '{$cmp}'");
          foreach( $qtdes as $qt ) {
             $aplic_atual = $qt->qtd_vcna_aplic;
           };
           //$restante = $qt_total - $aplic_atual;
          //$wpdb->query("COMMIT");
          echo "<script language='javascript' type='text/javascript'>
          alert('Fechamento salvo com sucesso! Foram aplicadas {$aplic_atual} de {$qt_total}');</script>";
        }else{
          echo "<script language='javascript' type='text/javascript'>
          alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
        }
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!!');</script>";
      }
      
      //limpa formulario
      //$cd_atend = $campanha = $dt_agenda = $enfermeira = "";
      //$qtd_vcna = $qtd_retorno = $qtd_cortesia = "";

    } else {
        $msg_err = "Ops! Faltou preencher algum campo obrigatório";
    }
  }


?>

<?php require "tela_fechamento_agenda_frontend.php"; ?>