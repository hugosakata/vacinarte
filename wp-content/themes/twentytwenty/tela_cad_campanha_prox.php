<?php /* Template Name: TelaCadCampanhaProx */

global $wpdb;
?>

<?php

$form = "";
$campanha = $cd_cli = $tp_srv = $dt_ini = $dt_fim = $data_ini = $data_fim = "";

if(isset($_GET['page'])){
  $form = $_GET['page'];
}

function load(){
  global $campanha, $cd_cli, $tp_srv, $data_ini, $data_fim, $cmp;

  $campanha = str_replace("'", "", trim($_POST["campanha"]));
  $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  $data_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  $data_fim = str_replace("'", "", trim($_POST["dt_fim"]));

}

function date_converter($_date = null) {
  $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
  if ($_date != null && preg_match($format, $_date, $partes)) {
    return $partes[3].'-'.$partes[2].'-'.$partes[1];
  }
  return false;
  }

function form_valido() {
  global $campanha, $cd_cli, $tp_srv, $dt_ini, $dt_fim, $data_ini, $data_fim;
  $dt_ini = date_converter($data_ini);
  $dt_fim = date_converter($data_fim);

  $valido = false;
  if (!empty($campanha) &&
      !empty($cd_cli) &&
      !empty($tp_srv) &&
      !empty($dt_ini) && 
      !empty($dt_fim)){
        $form = 'salvar';
        $valido = true;
      
  }
  
  return $valido;
}

load();

if($form == 'salvar'){
  if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    if (form_valido()){
      $wpdb->insert(
        'CAMPANHA',
        array(
          'nm_cmp'    => $campanha,
          'cd_cli'    => $cd_cli,
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
      $id_cmp = $wpdb->insert_id;
      $sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_retorno}'";
      $cmp = $wpdb->get_row($sql);
    } else {
        $msg_err = "Ops! Faltou preencher algum campo obrigatório";
    }
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
  <style>
  .formCadCmp{
    margin-top: -2vw;
  }
  </style>
  <body>
  <?php include 'tela_header.php';?>

  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
<div class="container"><!-- container principal-->
    
    <div class="row formCadCmp">
        <div class="col-lg-12 col-xs-12">
          <h3 class="page-header">Cadastro de Campanha <span><?php echo $dt_ini; ?></span> / <span><?php echo $dt_fim; ?></span>
          <br>
            <small>Preencha o formulário abaixo para cadastrar uma nova campanha</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row formCadCmp"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form" action="#" method="post">
          <div class="row">  
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control"
              value="<?php echo $campanha; ?>"/>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-4 col-xs-offset-3">
              <label style="font-size: 14px;">Endereço</label>
              <select class="selectpicker form-control" id="cd_end" name="cd_end"
              value="">
              <option value=""></option>
              <?php
                $enderecos = $wpdb->get_results( 
                  "
                  SELECT
                    VCL.CD_CLI,
                    VCL.CD_VCL_END,
                    END.CD_END,
                    END.NM_END,
                    CONCAT(END.LOGRADOURO, ', ', END.NUM_END, ', ', END.COMPLEMENTO, ', ', END.BAIRRO, ' - ', END.CIDADE) LOCAL
                  FROM
                    ENDERECO END,
                    (SELECT * FROM VCL_ENDERECO WHERE CD_CLI = '{$cd_cli}') VCL
                  WHERE
                    VCL.CD_END = END.CD_END
                  "
                );
                
                foreach ( $enderecos as $endereco ) 
                {
              ?>
                <option value=<?php echo $endereco->cd_end ?>><?php echo $endereco->nm_end ?></option>
            <?php
              }
              ?>
              </select>
            </div>
          </div>
          
          <div class="row hide">
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
              <input type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
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
