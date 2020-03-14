<?php /* Template Name: TelaListaPj */

global $wpdb;

?>


<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Clientes PJ</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- DataTable -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../DataTables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../DataTables/css/dataTables.jqueryui.min.css">
    <link href="../css/datatables.min.css" rel="stylesheet" >
    <script type="text/javascript" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../DataTables/js/dataTables.jqueryui.min.js"></script>
    <script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> -->

  </head>
  <body>
  
  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-xs-10">
          <h3 class="page-header">Clientes PJ
          <!-- <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small> -->
          </h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-pj/';" 
          value="Novo" style="margin-top:35px"/>
        </div>
    </div><!-- fecha div row -->

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <div class="row"><!--div row painel de consulta -->
          <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active">
            <div class="col-lg-12 col-xs-12">
              <div class="row paineldeconsulta">
                <div class="col-lg-12 col-xs-12"><!-- posiciona painel -->
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table table-striped" id="tab_cli_pf">
                        <thead>
                          <tr>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          $clientes = $wpdb->get_results( 
                            "
                            SELECT cd_cli, nm_rz_soc, nm_fant, cpf_cnpj 
                            FROM CLIENTES
                            WHERE cd_tp_cli=2 order by nm_rz_soc, nm_fant
                            "
                          );
                          
                          foreach ( $clientes as $cliente ) 
                          {
                        ?>

                          <tr>
                            <td><?php echo $cliente->nm_rz_soc ?></td>
                            <td><?php echo $cliente->nm_fant ?></td>
                            <td><?php echo $cliente->cpf_cnpj ?></td>
                            <td>
                              <a><i class="material-icons" style="padding-left: 5px; color: CornflowerBlue; cursor: pointer;">description</i></a>
                              <a href='http://vacinarte-admin.com.br/cadastrar-pj/?id=<?php echo $cliente->cd_cli; ?>' ><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">edit</i></a>
                              <a><i class="material-icons" style="padding-left: 5px; color: tomato; cursor: pointer;">delete</i></a>
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
          </div><!-- fecha div painel pdequipe -->
        </div>
        </div>
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->
    
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

    <!-- <script>
      //datatable
	$(document).ready(function() {
    $('#tab_cli_pf').DataTable({
	       
	        "lengthMenu": [
	            [20, 30, 50, -1],
	            [20, 30, 50, "Todos"]
	        ],
	        "ordering": true,
	        "paginate": true,
	        "pagingType": "full_numbers",
	        "searching": true,
	        "paging": true,
	        "info": false,
	        "autoWidth": false,
	        "bStateSave": false,
          "bLengthChange": true,
          "aoColumns": [
	            null,
	            null,
	            null,
	            null
	        ],
	        
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
      
	});

    </script> -->

  </body>
  </html>
