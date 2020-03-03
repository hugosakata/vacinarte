<?php /* Template Name: TelaAtend */

global $wpdb;

?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Atendimento - Cadastro</title>
    <!-- Bootstrap -->
     <!-- Bootstrap -->
     <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
     <!--  Styles -->
     <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>
  <body>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Atendimento
          <br>
            <small>Preencha o formulário abaixo para realizar o atendimento</small>
            <input type="submit" class="button btn btn-warning pull-right" value="Encerrar atendimento">
          </h3>
        </div>
    </div><!-- fecha div row -->

    <div class="row clientes"><!--div row lista de clientes -->
      <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active">
        <div class="col-lg-12 col-xs-12">
          <div class="row">
            <div class="col-lg-12 col-xs-12"><!-- posiciona painel -->
              <div class="panel panel-default">
                <div class="panel-body">
                  <table class="table table-striped" id="tb_clientes">
                    <thead>
                      <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>CPF/RG</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>02/03/2020</td>
                        <td>João da Silva</td>
                        <td>82612555064</td>
                        <td>
                          <a><i class="material-icons" style="padding-left: 5px; color: CornflowerBlue; cursor: pointer;">thumb_up</i></a>
                          <a><i class="material-icons" style="padding-left: 5px; color: tomato; cursor: pointer;">thumb_down</i></a>
                          <a><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">money_off</i></a>
                        </td>
                      </tr>
    
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

    

    
</div><!-- fecha container principal -->  


<script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
<script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

  </body>
  </html>
