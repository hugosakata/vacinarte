<?php /* Template Name: TelaCadAgenda */

global $wpdb;
?>

<?php

$cd_cmp = $dt_agenda = $hr_fim = $hr_ini = $nm_cmp = $nm_fant = $obs_agenda = "";
$cd_tp_atend = $tel_pri = $cd_end= $id_cli = $nm_ctt = $dt_agenda = $agenda = "";
$id_agenda = 0;

if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}

 function load(){
    global $cd_cli, $cd_cmp, $cd_end, $cd_ctt, $cd_tp_srv, $cd_tp_atend, $dt_agenda, $hr_ini, $hr_fim, $obs_agenda;

    $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
    $cd_end = str_replace("'", "", trim($_POST["cd_end"]));
    $cd_cmp = str_replace("'", "", trim($_POST["cd_cmp"]));
    $cd_ctt = str_replace("'", "", trim($_POST["cd_ctt"]));
    $cd_tp_srv = str_replace("'", "", trim($_POST["cd_tp_srv"]));
    $cd_tp_atend = str_replace("'", "", trim($_POST["cd_tp_atend"]));
    $dt_agenda = str_replace("'", "", trim($_POST["dt_agenda"]));
    $hr_ini = str_replace("'", "", trim($_POST["hr_ini"]));
    $hr_fim = str_replace("'", "", trim($_POST["hr_fim"]));
    $obs_agenda = str_replace("'", "", trim($_POST["obs_agenda"]));
 }

 function form_valido() {
    global $cd_cli, $cd_cmp, $cd_end, $cd_ctt, $cd_tp_srv, $cd_tp_atend, $nm_ctt, $dt_agenda, $hr_ini, $hr_fim, $obs_agenda;

    $valido = false;
    if (!empty($cd_cli) &&
        !empty($cd_end) &&
        !empty($cd_cmp) &&
        !empty($cd_ctt) &&
        !empty($cd_tp_srv) &&
        !empty($cd_tp_atend) &&
        !empty($nm_ctt) &&
        !empty($dt_agenda) &&
        !empty($hr_ini) &&
        !empty($hr_fim)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->insert(
      'CONTATO',
      array(
        'cd_cmp'      => $cd_cmp,
        'cd_tp_srv'   => $cd_tp_srv,
        'cd_tp_atend' => $cd_tp_atend,
        'cd_cli'      => $cd_cli,
        'cd_end'      => $cd_end,
        'cd_ctt'      => $cd_ctt,
        'dt_agenda'   => $dt_agenda,
        'hr_ini'      => $hr_ini,
        'hr_fim'      => $hr_fim,
        'obs_agenda'  => $obs_agenda
      ),
      array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%d',
        '%s',
        '%s',
        '%s',
        '%s'
      )
    );
    $id_agenda = $wpdb->insert_id;
    $sql = "SELECT * FROM AGENDA WHERE cd_agenda = '{$id_agenda}'";
    $agenda = $wpdb->get_row($sql);
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
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        .help-block{
              display: block;
              margin-top: 5px;
              margin-bottom: 10px;
              color: #a94442; }
    </style>
  </head>
  <body>
  <?php include 'tela_header.php'; ?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Agenda de campanha <span><?php echo $id_cli; ?></span>
          <br>
            <small>Preencha o formulário abaixo para agendar</small> 
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8" style="margin-top: -1vw;">
        <form action="#" method="post">

        <input type="text" name="cd_cli" class="hide" value="<?php echo $cd_cli; ?>">
        <input type="text" name="cd_ctt" class="hide" value="<?php echo $cd_ctt; ?>">
        <input type="text" name="cd_cmp" class="hide" value="<?php echo $cd_cmp; ?>">
        <input type="text" name="cd_tp_srv" class="hide" value="<?php echo $cd_tp_srv; ?>">

          <div class="row data">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label style="font-size: 14px;">Data</label>
              <input type="text" id="dt_agenda" name="dt_agenda" class="form-control"
              value="<?php echo $dt_agenda; ?>"/>
            </div>
            
           
            <div class="form-group col-xs-2">
              <label>Início</label>
              <input type="text" name="hr_ini" class="form-control"
              value="<?php echo $hr_ini; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label>Fim</label>
              <input type="text" name="hr_fim" class="form-control"
              value="<?php echo $hr_fim; ?>">
            </div>
          </div>

          <div class="row cliente">

            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Empresa</label>
              <input type="text" name="nm_fant" class="form-control" 
              value="<?php echo $nm_fant; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label>Contato</label>
              <input type="text" name="nm_ctt" class="form-control"
              value="<?php echo $nm_ctt; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label>Telefone</label>
              <input type="text" name="tel_pri" class="form-control"
              value="<?php echo $tel_pri; ?>">
            </div>

          </div>

          <div class="row campanha">

            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Campanha</label>
              <input type="text" name="nm_cmp" class="form-control" 
              value="<?php echo $nm_cmp; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label>Serviço</label>
              <input type="text" name="nm_srv" class="form-control"
              value="<?php echo $nm_srv; ?>">
            </div>

            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Atendimento</label>
              <select class="selectpicker form-control" id="cd_tp_atend" name="cd_tp_atend">
                <option value=""></option>
                <option value="1">In loco</option>
                <option value="2">Balcão</option>
              </select>
            </div>

          </div>

          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Observação</label>
              <input type="text" name="obs_agenda" class="form-control" 
              value="<?php echo $obs_agenda; ?>">
            </div>
          </div>
          
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Agendar">
            </div>
          </div>
        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    


    
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

  </body>
  </html>
