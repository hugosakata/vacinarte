<?php /* Template Name: TelaFechamentoAgenda */

global $wpdb;
?>

<?php

$atend = $cd_atend = $campanha = $dt_agenda = $enfermeira = $vacina = $qtd_vcna = $qtd_retorno = $qtd_cortesia = "";


if(isset($_GET['id'])){
  $cd_atend = $_GET['id'];
}

function load(){
  global $atend, $cd_atend, $qtd_vcna, $qtd_retorno, $qtd_cortesia;

  $cd_atend = str_replace("'", "", trim($_POST["cd_atend"]));
  $qtd_retorno = str_replace("'", "", trim($_POST["qtd_retorno"]));
  $qtd_cortesia = str_replace("'", "", trim($_POST["qtd_cortesia"]));
  
}

function form_valido() {
  global $cd_atend, $qtd_retorno, $qtd_cortesia;

  $valido = false;
  if (!empty($cd_atend) &&
      !empty($qtd_retorno) &&
      !empty($qtd_cortesia)){
        $valido = true;
  }
  
  return $valido;
}

load();


  if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    if (form_valido()){
      $wpdb->update(
        'ATENDIMENTO',
        array(
          'qtd_vcna_retorno'	=> $qtd_retorno,
          'qtd_cortesia'        => $qtd_cortesia
        ),
        array(
          'cd_atend' => $cd_atend
        ),
        array(
          '%d',
          '%d'
        ),
        array(
          '%d'
        )
      );
     
      $sql = "SELECT * FROM ATENDIMENTO WHERE cd_atend = '{$cd_atend}'";
      $atend = $wpdb->get_row($sql);

      echo "<script language='javascript' type='text/javascript'>
      alert('Fechamento salvo com sucesso!');</script>";
      
      //limpa formulario
      $cd_atend = $campanha = $dt_agenda = $enfermeira = "";
      $qtd_vcna = $qtd_retorno = $qtd_cortesia = "";

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

    <title>Agenda - Fechamento</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!--  Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

  </head>

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
	#btn_salvar{
		width: 8vw;
		font-size: 14px;
		border-radius: 6px;
		height: 3vw;
	}
	.formCadCmp{
	    margin-top: -2vw;
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
  </style>

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
    
    <div class="row formCadCmp">
        <div class="col-lg-12 col-sm-12">
          <h3 class="page-header texto_cabeca">Fechamento de Campanha</h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row formCadCmp"><!-- row formulario -->
      <div class="col-lg-12 col-sm-12">
        <form class="form" action="#" method="post">
        	<input type="text" class="hide" name="cd_atend" value="$cd_agenda">
          <div class="row">  
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control" value="<?php echo $campanha; ?>" disabled="true">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Data</label>
              <input type="text" id="dt_agenda" name="dt_agenda" class="form-control" value="<?php echo $dt_atend; ?>" disabled="true">
            </div>
            <div class="form-group col-xs-3">
              <label>Enfermeira(o)</label>
              <input type="text" id="nm_enf" name="nm_enf" class="form-control" value="<?php echo $enfermeira; ?>" disabled="true">
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label>Vacina</label>
              <input type="text" id="nm_vacina" name="nm_vacina" class="form-control" value="<?php echo $nm_vcna; ?>" disabled="true">
            </div>

          </div>

          <div class="row">
          	<div class="form-group col-xs-1 col-xs-offset-1">
              <label>Envio</label>
              <input type="text" id="qtd_vcna" name="qtd_vcna" class="form-control" value="<?php echo $qtd_vcna; ?>" disabled="true">
            </div>

            <div class="form-group col-xs-1">
              <label>Retorno</label>
              <input type="text" id="qtd_retorno" name="qtd_retorno" class="form-control">
            </div>
            <div class="form-group col-xs-1">
              <label>Cortesia</label>
              <input type="text" id="qtd_cortesia" name="qtd_cortesia" class="form-control">
            </div>
          </div>

          <div class="row btns" style="margin-top: 1vw;">
		      <div class="col-xs-2 col-xs-offset-1">
		        <input id="btn_salvar" type="submit" class="button btn btn-danger btn_salvar" value="Salvar">
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
