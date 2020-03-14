<?php /* Template Name: TelaCadVacina */

global $wpdb;
?>

<?php

$id_retorno = 0;
$cd_cmp = $cd_vcna = $qtd_vcna = $vlr_vcna = $vcna"";

if(isset($_GET['id'])){
  $cd_cmp = $_GET['id'];
}

function load(){
  global $cd_vcna, $qtd_vcna, $vlr_vcna, $vcna, $cd_cmp;

  $cd_vcna = str_replace("'", "", trim($_POST["cd_vcna"]));
  $qtd_vcna = str_replace("'", "", trim($_POST["qtd_vcna"]));
  $vlr_vcna = str_replace("'", "", trim($_POST["vlr_vcna"]));
  
}

function form_valido() {
  global $cd_vcna, $nm_vcna, $qtd_vcna, $vlr_vcna, $cd_cmp;

  $valido = false;
  if (!empty($cd_cmp) &&
      !empty($cd_vcna) &&
      !empty($qtd_vcna) &&
      !empty($vlr_vcna)){
        $valido = true;
  }
  
  return $valido;
}

load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  if (form_valido()){
    $wpdb->insert(
      'VACINA',
      array(
        'cd_vcna'   => $cd_vcna,
        'qtd_vcna'  => $qtd_vcna,
        'vlr_vcna'  => $vlr_vcna
      ),
      array(
        '%d',
        '%d',
        '%d'
      )
    );
    $id_retorno = $wpdb->insert_id;
    $sql = "SELECT * FROM VACINA WHERE cd_vcna = '{$id_retorno}'";
    $vcna = $wpdb->get_row($sql);
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

    <title>Vacina - Cadastro</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!--  Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

  </head>
  <body>
  <?php include 'tela_header.php';?>

  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Vacina <span><?php echo $cd_vcna; ?> / <?php echo $id_retorno; ?></span>
          <br>
            <small>Preencha o formulário abaixo para cadastrar vacina para a campanha</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form" action="#" method="post">
          
          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-2">
                <label style="font-size: 12px;">Vacina</label>
                  <select class="selectpicker form-control" id="cd_vcna" name="cd_vcna">
                    <option value=""></option>
                    <option value="1">H1N1</option>
                    <option value="2">Sarampo</option>
                    <option value="3">COVID-19</option>
                  </select>
            </div>
            <div class="form-group col-xs-1">
              <label style="font-size: 12px;">Qtde</label>
              <input type="text" id="qtd_vcna" name="qtd_vcna" class="form-control">
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 12px;">Valor Unit</label>
              <input type="text" id="vlr_vcna" name="vlr_vcna" class="form-control">
            </div>
          </div>
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-3">
              <input type="submit" class="button btn btn-danger btn_salvar" value="Salvar">
            </div>
              
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->



    
</div><!-- fecha container principal -->  

	  <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('.btn_salvar').on('click', function(){
        console.log($campanha);
        alert($campanha);
      });
    </script>
  </body>
  </html>
