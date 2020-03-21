<?php /* Template Name: TelaListaAgenda */

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
    #tab_lista_agenda_paginate{
      font-size: 15px;
      margin-top: -2vw;
    }
    #tab_lista_agenda_info{
      font-size: 15px;
    }
    .dataTables_empty{
      text-align: center;
      font-weight: bold;
    }
    #tab_lista_agenda_filter{
      width: 30%;
      margin-top: -3vw;
    }
    #tab_lista_agenda_length{
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
          <h3 class="page-header">Agenda</h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="btn_cad pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/listar-campanhas/';" 
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
                      <table class="table table-striped" id="tab_lista_agenda">
                        <thead>
                          <tr>
                            <th class="fontTH">Nome Campanha</th>
                            <th class="fontTH">Nome Cliente</th>
                            <th class="fontTH">Endereço</th>
                            <th class="fontTH">Enfermeiro(a)</th>
                            <th class="fontTH">Data</th>
                            <th class="fontTH">Hora Início</th>
                            <th class="fontTH">Hora Fim</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                          $agendas = $wpdb->get_results( 
                            "
                            SELECT 
                            `cd_atend`, 
                            `nm_cmp`, 
                            `nm_fant`,
                            `ENDERECO`.`logradouro`,
                            `ENDERECO`.`nm_end`,
                            `ENDERECO`.`num_end`,
                            `ENDERECO`.`complemento`,
                            `ENDERECO`.`bairro`,
                            `ENDERECO`.`cep`,
                            `ENDERECO`.`cidade`,
                            `ENDERECO`.`estado`,
                            `dt_atend`, 
                            `hr_ini`, 
                            `hr_fim`, 
                            `nm_enfermeiro` 
                            FROM `ATENDIMENTO`, `CAMPANHA`, `CLIENTES`, `VCL_ENDERECO`, `ENDERECO`
                            WHERE
                            `ATENDIMENTO`.`cd_cmp`=`CAMPANHA`.`cd_cmp` AND
                            `CAMPANHA`.`cd_cli`=`CLIENTES`.`cd_cli` AND
                            `CAMPANHA`.`cd_vcl_end`=`VCL_ENDERECO`.`cd_vcl_end` AND
                            `VCL_ENDERECO`.`cd_end`=`ENDERECO`.`cd_end`
                            ORDER BY `cd_atend` DESC

                            "
                          );
                          
                          foreach ( $agendas as $agenda ) 
                          {
                        ?>
                          <tr>
                            <td class="fontTD"><?php echo $agenda->nm_cmp ?></td>
                            <td class="fontTD"><?php echo $agenda->nm_fant ?></td>
                            <td class="fontTD"><?php echo $agenda->nm_end . ": " . $agenda->logradouro . ", " . $agenda->num_end . " - " . $agenda->bairro; ?></td>
                            <td class="fontTD"><?php echo $agenda->nm_enfermeiro ?></td>
                            <td class="fontTD"><?php echo $agenda->dt_atend ?></td>
                            <td class="fontTD"><?php echo $agenda->hr_ini ?></td>
                            <td class="fontTD"><?php echo $agenda->hr_fim ?></td>
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
    $('#tab_lista_agenda').DataTable({
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
    $('#tab_lista_agenda_filter').addClass('pull-right');
    $('#tab_lista_agenda_paginate').addClass('pull-right');
  });

    </script>
  </body>
  </html>
