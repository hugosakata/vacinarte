<?php /* Template Name: TelaCadCampanha */

global $wpdb;
?>

<?php

$id_cmp = 0;
$campanha = $cd_cli = $tp_srv = "";

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];
}

function load(){
  global $campanha, $cd_cli, $tp_srv;

  $campanha = str_replace("'", "", trim($_POST["campanha"]));
  $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  // $data_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  // $data_fim = str_replace("'", "", trim($_POST["dt_fim"]));

}

load();

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
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
    
    <script type='text/javascript' src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type='text/javascript' src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

    <style>
      .help-block{
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #a94442;
      }
      .corpo{
        background-color: WhiteSmoke;
      }
      .texto_cabeca{
        font-size: 25px;
        margin-top: 1.5vw !important;
        color: dimgray;
      }
      #btn_prox{
        width: 8vw;
        font-size: 14px;
        border-radius: 6px;
      }
      .formCadCmp{
        margin-top: -2vw;
      }
    </style>
  </head>
  
  <body class="corpo">
  
  
  <?php include 'tela_header.php';?>

  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
<div class="container"><!-- container principal-->
    
    <div class="row formCadCmp">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header texto_cabeca">Cadastro de Campanha</h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row formCadCmp"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form" action="http://vacinarte-admin.com.br/cadastrar-campanha-form/" method="post">
          <div class="row">  
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control" 
              value="<?php echo $campanha; ?>" required />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Empresa</label>
              <select class="selectpicker form-control" id="cd_cli" name="cd_cli"
              value="<?php echo $cd_cli; ?>" required >
              <option value=""></option>
              <?php
                $clientes = $wpdb->get_results( 
                  "
                  SELECT cd_cli, nm_rz_soc, nm_fant 
                  FROM CLIENTES
                  WHERE cd_tp_cli=2 order by nm_fant
                  "
                );
                
                foreach ( $clientes as $cliente ) 
                {
              ?>
                <option value='<?php echo $cliente->cd_cli ?>'><?php echo $cliente->nm_fant ?></option>
            <?php
              }
              ?>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-3">
              <label style="font-size: 14px;">Tipo</label>
              <select class="selectpicker form-control" id="tp_srv" name="tp_srv"
              value="<?php echo $tp_srv; ?>" required >
                <option value=""></option>
                <option value="1">Gesto</option>
                <option value="2">Completo</option>
              </select>
            </div>
          </div>

          <div class="row hide">
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

          <div class="row btns" style="margin-top: 1vw;">
            <div class="col-xs-2 col-xs-offset-3">
              <input id="btn_prox" type="submit" class="button btn btn-danger btn_salvar" value="Próxima">
            </div>
            <div class="col-xs-2 col-xs-offset-1 hide">
              <input  type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
              value="Vacinas" <?php if ($id_cmp <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
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
