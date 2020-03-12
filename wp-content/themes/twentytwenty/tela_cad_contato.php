<?php /* Template Name: CadastroContato */

global $wpdb;
?>

<?php

$nm_contato = $tp_ctt = $contato = $id_cli = "";

if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}

 function load(){
    global $nm_contato, $tp_ctt, $contato;

    $nm_contato = str_replace("'", "", trim($_POST["nm_contato"]));
    $tp_ctt = str_replace("'", "", trim($_POST["tp_ctt"]));
    $contato = str_replace("'", "", trim($_POST["contato"]));
 }

 function form_valido() {
    global $nm_contato, $tp_ctt, $contato;

    $valido = false;
    if (!empty($nm_contato) && 
        !empty($tp_ctt) && 
        !empty($contato)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
      $msg_err = "valido";
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

    <title>Cadastro de Contato</title>
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
  <?php include 'tela_header.php'; echo $_GET["parametro"]; ?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Cadastro de Contato <span><?php echo $id_cli; ?></span>
          <br>
            <small>Preencha o formulário abaixo para cadastrar um novo contato</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">
          
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Nome do contato*</label>
              <input type="text" name="nm_contato" class="form-control" placeholder="Nome do contato"
              value="<?php echo $nm_contato; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Tipo de contato*</label>
              <select class="selectpicker form-control" name="tp_ctt" value="<?php echo $tp_ctt; ?>">
                <option value=""></option>
                <option value="email">Email</option>
                <option value="telefone">Telefone</option>
                <option value="celular">Celular</option>
                <option value="whatsapp">WhatsApp</option>
              </select>
            </div>
            <div class="form-group col-xs-5">
              <label>Contato*</label>
              <input type="text" name="contato" class="form-control" placeholder="Contato"
              value="<?php echo $contato; ?>">
            </div>
            
          </div>
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Salvar">
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
