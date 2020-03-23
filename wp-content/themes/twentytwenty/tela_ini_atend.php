<?php /* Template Name: TelaIniAtend */

global $wpdb;
$home = get_home_url(); 
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Atendimento - Iniciar</title>
   <!-- Bootstrap -->
   <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
   <!-- Cesup Styles -->
   <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

  </head>
  <body>
  <?php include 'tela_header.php';?>

  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/';</script>";
    }?>

<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Iniciando Atendimento
          <br>
            <small>Informações sobra a campanha para iniciar o atendimento</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form">
          <div class="row">  
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 12px;">Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 12px;">Empresa</label>
              <select class="selectpicker form-control" id="empresa" name="empresa">
                <option value=""></option>
                <option value="1">Vacinarte Clinica De Vacinacao Ltda - Me</option>
                <option value="5">BANCO DO BRASIL SA</option>
                <option value="6">PADARIA MARESIAS LTDA</option>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 12px;">Atendimento</label>
              <select class="selectpicker form-control" id="tp_atend" name="tp_atend">
                <option value=""></option>
                <option value="1">Balcão</option>
                <option value="2">In loco</option>
              </select>
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Data de atendimento</label>
              <input type="text" id="dt_atend" name="dt_atend" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 12px;">Listagem</label>
              <select class="selectpicker form-control" id="listagem" name="listagem">
                <option value=""></option>
                <option value="1">Cadastrada</option>
                <option value="2">Manual</option>
              </select>
            </div>
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    <div class="row btns">
      <div class="col-xs-2 col-xs-offset-3">
        <input type="submit" class="button btn btn-danger " value="Iniciar">
      </div>  
    </div>


    
</div><!-- fecha container principal -->  


<script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
<script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

  </body>
  </html>