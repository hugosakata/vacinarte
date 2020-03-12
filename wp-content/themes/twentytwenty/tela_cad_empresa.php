<?php /* Template Name: CadastroPJ */

global $wpdb;
?>

<?php

$razao = $nm_fant = $cnpj = $msg_err = "";
$id_retorno = 0;

 function load(){
    global $razao, $nm_fant, $cnpj;

    $razao = str_replace("'", "", trim($_POST["razao"]));
    $nm_fant = str_replace("'", "", trim($_POST["nm_fant"]));
    $cnpj = str_replace("'", "", trim($_POST["cnpj"]));
    
 }

 function form_valido() {
    global $razao, $nm_fant, $cnpj, $msg_err;
    
    $valido = false;
    if (!empty($razao) && 
        !empty($nm_fant) && 
        !empty($cnpj)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
      
      $wpdb->insert(
        'CLIENTES',
        array(
          'nm_rz_soc' => $razao,
          'nm_fant'   => $nm_fant,
          'cpf_cnpj'  => $cnpj,
          'cd_tp_cli' => 2
        ),
        array(
          '%s',
          '%s',
          '%s',
          '%d'
        )
      );
      $id_retorno = $wpdb->insert_id;
      $sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_retorno}'";
      $cliente = $wpdb->get_row($sql);
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}

function chamaURL(btn, param){
  if(btn == 'endereco'){
    //location.href='http://vacinarte-admin.com.br/listar-enderecos/?id='+param;
    header("Location: "."http://vacinarte-admin.com.br/listar-enderecos/?id="+param);

  }else{

  }
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clientes PJ - Cadastro</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

    <style type="text/css">
        .help-block{ display: block;
                     margin-top: 5px;
                     margin-bottom: 10px;
                     color: #a94442; }
    </style>
  </head>
  <body>
  <?php include 'tela_header.php';?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Cadastro de Cliente PJ <span><?php echo $id_retorno; ?></span>
          <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>
    

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">
          <div class="row">  
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Razão Social*</label>
              <input type="text" name="razao" class="form-control" placeholder="Razão Social da empresa" <?php if ($id_retorno != 0) { echo "value='$cliente->nm_rz_soc'"; } ?>/>
            </div>
            <div class="form-group col-xs-3">
              <label>Nome fantasia*</label>
              <input type="text" name="nm_fant" class="form-control" placeholder="Nome fantasia" <?php if ($id_retorno != 0) { echo "value='$cliente->nm_fant'"; } ?>/>
            </div>
            <div class="form-group col-xs-2">
              <label>CNPJ*</label>
              <input type="text" name="cnpj" class="form-control" placeholder="Sem pontos/hífen" <?php if ($id_retorno != 0) { echo "value='$cliente->cpf_cnpj'"; } ?>/>
            </div>
          </div>
         
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Salvar" <?php if ($id_retorno != 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div>
            <div class="col-xs-2 col-xs-offset-1">

              <input type="button" onclick="chamaURL(endereco, {$id_retorno});" 
              value="Endereços" <?php if ($id_retorno <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div> 
            <div class="col-xs-2 col-xs-offset-1">
              <input type="button" onclick="<?php echo "location.href='http://vacinarte-admin.com.br/listar-enderecos/?id={$id_retorno}"; ?>" 
              value="Contatos" <?php if ($id_retorno <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
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
