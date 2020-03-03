<?php /* Template Name: TelaCadCampanha */

global $wpdb;

?>

 
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Campanhas - Cadastro</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="../css/styles.css" rel="stylesheet" >

  </head>
  <body>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Cadastro de Campanha
          <br>
            <small>Preencha o formulário abaixo para cadastrar uma nova campanha</small>
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
              <label style="font-size: 12px;">Tipo</label>
              <select class="selectpicker form-control" id="tp_srv" name="tp_srv">
                <option value=""></option>
                <option value="1">Gesto</option>
                <option value="2">Completo</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 12px;">Data de início</label>
              <input type="text" id="dt_ini" name="dt_ini" class="form-control">
            </div>

            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Data de término</label>
              <input type="text" id="dt_fim" name="dt_fim" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-3">
              <label style="font-size: 12px;">Vacina</label>
              <select class="selectpicker form-control" id="cd_vcnA" name="cd_vcnA">
                <option value=""></option>
                <option value="1">H1N1</option>
                <option value="2">Sarampo</option>
                <option value="3">COVID-19</option>
              </select>
            </div>
            <div class="form-group col-xs-1">
              <label style="font-size: 12px;">Qtde</label>
              <input type="text" id="qt_vcnA" name="qt_vcnA" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-3">
              <label style="font-size: 12px;">Vacina</label>
              <select class="selectpicker form-control" id="cd_vcnB" name="cd_vcnB">
                <option value=""></option>
                <option value="1">H1N1</option>
                <option value="2">Sarampo</option>
                <option value="3">COVID-19</option>
              </select>
            </div>
            <div class="form-group col-xs-1">
              <label style="font-size: 12px;" >Qtde</label>
              <input type="text" id="qt_vcnB" name="qt_vcnB" class="form-control">
            </div>
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    <div class="row btns">
      <div class="col-xs-2 col-xs-offset-3">
        <input type="submit" class="button btn btn-danger " value="Cadastrar">
      </div>  
    </div>


    
</div><!-- fecha container principal -->  


    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

  </body>
  </html>
