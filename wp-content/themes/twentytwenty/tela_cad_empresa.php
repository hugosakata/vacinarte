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

//  function set_cliente($id){
//     global $cliente, $id_retorno;
//     $sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_retorno}'";
//     $cliente = $wpdb->get_row($sql);
//     $id_retorno = $cliente->cd_cli;
//  }

 load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_retorno = $_GET["id"];

  $sql = "SELECT * FROM CLIENTES WHERE cd_cli = '{$id_retorno}'";
  $cliente = $wpdb->get_row($sql);
}

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

      echo "<script language='javascript' type='text/javascript'>
      alert('Cliente salvo com sucesso!');</script>";
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
    <!--  Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

    <!-- <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"> -->

    <script type='text/javascript' src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type='text/javascript' src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

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
        margin-top: 1vw !important;
        color: dimgray;
      }
      .barra4vw{
        height: 4vw !important;
      }
      .cabeca{
        border: none;
        margin-left: -15px;
        width: 103%;
      }
      .link_home{
        margin-left: 2vw;
        text-decoration: none;
        color: #353b48;
        font-size: 18px;
        font-weight: bold;
      }
      .fontMenu{
      font-size: 15px;
      font-weight: bold;
    }
      #btn_salvar, #btn_end, #btn_ctt{
        width: 8vw;
        font-size: 14px;
        border-radius: 6px;
      }
      #btn_end{
        padding-left: 10px;
      }
      #btn_ctt{
        padding-left: 15px;
      }
    </style>
  </head>
  <body class="corpo">
 
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>

<div class="container-fluid barra4vw">
    <!-- <span><a class="" data-toggle="modal" data-target="#modalBtnCad">Cadastrar</a></span> -->
    <div >
        <nav class="navbar navbar-default cabeca barra4vw">
          <div class="container-fluid barra4vw" style="background-color: Gainsboro;">
            <!-- Brand and toggle get grouped for better mobile display -->
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar barra4vw">
              <ul class="nav navbar-nav" style="margin-top: 1vw; float: left;">
                <a class="link_home" href="http://vacinarte-admin.com.br/home"><span>Vacinarte</span></a>
              </ul>

              <ul class="nav navbar-nav" style="margin-left: 48vw;">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle fontMenu" data-toggle="dropdown" 
                    role="button" aria-haspopup="true" 
                    aria-expanded="false">Cadastrar <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <!-- <li><a href="http://vacinarte-admin.com.br/cadastrar-pf/">Pessoa física</a></li> -->
                    <li><a href="http://vacinarte-admin.com.br/cadastrar-pj/">Pessoa jurídica</a></li>
                    <li><a href="http://vacinarte-admin.com.br/campanha/">Campanha</a></li>
                  </ul>
                </li>
              </ul>
              
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" style="text-decoration: none;" class="dropdown-toggle fontMenu" 
                    data-toggle="dropdown" role="button" aria-haspopup="true" 
                    aria-expanded="false">Listar <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <!-- <li><a href="http://vacinarte-admin.com.br/listar-pf/">Clientes PF</a></li> -->
                    <li><a href="http://vacinarte-admin.com.br/listar-pj/">Pessoa jurídica</a></li>
                    <li><a href="http://vacinarte-admin.com.br/listar-campanhas/">Campanhas</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav">
                <!-- <li><a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#modalBtnCad">Cadastrar</a></li> -->
                <li><a style="text-decoration: none;" class="fontMenu" href="http://vacinarte-admin.com.br/listar-agendamento/">Agenda</a></li>
                <li><a style="text-decoration: none;" class="fontMenu" href="https://www.vacinarte.com.br/">Site Vacinarte</a></li>
                <li class="page_item page-item-13 fontMenu"><a style="text-decoration: none;" href="http://vacinarte-admin.com.br/?sair=true">Sair</a></li>
              </ul>            
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </div>

  </div>

<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header texto_cabeca">Cadastro de Cliente PJ</h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>
    

    <div class="row txtbox"><!-- row formulario -->
      <form action="#" method="post" style="margin-top: -2vw;">
        <div class="col-lg-12 col-xs-8">
            
            <div class="row">  
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Razão Social*</label>
                <input type="text" name="razao" class="form-control" placeholder="Razão Social da empresa" maxlength="150" <?php echo "value='$cliente->nm_rz_soc'"; ?>/>
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Nome fantasia*</label>
                <input type="text" name="nm_fant" class="form-control" placeholder="Nome fantasia" maxlength="150" <?php echo "value='$cliente->nm_fant'"; ?>/>
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">CNPJ*</label>
                <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="Sem pontos/hífen" <?php echo "value='$cliente->cpf_cnpj'"; ?>/>
              </div>
            </div>

        </div>
        
        <div class="col-lg-12 col-xs-8" style="margin-top: 1vw;">
          <div class="row btns">
            <div class="col-xs-1 col-xs-offset-3">
              <input id="btn_salvar" type="submit" class="button btn btn-danger btn_geral" value="Salvar"/>
            </div>
            <div class="col-xs-1" style="margin-left: 2vw;">

              <input id="btn_end" type="button" class="btn_geral btn_endereco" onclick="location.href='http://vacinarte-admin.com.br/listar-enderecos/?id=<?php echo $id_retorno; ?>';" 
              value="Endereços" <?php if ($id_retorno <=0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div> 
            <div class="col-xs-1" style="margin-left: 2vw;">
              <input id="btn_ctt" type="button" class="btn_geral btn_contato" onclick="location.href='http://vacinarte-admin.com.br/listar-contatos/?id=<?php echo $id_retorno; ?>';" 
              value="Contatos" <?php if ($id_retorno <=0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
            </div> 
          </div>
        </div><!-- fecha col 12 -->
      </form><!-- fecha form -->
    </div><!-- fecha row txtbox -->

    


    
</div><!-- fecha container principal -->  

    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#cnpj").mask("99.999.999/9999-99");
      });
    </script>

  </body>
  </html>
