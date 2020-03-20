<?php /* Template Name: TelaListaCampanha */

global $wpdb;
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Campanhas Ativas</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel='stylesheet' id='dashicons-css'  href='http://vacinarte-admin.com.br/wp-includes/css/dashicons.min.css?ver=5.3.2' media='all' />
<link rel='stylesheet' id='admin-bar-css'  href='http://vacinarte-admin.com.br/wp-includes/css/admin-bar.min.css?ver=5.3.2' media='all' />
<link rel='stylesheet' id='wp-block-library-css'  href='http://vacinarte-admin.com.br/wp-includes/css/dist/block-library/style.min.css?ver=5.3.2' media='all' />
<link rel='stylesheet' id='twentytwenty-style-css'  href='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/style.css?ver=1.1' media='all' />


    <script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/jquery.js?ver=1.12.4-wp'></script>
<script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4'></script>


  </head>
  <style>
  .corpo{
		background-color: WhiteSmoke;
	}
  #tab_lista_campanha_paginate{
    font-size: 15px;
    margin-top: -2vw;
  }
  #tab_lista_campanha_info{
    font-size: 15px;
  }
  .dataTables_empty{
    text-align: center;
    font-weight: bold;
  }
  #tab_lista_campanha_filter{
    width: 30%;
    margin-top: -3vw;
  }
  #tab_lista_campanha_length{
    width: 30%;
  }
  input{
    height: 1vw;
  } 
  .btn_cad{
    margin-top: 2.6vw;
    height: 4.5vw;
  }
  .fontTH{
    font-size: 14px;
  }
  .fontTD{
    font-size: 12px;
  }
  </style>
  <body class="corpo">
  
  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
  
