<?php /* Template Name: CadastroPJ */

global $wpdb;
?>

<?php

$razao = $nm_fant = $cnpj = $msg_err = "";

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
      $id_retorno = 0;
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
      echo "<script>alert('id = "+$id_retorno+");</script>";
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
          <h3 class="page-header">Cadastro de Cliente PJ 
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
              <input type="text" name="razao" class="form-control" placeholder="Razão Social da empresa">
            </div>
            <div class="form-group col-xs-3">
              <label>Nome fantasia*</label>
              <input type="text" name="nm_fant" class="form-control" placeholder="Nome fantasia">
            </div>
            <div class="form-group col-xs-2">
              <label>CNPJ*</label>
              <input type="text" name="cnpj" class="form-control" placeholder="Sem pontos/hífen">
            </div>
          </div>
          
          <div class="row hide">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Falar com</label>
              <input type="text" name="nm_contato" class="form-control" placeholder="Nome do contato">
            </div>

            <div class="form-group col-xs-2">
              <label>Tel. celular</label>
              <input type="text" name="cel" class="form-control" placeholder="Telefone celular">
            </div>
            <div class="form-group col-xs-2">
              <label>Tel. fixo</label>
              <input type="text" name="tel" class="form-control" placeholder="Telefone fixo">
            </div>
            <div class="form-group col-xs-4">
              <label>Email</label>
              <input type="text" name="email" class="form-control" placeholder="xyz@xyz.com - letras minúsculas">
            </div>
          </div>

          <div class="row hide">
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Logradouro</label>
              <input type="text" name="logra" class="form-control" placeholder="Rua / Avenida...">
            </div>
            <div class="form-group col-xs-1">
              <label>Número</label>
              <input type="text" name="num_logra" class="form-control" placeholder="Nº">
            </div>
            <div class="form-group col-xs-4 ">
              <label>Complemento</label>
              <input type="text" name="compl_logra" class="form-control" placeholder="Edifício / Andar / Sala">
            </div>
          </div>

          <div class="row hide">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label>Bairro</label>
              <input type="text" name="bairro" class="form-control" placeholder="Bairro">
            </div>
            <div class="form-group col-xs-2">
              <label>CEP</label>
              <input type="text" id="cep" name="cep" class="form-control" placeholder="Sem hífen">
            </div>
            <div class="form-group col-xs-3">
              <label>Cidade</label>
              <input type="text" name="cidade" class="form-control" placeholder="Cidade">
            </div>
            <div class="form-group col-xs-1">
              <label>UF</label>
              <select class="selectpicker form-control" name="uf_br">
                <option value=""></option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
              </select>
            </div>
          </div>
          <div class="row btns">
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Salvar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">

              <input type="button" onclick="location.href='http://vacinarte-admin.com.br/listar-enderecos/';" 
              value="Endereços" <?php if ($_GET["id"] <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div> 
            <div class="col-xs-2 col-xs-offset-1">
              <input type="button" onclick="<?php echo "location.href='http://vacinarte-admin.com.br/listar-contatos/"; ?>" 
              value="Contatos" <?php if ($_GET["id"] <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
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
