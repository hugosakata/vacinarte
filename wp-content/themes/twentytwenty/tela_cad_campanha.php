<?php /* Template Name: TelaCadCampanha */

global $wpdb;
$home = get_home_url();
?>

<?php

$id_cmp = 0;
$campanha = $cd_cli = $tp_srv = $local_srv = "";

if(isset($_GET['id'])){
  $id_cmp = $_GET['id'];
}

function load(){
  global $campanha, $cd_cli, $tp_srv, $local_srv;

  $campanha = str_replace("'", "", trim($_POST["campanha"]));
  $cd_cli = str_replace("'", "", trim($_POST["cd_cli"]));
  $tp_srv = str_replace("'", "", trim($_POST["tp_srv"]));
  $local_srv = str_replace("'", "", trim($_POST["local_srv"]));
  // $data_ini = str_replace("'", "", trim($_POST["dt_ini"]));
  // $data_fim = str_replace("'", "", trim($_POST["dt_fim"]));

}

load();

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
        margin-top: 1vw !important;
        color: dimgray;
      }
      #btn_prox{
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
  </head>
  
  <body class="corpo">
  
    <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='$home/';</script>";
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
                  <a class="link_home" href="<?php echo $home; ?>/home"><span>Vacinarte</span></a>
                </ul>

                <ul class="nav navbar-nav" style="margin-left: 48vw;">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle fontMenu" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" 
                      aria-expanded="false">Cadastrar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <!-- <li><a href="http://vacinarte-admin.com.br/cadastrar-pf/">Pessoa física</a></li> -->
                      <li><a href="<?php echo $home; ?>/cadastrar-pj/">Pessoa jurídica</a></li>
                      <li><a href="<?php echo $home; ?>/campanha/">Campanha</a></li>
                    </ul>
                  </li>
                </ul>
                
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" style="text-decoration: none;" class="dropdown-toggle fontMenu" 
                      data-toggle="dropdown" role="button" aria-haspopup="true" 
                      aria-expanded="false">Listar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <!-- <li><a href="<?php //echo $home; ?>/listar-pf/">Clientes PF</a></li> -->
                      <li><a href="<?php echo $home; ?>/listar-pj/">Pessoa jurídica</a></li>
                      <li><a href="<?php echo $home; ?>/listar-campanhas/">Campanhas</a></li>
                    </ul>
                  </li>
                </ul>

                <ul class="nav navbar-nav">
                  <!-- <li><a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#modalBtnCad">Cadastrar</a></li> -->
                  <li><a style="text-decoration: none;" class="fontMenu" href="<?php echo $home; ?>/listar-agendamento/">Agenda</a></li>
                  <li><a style="text-decoration: none;" class="fontMenu" href="https://www.vacinarte.com.br/">Site Vacinarte</a></li>
                  <li class="page_item page-item-13 fontMenu"><a style="text-decoration: none;" href="<?php echo $home; ?>/?sair=true">Sair</a></li>
                </ul>            
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
        </div>

    </div>

    <div class="container"><!-- container principal-->
      
      <div class="row formCadCmp">
          <div class="col-lg-12 col-xs-12">
            <h3 class="page-header texto_cabeca">Cadastro de Campanha</h3>
          </div>
      </div><!-- fecha div row -->

      <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

      <div class="row formCadCmp"><!-- row formulario -->
        <div class="col-lg-12 col-xs-12">
          <form class="form" action="<?php echo $home; ?>/cadastrar-campanha-form/" method="post">
            <div class="row">  
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Campanha</label>
                <input type="text" id="campanha" name="campanha" class="form-control" 
                value="<?php echo $campanha; ?>" required />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Empresa</label>
                <select class="selectpicker form-control" id="cd_cli" name="cd_cli"
                value="<?php echo $cd_cli; ?>" required >
                <option value=""></option>
                <?php
                  $clientes = $wpdb->get_results( 
                    "
                    SELECT cli.cd_cli, nm_rz_soc, nm_fant 
                    FROM CLIENTES cli
                    WHERE cd_tp_cli=2 and 
                    (select count(cd_vcl_end) from VCL_ENDERECO vlc where vlc.cd_cli=cli.cd_cli) > 0 and
                    (select count(cd_vcl_ctt) from VCL_CONTATO vlc where vlc.cd_cli=cli.cd_cli) > 0                            
                    order by nm_fant
                    "
                  );
                  
                  foreach ( $clientes as $cliente ) 
                  {
                ?>
                  <option value='<?php echo $cliente->cd_cli ?>'><?php echo $cliente->nm_fant ?></option>
              <?php
                }
                ?>
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-xs-2 col-xs-offset-3">
                <label style="font-size: 14px;">Tipo de serviço</label>
                <select class="selectpicker form-control" id="tp_srv" name="tp_srv"
                value="<?php echo $tp_srv; ?>" required >
                  <option value=""></option>
                  <option value="1">Gesto</option>
                  <option value="2">Completo</option>
                </select>
              </div>

              <div class="form-group col-xs-2">
                <label style="font-size: 14px;">Local do serviço</label>
                <select class="selectpicker form-control" id="local_srv" name="local_srv"
                value="<?php echo $local_srv; ?>" required >
                  <option value=""></option>
                  <option value="1">In Loco</option>
                  <option value="2">Balcão</option>
                </select>
              </div>
            </div>

            <div class="row btns" style="margin-top: 1vw;">
              <div class="col-xs-2 col-xs-offset-3">
                <input id="btn_prox" type="submit" class="button btn btn-danger btn_salvar" value="Próxima">
              </div>
              <div class="col-xs-2 col-xs-offset-1 hide">
                <input  type="button" onclick="location.href='<?php echo $home; ?>/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
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
