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
  <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet">

</head>

<style type="text/css">
  .help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #a94442;
  }

  .corpo {
    background-color: WhiteSmoke;
  }

  .texto_cabeca {
    font-size: 25px;
    margin-top: 1vw !important;
    color: dimgray;
  }

  #btn_salvar {
    width: 8vw;
    font-size: 14px;
    border-radius: 6px;
    height: 3vw;
  }

  .formCadCmp {
    margin-top: -2vw;
  }

  .barra4vw {
    height: 4vw !important;
  }

  .cabeca {
    border: none;
    margin-left: -15px;
    width: 103%;
  }

  .link_home {
    margin-left: 2vw;
    text-decoration: none;
    color: #353b48;
    font-size: 18px;
    font-weight: bold;
  }

  .fontMenu {
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
    <!-- <span><a class = "" data-toggle = "modal" data-target = "#modalBtnCad">Cadastrar</a></span> -->
    <div>
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
                <a href="#" class="dropdown-toggle fontMenu" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Cadastrar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!--   <li><a href   = "http://vacinarte-admin.com.br/cadastrar-pf/">Pessoa física</a></li> -->
                  <li><a href="<?php echo $home; ?>/cadastrar-pj/">Pessoa jurídica</a></li>
                  <li><a href="<?php echo $home; ?>/campanha/">Campanha</a></li>
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" style="text-decoration: none;" class="dropdown-toggle fontMenu" data-toggle="dropdown"
                  role="button" aria-haspopup="true" aria-expanded="false">Listar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!--   <li><a href = "http://vacinarte-admin.com.br/listar-pf/">Clientes PF</a></li> -->
                  <li><a href="<?php echo $home; ?>/listar-pj/">Pessoa jurídica</a></li>
                  <li><a href="<?php echo $home; ?>/listar-campanhas/">Campanhas</a></li>
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav">
              <!--   <li><a style = "text-decoration: none;" href  = "#" data-toggle = "modal" data-target = "#modalBtnCad">Cadastrar</a></li> -->
              <li><a style="text-decoration: none;" class="fontMenu"
                  href="<?php echo $home; ?>/listar-agendamento/">Agenda</a></li>
              <li><a style="text-decoration: none;" class="fontMenu" href="https://www.vacinarte.com.br/">Site
                  Vacinarte</a></li>
              <li class="page_item page-item-13 fontMenu"><a style="text-decoration: none;"
                  href="<?php echo $home; ?>/?sair=true">Sair</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>

  </div>

  <div class="container">
    <!-- container principal-->

    <div class="row formCadCmp">
      <div class="col-lg-12 col-sm-12">
        <h3 class="page-header texto_cabeca">Fechamento de Agenda</h3>
      </div>
    </div><!-- fecha div row -->

    <center><span class="help-block">
        <h4><?php echo $msg_err; ?></h4>
      </span></center>

    <div class="row formCadCmp">
      <!-- row formulario -->
      <div class="col-lg-12 col-sm-12">
        <form class="form" action="#" method="post">
          <input type="text" class="hide" name="cd_atend" value="<?php echo $cd_atend; ?>">
          <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Campanha</label>
              <input type="text" id="campanha" name="campanha" class="form-control"
                value="<?php echo $agenda->NM_CMP; ?>" disabled="true">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Data</label>
              <input type="text" id="dt_agenda" name="dt_agenda" class="form-control"
                value="<?php echo $agenda->DT_ATEND; ?>" disabled="true">
            </div>
            <div class="form-group col-xs-3">
              <label>Enfermeira(o)</label>
              <input type="text" id="nm_enf" name="nm_enf" class="form-control"
                value="<?php echo $agenda->NM_ENFERMEIRO; ?>" disabled="true">
            </div>
          </div>


          <!-- Inicio vacina -->
          <?php foreach($agendas as $agenda_item) {?>
            <div class="row">
              <div class="form-group col-xs-3 col-xs-offset-1">
                <label>Vacina</label>
                <input type="text" id="nm_vacina" name="nm_vacina" class="form-control"
                  value="<?php echo $agenda_item->NM_REG; ?>" disabled="true">
              </div>

            </div>

            <div class="row">
              <div class="form-group col-xs-1 col-xs-offset-1">
                <label>Envio</label>
                <input type="text" id="qtd_vcna" name="qtd_vcna" class="form-control"
                  value="<?php echo $agenda_item->QTD_VCNA_ENVIO; ?>" disabled="true">
              </div>
              <div class="form-group col-xs-1">
                <label>Retorno</label>
                <input type="text" id="<?php echo $agenda_item->CD_VCL_VCNA_ATEND . '_qtd_vcna_retorno'; ?>" 
                  name="<?php echo $agenda_item->CD_VCL_VCNA_ATEND . '_qtd_vcna_retorno'; ?>" class="form-control"
                  value="<?php echo $agenda_item->qtd_vcna_retorno; ?>">
              </div>
              <div class="form-group col-xs-1">
                <label>Cortesia</label>
                <input type="text" id="<?php echo $agenda_item->CD_VCL_VCNA_ATEND . '_qtd_cortesia'; ?>" 
                  name="<?php echo $agenda_item->CD_VCL_VCNA_ATEND . '_qtd_cortesia'; ?>" class="form-control"
                  value="<?php echo $agenda_item->qtd_cortesia; ?>">
              </div>
            </div>
          <?php } ?>

          <!-- Fim vacina -->


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