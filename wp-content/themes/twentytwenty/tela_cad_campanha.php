<?php /* Template Name: TelaCadCampanha */

global $wpdb;
?>

<?php

$id_retorno = 0;
$campanha = $empresa = $tp_srv = $dt_ini = $dt_fim = $cmp = $id_cmp = "";

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];
}

function load(){
  global $campanha, $empresa, $tp_srv, $dt_ini, $dt_fim, $cmp;

  $campanha = str_replace("'", "", trim($_POST["campanha"]));
  $empresa = str_replace("'", "", trim($_POST["empresa"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  $dt_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  $dt_fim = str_replace("'", "", trim($_POST["dt_fim"]));

  print "<script language='javascript' type='text/javascript'>
            var x;
            x = '<?php print($empresa); ?>'
            console.log(x);
          </script>";
}

function form_valido() {
  global $campanha, $empresa, $tp_srv, $dt_ini, $dt_fim;

  $valido = false;
  if (!empty($campanha) &&
      !empty($empresa) &&
      !empty($tp_srv) &&
      !empty($dt_ini) && 
      !empty($dt_fim)){
        $valido = true;
  }
  echo "<script language='javascript' type='text/javascript'>alert('$empresa');</script>";
  return $valido;
}

load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->insert(
      'CAMPANHA',
      array(
        'nm_cmp'    => $campanha,
        'cd_cli'    => $empresa,
        'cd_tp_srv' => $tp_srv,
        'dt_ini'    => $dt_ini,
        'dt_fim'    => $dt_fim
      ),
      array(
        '%s',
        '%d',
        '%d',
        '%s',
        '%s'
      )
    );
    $id_retorno = $wpdb->insert_id;
    $sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_retorno}'";
    $cmp = $wpdb->get_row($sql);
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

    <title>Campanhas - Cadastro</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!--  Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

  </head>
  <body>
  <?php include 'tela_header.php'; echo $_GET["parametro"]; ?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Cadastro de Campanha <span><?php echo $campanha; ?> / <?php echo $empresa; ?> / <?php echo $tp_srv; ?></span>
          <br>
            <small>Preencha o formulário abaixo para cadastrar uma nova campanha</small><span><?php echo $dt_ini; ?> / <?php echo $dt_fim; ?></span>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form">
          <div class="row">  
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control"
              value="<?php echo $campanha; ?>"/>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Empresa</label>
              <select class="selectpicker form-control" id="empresa" name="empresa"
              value="<?php echo $empresa; ?>">
                <option value=""></option>
                <option value="1">Vacinarte Clinica De Vacinacao Ltda - Me</option>
                <option value="5">BANCO DO BRASIL SA</option>
                <option value="6">PADARIA MARESIAS LTDA</option>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 14px;">Tipo</label>
              <select class="selectpicker form-control" id="tp_srv" name="tp_srv"
              value="<?php echo $tp_srv; ?>">
                <option value=""></option>
                <option value="1">Gesto</option>
                <option value="2">Completo</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 14px;">Data de início</label>
              <input type="text" id="dt_ini" name="dt_ini" class="form-control"
              value="<?php echo $dt_ini; ?>"/>
            </div>

            <div class="form-group col-xs-2">
              <label style="font-size: 14px;">Data de término</label>
              <input type="text" id="dt_fim" name="dt_fim" class="form-control"
              value="<?php echo $dt_fim; ?>"/>
            </div>
          </div>

          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-3">
              <input type="submit" class="button btn btn-danger btn_salvar" value="Salvar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">
              <input type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-vacina/?id=<?php echo $id_cmp; ?>';" 
              value="Vacinas" <?php if ($id_retorno <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div>  
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->



    
</div><!-- fecha container principal -->  

	  <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript">
      JQuery(document).
    </script> -->
  </body>
  </html>
