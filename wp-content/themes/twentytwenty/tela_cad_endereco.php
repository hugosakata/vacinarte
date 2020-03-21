<?php /* Template Name: CadastroEndereco */

global $wpdb;
?>

<?php

$endereco = $nm_end = $logra = $num_logra = $id_cli = "";
$compl_logra = $bairro = $cep = $cidade = $msg_err = "";
$id_end = $id_vcl = 0;

if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}

 function load(){
    global $nm_end, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $uf_br, $msg_err;

    $nm_end = str_replace("'", "", trim($_POST["nm_end"]));
    $logra = str_replace("'", "", trim($_POST["logra"]));
    $num_logra = str_replace("'", "", trim($_POST["num_logra"]));
    $compl_logra = str_replace("'", "", trim($_POST["compl_logra"]));
    $bairro = str_replace("'", "", trim($_POST["bairro"]));
    $cep = str_replace("'", "", trim($_POST["cep"]));
    $cidade = str_replace("'", "", trim($_POST["cidade"]));
    $uf_br = str_replace("'", "", trim($_POST["uf_br"]));
 }

 function form_valido() {
    global $nm_end, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $uf_br, $msg_err;

    $valido = false;
    if (!empty($nm_end) &&
        !empty($logra) &&
        !empty($num_logra) &&
        !empty($bairro) &&
        !empty($cep) &&
        !empty($cidade) &&
        !empty($uf_br)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
    $wpdb->query ("START TRANSACTION");
    $wpdb->insert(
      'ENDERECO',
      array(
        'nm_end'      => $nm_end,
        'logradouro'  => $logra,
        'num_end'     => $num_logra,
        'bairro'      => $bairro,
        'cep'         => $cep,
        'cidade'      => $cidade,
        'estado'      => $uf_br,
        'complemento' => $compl_logra
      ),
      array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
      )
    );
    $id_end = $wpdb->insert_id;

    $wpdb->insert(
      'VCL_ENDERECO',
      array(
        'cd_cli'      => $id_cli,
        'cd_end'      => $id_end        
      ),
      array(
        '%s',
        '%s'
      )
    );
    $id_vcl = $wpdb->insert_id;
    $sql = "SELECT * FROM ENDERECO WHERE cd_end = '{$i_end}'";
    $endereco = $wpdb->get_row($sql);

    // echo "<script language='javascript' type='text/javascript'>
    // alert('{$id_end}, {$id_vcl}');</script>";

    if ($id_end > 0 && $id_vcl > 0){
      $wpdb->query("COMMIT");
      
      echo "<script language='javascript' type='text/javascript'>
      alert('Endereço salvo com sucesso!');</script>";

      //limpa formulario
      $endereco = $nm_end = $logra = $num_logra = "";
      $compl_logra = $bairro = $cep = $cidade = $msg_err = "";

      // echo "<script language='javascript' type='text/javascript'>
      //   window.location.href='http://vacinarte-admin.com.br/listar-enderecos/?id={$id_cli}';</script>";

    } else {
      // $msg_err .= $wpdb->show_errors();
      // $msg_err .=$wpdb->print_error();

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

    <title>Cadastro de Endereço</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

    <style type="text/css">
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
        margin-top: 0.5vw !important;
        color: dimgray;
      }
      #btn_salvar, #btn_ctt{
        width: 8vw;
        font-size: 14px;
        border-radius: 6px;
      }
      #btn_ctt{
        padding-left: 15px;
        margin-left: 2vw;
      }
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
  <body class="corpo">

  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>

<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header texto_cabeca">Cadastro de Endereço</h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">

          
        <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label style="font-size: 14px;">Nome*</label>
              <input type="text" name="nm_end" class="form-control" 
                placeholder="Nome do endereço" value="<?php echo $nm_end; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 14px;">CEP*</label>
              <input type="text" name="cep" class="form-control" 
                placeholder="Sem hífen"
              onblur="pesquisacep(this.value);" value="<?php echo $cep; ?>">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-6 col-xs-offset-1">
              <label style="font-size: 14px;">Logradouro*</label>
              <input type="text" id="logra" name="logra" class="form-control" 
                placeholder="Rua / Avenida..." value="<?php echo $logra; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label style="font-size: 14px;">Número*</label>
              <input type="text" name="num_logra" class="form-control" 
                placeholder="Nº" value="<?php echo $num_logra; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label style="font-size: 14px;">Complemento</label>
              <input type="text" name="compl_logra" 
                class="form-control" placeholder="apto / lote / bloco"
                value="<?php echo $compl_logra; ?>">
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label style="font-size: 14px;">Bairro*</label>
              <input type="text" id="bairro" name="bairro" class="form-control" 
                placeholder="Bairro" value="<?php echo $bairro; ?>">
            </div>
            
            <div class="form-group col-xs-3">
              <label style="font-size: 14px;">Cidade*</label>
              <input type="text" id="cidade" name="cidade" class="form-control" 
                placeholder="Cidade" value="<?php echo $cidade; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label style="font-size: 14px;">UF*</label>
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
            <div class="col-xs-1 col-xs-offset-1">
              <input id="btn_salvar" type="submit" class="button btn btn-danger btn_geral"
              value="Salvar" <?php if ($id_end != 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>>
            </div>
            <div class="col-xs-1">
              <input id="btn_ctt" class="btn_geral btn_contato" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-contato/?id=<?php echo $id_cli; ?>';" 
              value="Contatos" <?php if ($id_cli <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
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
