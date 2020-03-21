<?php /* Template Name: TelaCadCampanhaProx */

global $wpdb;
?>

<?php

$acao = "";
$campanha = $cd_cli = $cd_vcl_end = $tp_srv = $dt_ini = $dt_fim = $data_ini = $data_fim = $cd_end = "";

if(isset($_GET['page'])){
  $form = $_GET['page'];
}

function date_converter($_date = null) {
  $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
  if ($_date != null && preg_match($format, $_date, $partes)) {
    return $partes[3].'-'.$partes[2].'-'.$partes[1];
  }
  return false;
}

function load(){
  global $acao, $campanha, $cd_cli, $cd_vcl_end, $tp_srv, $data_ini, $data_fim, $cmp, $cd_end;

  $acao = $_POST["acao"];
  $campanha = str_replace("'", "", trim($_POST["campanha"]));
  $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
  $cd_vcl_end = str_replace("'", "", trim($_POST["cd_vcl_end"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  $data_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  $data_fim = str_replace("'", "", trim($_POST["dt_fim"]));
  
}

function form_valido() {
  global $campanha, $cd_cli, $cd_vcl_end, $tp_srv, $dt_ini, $dt_fim, $data_ini, $data_fim, $form;
  $dt_ini = date_converter($data_ini);
  $dt_fim = date_converter($data_fim);

  $valido = false;
  if (!empty($campanha) &&
      !empty($cd_cli) &&
      !empty($cd_vcl_end) &&
      !empty($tp_srv) &&
      !empty($dt_ini) && 
      !empty($dt_fim)){
    $valido = true;
  }
  return $valido;
}
  


load();

if($acao == 'salvar'){
  if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    if (form_valido()){
      $wpdb->insert(
        'CAMPANHA',
        array(
          'nm_cmp'    => $campanha,
          'cd_cli'    => $cd_cli,
          'cd_vcl_end'=> $cd_vcl_end,
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
      $sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_cmp}'";
      $cmp = $wpdb->get_row($sql);

      echo "<script language='javascript' type='text/javascript'>
      alert('Campanha salva com sucesso!');</script>";
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

    <script type='text/javascript' src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

  </head>
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
    margin-top: 2.5vw !important;
    color: dimgray;
  }
  #btn_salvar, #btn_vac{
    width: 8vw;
    font-size: 14px;
    border-radius: 6px;
  }
  #btn_vac{
    padding-left: 10px;
  }
  .formCadCmp{
    margin-top: -2vw;
  }
  </style>
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

    <div class="row formCadCmp"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <form class="form" action="#" method="post">
          <div class="hide">
            <input type="text" id="acao" name="acao" class="form-control"
                value="salvar"/>
            <input type="text" id="cd_cli" name="cd_cli" class="form-control"
                value="<?php echo $cd_cli; ?>"/>
            <input type="text" id="tp_srv" name="tp_srv" class="form-control"
              value="<?php echo $tp_srv; ?>"/>
          </div>
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
              <select class="selectpicker form-control" id="cd_vcl_end" name="cd_vcl_end">
              <option value=""></option>
              <?php
                $enderecos = $wpdb->get_results( 
                  "
                  SELECT 
                    `VCL_ENDERECO`.`cd_cli`,
                      `VCL_ENDERECO`.`cd_vcl_end`,
                      `ENDERECO`.`cd_end`, 
                      `nm_end`, 
                      `logradouro`, 
                      `num_end`, 
                      `complemento`, 
                      `bairro`, 
                      `cep`, 
                      `cidade`, 
                      `estado`
                  FROM `ENDERECO`, `VCL_ENDERECO` 
                  WHERE `ENDERECO`.`cd_end`=`VCL_ENDERECO`.`cd_end` and 
                  `VCL_ENDERECO`.`cd_cli`={$cd_cli}
                  "
                );

                foreach ( $enderecos as $endereco ) 
                {
              ?>
                  <option value='<?php echo $endereco->cd_vcl_end; ?>'><?php echo $endereco->nm_end . ": " . $endereco->logradouro . ", " . $endereco->num_end . " - " . $endereco->bairro; ?></option>
              <?php
                }
              ?>
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

          <div class="row btns" style="margin-top: 1vw;">
            <div class="col-xs-2 col-xs-offset-3">
              <input id="btn_salvar" type="submit" class="button btn btn-danger btn_salvar" value="Salvar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">
              <input id="btn_vac" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
              value="Vacinas" <?php if ($id_cmp <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div>  
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->



    
</div><!-- fecha container principal -->  

	  <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#dt_ini").mask("99/99/9999");
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#dt_fim").mask("99/99/9999");
      });
    </script>
  </body>
  </html>
