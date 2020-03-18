<?php /* Template Name: TelaListaContato */

global $wpdb;
if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Contatos do Cliente</title>
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
  <style>
  #tab_lista_contatos_info, #tab_lista_contatos_paginate{
    font-size: 15px;
  }
  input{
    height: 1vw;
  }
  #tab_lista_contatos_length{
    width: 30%;
    margin-left: 1vw;
  }
  #tab_lista_contatos_filter{
    width: 30%;
    margin-right: 0.5vw;
  }
  #tab_lista_contatos_filter.label#text{
    text-align: left;
  }
  .btn_salvar{
    margin-top: 2.6vw;
    height: 4.5vw;
  }
  </style>
  <body>
  
  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-xs-10">
          <h3 class="page-header">Contatos do cliente
          <!-- <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small> -->
          </h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="btn_salvar pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-contato/?id=<?php echo $id_cli; ?>';" 
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
                      <table class="table table-striped" id="tab_lista_contatos">
                        <thead>
                          <tr>
                            <th>Nome do contato </th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Observação</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $contatos = $wpdb->get_results( 
                            "
                            SELECT `cd_ctt`, `cd_cli`, `nm_ctt`, `tel_pri`, 
                            `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
                            FROM `CONTATO`
                            WHERE cd_cli={$id_cli} order by `nm_ctt`
                            "
                          );
                          
                          if (count($contatos)<=0){
                            echo "<script language='javascript' type='text/javascript'>
                            window.location.href='http://vacinarte-admin.com.br/cadastrar-contato/?id={$id_cli}';</script>";
                          }

                          foreach ( $contatos as $contato ) 
                          {
                        ?>
                          <tr>
                            <td><?php echo $contato->nm_ctt ?></td>
                            <td><?php echo $contato->tel_pri ?></td>
                            <td><?php echo $contato->email ?></td>
                            <td><?php echo $contato->obs_ctt ?></td>
                            <!-- <td>
                              <a><i class="material-icons" style="padding-left: 5px; color: CornflowerBlue; cursor: pointer;">description</i></a>
                              <a><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">edit</i></a>
                              <a><i class="material-icons" style="padding-left: 5px; color: tomato; cursor: pointer;">delete</i></a>
                            </td> -->
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
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.dataTables.min.js"></script>
    
    <script>
      //datatable
	$(document).ready(function(){
    $('#tab_lista_contatos').DataTable({
      "ordering": true,
	    "paginate": true,
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
    $('#tab_lista_contatos_filter').addClass('pull-right');
    $('#tab_lista_contatos_paginate').addClass('pull-right');
  });

    </script>

  </body>
  </html>