<div class="container" style="width: 100%;"><!-- container principal-->
    
    <div class="row">
        <div class="col-xs-10">
          <h3 class="page-header">Campanhas</h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="btn_cad pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/campanha/';" 
          value="Novo" style="margin-top:35px"/>
        </div>
    </div><!-- fecha div row -->

    <div class="row txtbox"><!-- row  -->
      <div class="col-lg-12 col-xs-12">
        <div class="row"><!--div row de consulta -->
          <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active">
            <div class="col-lg-12 col-xs-12">
              <div class="row paineldeconsulta">
                <div class="col-lg-12 col-xs-12"><!-- posiciona  -->
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table table-striped" id="tab_lista_campanha">
                        <thead>
                          <tr>
                            <th class="fontTH">Nome Campanha</th>
                            <th class="fontTH">Cliente</th>
                            <th class="fontTH">Tipo Serviço</th>
                            <th class="fontTH">Data Início</th>
                            <th class="fontTH">Data Fim</th>
                            <th class="fontTH">Endereço</th>
                            <th class="fontTH">Contato</th>
                            <th class="fontTH">Vacina</th>
                            <th class="fontTH">Qtde</th>
                            <th class="fontTH">Valor Unit</th>
                            <th class="fontTH">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                          $campanhas = $wpdb->get_results( 
                            "
                            SELECT
                              CMP.CD_CMP,
                              CMP.NM_CMP,
                              CMP.CD_CLI,
                              CLI.NM_FANT,
                              CMP.CD_TP_SRV,
                              SRV.NM_TP_SRV,
                              CMP.DT_INI,
                              CMP.DT_FIM,
                              END.CD_END,
                              CONCAT(END.LOGRADOURO, ', ', END.NUM_END, ', ', END.COMPLEMENTO, ', ', END.BAIRRO, ' - ', END.CIDADE) LOCAL,
                              VC.CD_CTT,
                              CONCAT(CON.NM_CTT, ': ', CON.TEL_PRI, ' / ', CON.EMAIL) CTTO,
                              VVC.CD_VCL_VCNA_CMP,
                              VVC.CD_VCNA,
                              CONCAT(VCNA.NM_REG, ' - ', FAB.NM_FBCNTE_VCNA) VAC,
                              VVC.QTD_VCNA,
                              VVC.VLR_VCNA
                            FROM
                              CAMPANHA CMP
                              LEFT JOIN TP_SRV SRV ON CMP.CD_TP_SRV = SRV.CD_TP_SRV
                              LEFT JOIN CLIENTES CLI ON CMP.CD_CLI = CLI.CD_CLI
                              LEFT JOIN VCL_ENDERECO VE ON CMP.CD_VCL_END = VE.CD_VCL_END
                              LEFT JOIN ENDERECO END ON VE.CD_END = END.CD_END AND CMP.CD_CLI = VE.CD_CLI
                              LEFT JOIN VCL_CONTATO VC ON CMP.CD_CLI = VC.CD_CLI
                              LEFT JOIN CONTATO CON ON VC.CD_CTT = CON.CD_CTT
                              LEFT JOIN VCL_VCNA_CMP VVC ON CMP.CD_CMP = VVC.CD_CMP
                              LEFT JOIN VACINA VCNA ON VVC.CD_VCNA = VCNA.CD_VCNA
                              LEFT JOIN FBCNTE_VCNA FAB ON VCNA.CD_FBCNTE_VCNA = FAB.CD_FBCNTE_VCNA
                            WHERE
                              CMP.DT_FIM >= now()
                            ORDER BY
                              CMP.DT_INI ASC

                            "
                          );
                          
                          foreach ( $campanhas as $campanha ) 
                          {
                        ?>
                          <tr>
                            <td class="fontTD"><?php echo $campanha->NM_CMP ?></td>
                            <td class="fontTD"><?php echo $campanha->NM_FANT ?></td>
                            <td class="fontTD"><?php echo $campanha->NM_TP_SRV ?></td>
                            <td class="fontTD"><?php echo $campanha->DT_INI ?></td>
                            <td class="fontTD"><?php echo $campanha->DT_FIM ?></td>
                            <td class="fontTD"><?php echo $campanha->LOCAL ?></td>
                            <td class="fontTD"><?php echo $campanha->CTTO ?></td>
                            <td class="fontTD"><?php echo $campanha->VAC ?></td>
                            <td class="fontTD"><?php echo $campanha->QTD_VCNA ?></td>
                            <td class="fontTD"><?php echo $campanha->VLR_VCNA ?></td>
                            <td class="fontTD">
                              <a title='Agendar' href='http://vacinarte-admin.com.br/cadastrar-agendamento/?id=<?php echo $campanha->CD_CMP; ?>' ><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">access_alarm</i></a>
                              <a title='Vacinas' href='http://vacinarte-admin.com.br/campanha/?id=<?php echo $campanha->CD_CMP; ?>' ><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">colorize</i></a>
                              
                            </td>
                          </tr>
                          <?php
                            }
                          ?>
        
                        </tbody>
                      </table>
                    </div><!-- fecha panel corpo -->
                  </div><!-- fecha panel default -->
                </div><!-- fecha col lg 12 -->
              </div><!-- fecha row paineldemequipe -->
          </div><!-- fecha col lg 12 -->
          </div><!-- fecha div painel  -->
        </div>
        </div>
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.dataTables.min.js"></script>
    
    <script>
      //datatable
	$(document).ready(function(){
    $('#tab_lista_campanha').DataTable({
      "ordering": true,
	    "paginate": true,
      "dateFormat": "dd/mm/yyyy",
      "oLanguage": {
	            "sProcessing": "Processando...",
	            "sLengthMenu": "Exibir _MENU_ registros",
	            "sZeroRecords": "N&atilde;o foram encontrados resultados.",
	            "sInfo": "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
	            "sInfoEmpty": "Mostrando de 0 at&eacute; 0 de um total de 0 registros",
	            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
	            "sInfoPostFix": "",
	            "sSearch": "Procurar:",
	            "sUrl": "",
	            "oPaginate": {
	                "sFirst": "Primeiro",
	                "sPrevious": "Anterior",
	                "sNext": "Pr&oacute;ximo",
	                "sLast": "&Uacute;ltimo"
	            }
	        }
    });
    $('#tab_lista_campanha_filter').addClass('pull-right');
    $('#tab_lista_campanha_paginate').addClass('pull-right');
  });

    </script>
  </body>
  </html>
