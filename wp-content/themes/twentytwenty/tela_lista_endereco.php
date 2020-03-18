<?php /* Template Name: TelaListaEndereco */

global $wpdb;
if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >

   
    <title>Endereços do Cliente</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>
  <style>
  #tab_lista_end_paginate{
    font-size: 15px;
    margin-top: -2vw;
  }
  #tab_lista_end_info{
    font-size: 15px;
  }
  .dataTables_empty{
    text-align: center;
    font-weight: bold;
  }
  #tab_lista_end_filter{
    width: 30%;
    margin-top: -3vw;
  }
  #tab_lista_end_length{
    width: 30%;
  }
  input{
    height: 1vw;
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
          <h3 class="page-header">Endereços do Cliente
          <!-- <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small> -->
          </h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="btn_salvar pull-right" type="button" 
          onclick="location.href='http://vacinarte-admin.com.br/cadastrar-endereco/?id=<?php echo $id_cli; ?>';" 
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
                      <table class="table table-striped" id="tab_lista_end">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Logradouro</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Ativo</th>
                            <!-- <th>Ações</th> -->
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          $enderecos = $wpdb->get_results( 
                            "
                            SELECT 
                            ENDERECO.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `ativo` 
                            FROM `ENDERECO` as ENDERECO, 
                            `VCL_ENDERECO` as VCL_ENDERECO 
                            WHERE 
                            ENDERECO.cd_end=VCL_ENDERECO.cd_end and 
                            VCL_ENDERECO.cd_cli={$id_cli} order by `nm_end`, `logradouro`
                            "
                          );
                          
                          if (count($enderecos)<=0){
                            echo "<script language='javascript' type='text/javascript'>
                            window.location.href='http://vacinarte-admin.com.br/cadastrar-endereco/?id={$id_cli};';</script>";
                          }


                          foreach ( $enderecos as $endereco ) 
                          {
                        ?>
                          <tr>
                            <td><?php echo $endereco->nm_end ?></td>
                            <td><?php echo $endereco->logradouro ?></td>
                            <td><?php echo $endereco->num_end ?></td>
                            <td><?php echo $endereco->bairro ?></td>
                            <td><?php echo $endereco->cep ?></td>
                            <td><?php echo $endereco->cidade ?></td>
                            <td><?php echo $endereco->estado ?></td>
                            <td><?php echo $endereco->ativo ?></td>
                            <!-- <td>
                              <a><i class="material-icons" style="padding-left: 5px; color: CornflowerBlue; cursor: pointer;">description</i></a>
                              <a href='http://vacinarte-admin.com.br/cadastrar-endereco/?id=<?php //echo $endereco->cd_end; ?>'><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">edit</i></a>
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
    $('#tab_lista_end').DataTable({
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
    $('#tab_lista_end_filter').addClass('pull-right');
    $('#tab_lista_end_paginate').addClass('pull-right');
  });

    </script>
  </body>
  </html>
