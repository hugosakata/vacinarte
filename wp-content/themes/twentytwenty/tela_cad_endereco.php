<?php /* Template Name: CadastroEndereco */

global $wpdb;
?>

<?php

$logra = $num_logra = "";
$compl_logra = $bairro = $cep = $cidade = $msg_err = "";

if(isset($_GET['id'])){
  echo $_GET['id'];
}

 function load(){
    global $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $msg_err;

    $logra = str_replace("'", "", trim($_POST["logra"]));
    $num_logra = str_replace("'", "", trim($_POST["num_logra"]));
    $compl_logra = str_replace("'", "", trim($_POST["compl_logra"]));
    $bairro = str_replace("'", "", trim($_POST["bairro"]));
    $cep = str_replace("'", "", trim($_POST["cep"]));
    $cidade = str_replace("'", "", trim($_POST["cidade"]));
 }

 function form_valido() {
    global $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $msg_err;

    $valido = false;
    if (!empty($logra) &&
        !empty($num_logra) &&
        !empty($bairro) &&
        !empty($cep) &&
        !empty($cidade)){
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

    <title>Cadastro de Endereço</title>
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
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('logra').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf_br').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logra').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf_br').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logra').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf_br').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

  </head>
  <body>
  <?php include 'tela_header.php';?>
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Cadastro de Endereço
          <br>
            <small>Preencha o formulário abaixo para cadastrar um novo endereço</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">

          
        <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>CEP*</label>
              <input type="text" name="cep" class="form-control" 
                placeholder="Sem hífen"
              onblur="pesquisacep(this.value);" value="<?php echo $cep; ?>">
            </div>
            <div class="form-group col-xs-6">
              <label>Logradouro*</label>
              <input type="text" id="logra" name="logra" class="form-control" 
                placeholder="Rua / Avenida..." value="<?php echo $logra; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label>Número*</label>
              <input type="text" name="num_logra" class="form-control" 
                placeholder="Nº" value="<?php echo $num_logra; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Complemento</label>
              <input type="text" name="compl_logra" 
                class="form-control" placeholder="apto / lote / bloco"
                value="<?php echo $compl_logra; ?>">
            </div>
          </div>

          
          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label>Bairro*</label>
              <input type="text" id="bairro" name="bairro" class="form-control" 
                placeholder="Bairro" value="<?php echo $bairro; ?>">
            </div>
            
            <div class="form-group col-xs-3">
              <label>Cidade*</label>
              <input type="text" id="cidade" name="cidade" class="form-control" 
                placeholder="Cidade" value="<?php echo $cidade; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label>UF*</label>
              <select class="selectpicker form-control" id="uf_br" name="uf_br"
              value="<?php echo $uf_br; ?>">
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
          </div>
        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    


    
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

  </body>
  </html>
