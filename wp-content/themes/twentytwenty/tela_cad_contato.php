<?php /* Template Name: CadastroContato */

global $wpdb;
?>

<?php

$nm_contato = $tel_pri = $email = $obs_ctt = $id_cli = "";
$id_ctt = $id_vcl = 0;

if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}

 function load(){
    global $nm_contato, $tel_pri, $email, $obs_ctt;

    $nm_contato = str_replace("'", "", trim($_POST["nm_contato"]));
    $tel_pri = str_replace("'", "", trim($_POST["tel_pri"]));
    $email = str_replace("'", "", trim($_POST["email"]));
    $obs_ctt = str_replace("'", "", trim($_POST["obs_ctt"]));
 }

 function form_valido() {
    global $nm_contato, $tel_pri;

    $valido = false;
    if (!empty($nm_contato) && 
        !empty($tel_pri)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->query ("START TRANSACTION");
    $wpdb->insert(
      'CONTATO',
      array(
        'cd_cli'  => $id_cli,
        'nm_ctt'  => $nm_contato,
        'tel_pri' => $tel_pri,
        'email'   => $email,
        'obs_ctt' => $obs_ctt
      ),
      array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s'
      )
    );
    $id_ctt = $wpdb->insert_id;

    $wpdb->insert(
      'VCL_CONTATO',
      array(
        'cd_cli'      => $id_cli,
        'cd_ctt'      => $id_ctt        
      ),
      array(
        '%s',
        '%s'
      )
    );
    $id_vcl = $wpdb->insert_id;

    if ($id_ctt > 0 && $id_vcl > 0){
      $wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Contato salvo com sucesso!');</script>";

      //limpa relatorio
      $nm_contato = $tel_pri = $email = $obs_ctt = "";

      // echo "<script language='javascript' type='text/javascript'>
      //   window.location.href='http://vacinarte-admin.com.br/listar-contatos/?id={$id_cli}';</script>";

    } else {
      $wpdb->query("ROLLBACK");

      $msg_err = "Ops! Algo deu errado, confirme os dados preenchidos e tente novamente";
    }
   
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
    <script type="text/javascript" >
      function IsEmail(email){
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if(!filter.test(email)){
            alert("Email inválido!");
            document.getElementById('email').value=("");
          }
      }
    </script>
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
          <h3 class="page-header">Cadastro de Contato 
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
              <label>Telefone*</label>
              <input type="text" id="tel_pri" name="tel_pri" class="form-control" placeholder="telefone principal"
              value="<?php echo $tel_pri; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Email</label>
              <input type="text" id="email" name="email" class="form-control" placeholder="Email" 
              onblur="IsEmail(this.value);"
              value="<?php echo $email; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Observação</label>
              <input type="text" name="obs_ctt" class="form-control" placeholder="Observações gerais"
              value="<?php echo $obs_ctt; ?>">
            </div>
          </div>
          
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Salvar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">
              <input type="button" onclick="location.href='http://vacinarte-admin.com.br/listar-enderecos/?id=<?php echo $id_cli; ?>';" 
              value="Endereços" <?php if ($id_cli <=0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
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
        $("#tel_pri").mask("(99)99999-9999");
      });
    </script>
  </body>
  </html>
