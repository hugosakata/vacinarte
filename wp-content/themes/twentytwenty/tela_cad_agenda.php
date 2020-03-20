<?php /* Template Name: TelaCadAgenda */

global $wpdb;
?>

<?php

$id_cmp = $dt_atend = $data_atend = $hr_ini = $hr_fim = $nm_enfermeiro = "";

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];//id da campanha
  $sql = "
        SELECT 
        `cd_cmp`, `nm_cmp`, `nm_fant`, `cd_vcl_end`, `nm_tp_srv`, `dt_ini`, `dt_fim` 
        FROM `CAMPANHA`, `TP_SRV`, `CLIENTES`
        WHERE `CAMPANHA`.`cd_tp_srv`=`TP_SRV`.`cd_tp_srv` AND
        `CAMPANHA`.`cd_cli`=`CLIENTES`.`cd_cli` and
        cd_cmp = '{$id_cmp}'
          ";
  $campanha = $wpdb->get_row($sql);
}

function date_converter($_date = null) {
  $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
  if ($_date != null && preg_match($format, $_date, $partes)) {
    return $partes[3].'-'.$partes[2].'-'.$partes[1];
  }
  return false;
  }

 function load(){
    global $id_cmp, $dt_atend, $data_atend, $hr_ini, $hr_fim, $nm_enfermeiro;

    $data_atend = str_replace("'", "", trim($_POST["dt_atend"]));
    $hr_ini = str_replace("'", "", trim($_POST["hr_ini"]));
    $hr_fim = str_replace("'", "", trim($_POST["hr_fim"]));
    $nm_enfermeiro = str_replace("'", "", trim($_POST["nm_enfermeiro"]));
 }

 function form_valido() {
    global $id_cmp, $dt_atend, $data_atend, $hr_ini, $hr_fim, $nm_enfermeiro;  

    $dt_atend = date_converter($data_atend);

    $valido = false;
    if (!empty($id_cmp) &&
        !empty($dt_atend) &&
        !empty($hr_ini) &&
        !empty($hr_fim) &&
        !empty($nm_enfermeiro)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->insert(
      'ATENDIMENTO',
      array(
        'cd_cmp'          => $id_cmp,
        'dt_atend'        => $dt_atend,
        'hr_ini'          => $hr_ini,
        'hr_fim'          => $hr_fim,
        'nm_enfermeiro'   => $nm_enfermeiro
      ),
      array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s'
      )
    );
    $id_atend = $wpdb->insert_id;
    $sql = "SELECT * FROM ATENDIMENTO WHERE cd_atend = '{$id_atend}'";
    $atendimento = $wpdb->get_row($sql);

    echo "<script language='javascript' type='text/javascript'>
      alert('Agendamento salvo com sucesso!');</script>";
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}
?>
 

 <!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agendamentos</title>
    <!-- Bootstrap -->
    <!-- <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <!-- <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" > --> -->
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        .help-block{
              display: block;
              margin-top: 5px;
              margin-bottom: 10px;
              color: #a94442; }
    </style>
<script type='text/javascript'
  src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type='text/javascript'
  src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css"
  href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
  </head>
  <body>
 
  <header id="site-header" class="header-footer-group" role="banner" style="margin-top: -2vw;">
    
    <div >
      <nav class="navbar navbar-default cabeca">
        <div class="container-fluid" style="background-color: Gainsboro;">
          <!-- Brand and toggle get grouped for better mobile display -->
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
            <div class="header-inner section-inner" style="height: 3vw; width: 18vw; position: absolute;">
              <div class="header-titles-wrapper">					
                  <div class="header-titles">
                      <div class="site-title faux-heading"><a style="cursor: pointer;" href="http://vacinarte-admin.com.br/home">Vacinarte</a></div>
                  </div><!-- .header-titles -->
              </div><!-- .header-titles-wrapper -->
          </div><!-- .header-inner -->
            

            <ul class="nav navbar-nav" style="margin-left: 36vw;">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                  role="button" aria-haspopup="true" 
                  aria-expanded="false">Cadastrar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="http://vacinarte-admin.com.br/cadastrar-pf/">Pessoa física</a></li> -->
                  <li><a href="http://vacinarte-admin.com.br/cadastrar-pj/">Pessoa jurídica</a></li>
                  <li><a href="http://vacinarte-admin.com.br/campanha/">Campanha</a></li>
                </ul>
              </li>
            </ul>
            
            <ul class="nav navbar-nav ">
              <li class="dropdown">
                <a href="#" style="text-decoration: none;" class="dropdown-toggle" 
                  data-toggle="dropdown" role="button" aria-haspopup="true" 
                  aria-expanded="false">Listar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="http://vacinarte-admin.com.br/listar-pf/">Clientes PF</a></li> -->
                  <li><a href="http://vacinarte-admin.com.br/listar-pj/">Pessoa jurídica</a></li>
                  <li><a href="http://vacinarte-admin.com.br/listar-campanhas/">Campanhas</a></li>
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav ">
              <li><a style="text-decoration: none;" href="http://vacinarte-admin.com.br/listar-agendamento/">Agenda</a></li>
              <li><a style="text-decoration: none;" href="https://www.vacinarte.com.br/">Site Vacinarte</a></li>
              <li class="page_item page-item-13"><a style="text-decoration: none;" href="http://vacinarte-admin.com.br/?sair=true">Sair</a></li>
            </ul>            
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </header><!-- #site-header -->


  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Agendamento de campanha
          <br>
            <small>Preencha o formulário abaixo para agendar</small> 
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8" style="margin-top: -1vw;">

<div class="accordion" id="searchAccordion">
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse"
            data-parent="#searchAccordion" id="idOne">+ Dados da campanha - <?php echo $campanha->nm_cmp; ?></a> 
        </div>
        <div id="collapseOne" class="accordion-body collapse">
          <div class="accordion-inner">
            <form>

        <div class="row campanha page-header">
            
            <div class="form-group col-xs-8 col-xs-offset-1">
              <label>Nome</label>
              <input type="text" name="nm_cmp" class="form-control" 
              value="<?php echo $campanha->nm_cmp; ?>" disabled>
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Tipo</label>
              <input type="text" name="nm_srv" class="form-control"
              value="<?php echo $campanha->nm_tp_srv; ?>" disabled>
            </div>

            <div class="form-group col-xs-6 col-xs-offset-1">
              <label>Empresa</label>
              <input type="text" name="nm_srv" class="form-control"
              value="<?php echo $campanha->nm_fant; ?>" disabled>
            </div>
            
            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Data de início</label>
              <input type="text" name="nm_srv" class="form-control"
              value="<?php echo $campanha->dt_ini ?>" disabled>
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Data de término</label>
              <input type="text" name="nm_srv" class="form-control"
              value="<?php echo $campanha->dt_fim; ?>" disabled>
            </div>

          </div>
        </form><!-- fecha form -->
          </div>
        </div>
      </div>
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse"
            data-parent="#searchAccordion" id="idTwo">+ Dados do agendamento</a>
        </div>
        <div id="collapseTwo" class="accordion-body collapse">
          <div class="accordion-inner">
            <form action="#" method="post">

          <div class="row agendamento page-header">
            
            <div class="form-group col-xs-10 col-xs-offset-1">
              <label>Enfermeiro(a)</label>
              <input type="text" name="nm_enfermeiro" class="form-control" 
              value="<?php echo $nm_enfermeiro; ?>">
            </div>
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label style="font-size: 14px;">Data</label>
              <input type="text" id="dt_atend" name="dt_atend" class="form-control"
              value="<?php echo $dt_atend; ?>"/>
            </div>
            
           
            <div class="form-group col-xs-2">
              <label>Hora Início</label>
              <input type="text" id="hr_ini" name="hr_ini" class="form-control"
              value="<?php echo $hr_ini; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label>Hora Fim</label>
              <input type="text" id="hr_fim" name="hr_fim" class="form-control"
              value="<?php echo $hr_fim; ?>">
            </div>
            
          </div>          
          
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-3">
              <input type="submit" class="button btn btn-danger " value="Agendar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">
              <input type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
              value="Vacinas" <?php if ($id_cmp <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div>
          </div>
        </form><!-- fecha form -->
          </div>
        </div>
      </div>
    </div>
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    <script>
    $("#idOne").click(function(){
      if (document.getElementById('collapseOne').classList.contains("in")){
        document.getElementById('collapseOne').setAttribute('class','accordion-body collapse');
        $("#idOne").text("+" + $("#idOne").text().substring(1));
      } else {
        document.getElementById('collapseOne').setAttribute('class','accordion-body collapse in');
        $("#idOne").text("-" + $("#idOne").text().substring(1));
      }
    });
    $("#idTwo").click(function(){
      if (document.getElementById('collapseTwo').classList.contains("in")){
        document.getElementById('collapseTwo').setAttribute('class','accordion-body collapse');
        $("#idTwo").text("+" + $("#idTwo").text().substring(1));
      } else {
        document.getElementById('collapseTwo').setAttribute('class','accordion-body collapse in');
        $("#idTwo").text("-" + $("#idTwo").text().substring(1));
      }
      
    });
    </script>


    
</div><!-- fecha container principal -->  


    <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#dt_atend").mask("99/99/9999");
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#hr_ini").mask("99:99");
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#hr_fim").mask("99:99");
      });
    </script>
  </body>
  </html>
