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
          <form class="form" action="#" method="post">
            <div class="row">  
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Campanha</label>
                <input type="text" id="nm_cmp" name="nm_cmp" class="form-control" 
                value="<?php echo $cmp->nm_cmp; ?>" required />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-4 col-xs-offset-3">
                <label style="font-size: 14px;">Empresa (com cadastro sem pendências)</label>
                <select class="selectpicker form-control" id="cd_cli" name="cd_cli"
                value="<?php echo $cmp->nm_fant; ?>" required >
                <option value=""></option>
                <?php
                  $clientes = $wpdb->get_results( $wpdb->prepare( $listar_campanhas_por_nm_fant ) );
                  
                  foreach ( $clientes as $cliente ) 
                  {
                ?>
                  <option value='<?php echo $cliente->cd_cli ?>' <?php if($cmp->cd_cli ==  $cliente->cd_cli) echo "selected" ; ?>><?php echo $cliente->nm_fant ?></option>
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
                value="<?php echo $cmp->nm_tp_srv; ?>" required >
                  <option value=""></option>
                  <option value="1" <?php if($cmp->nm_tp_srv ==  'Gesto') echo "selected" ; ?>>Gesto</option>
                  <option value="2" <?php if($cmp->nm_tp_srv ==  'Completo') echo "selected" ; ?>>Completo</option>
                </select>
              </div>

              <div class="form-group col-xs-2">
                <label style="font-size: 14px;">Local do serviço</label>
                <select class="selectpicker form-control" id="local_srv" name="local_srv"
                value="<?php echo $cmp->nm_local_srv; ?>" required >
                  <option value=""></option>
                  <option value="1" <?php if($cmp->nm_local_srv ==  'In Loco') echo "selected" ; ?>>In Loco</option>
                  <option value="2" <?php if($cmp->nm_local_srv ==  'Balcão') echo "selected" ; ?>>Balcão</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-xs-2 col-xs-offset-3">
                <label style="font-size: 14px;">Data de início</label>
                <input type="text" id="dt_ini" name="dt_ini" class="form-control"
                value="<?php echo $cmp->dt_ini; ?>"/>
              </div>

              <div class="form-group col-xs-2">
                <label style="font-size: 14px;">Data de término</label>
                <input type="text" id="dt_fim" name="dt_fim" class="form-control"
                value="<?php echo $cmp->dt_fim; ?>"/>
              </div>
            </div>

            <div class="row btns" style="margin-top: 1vw;">
              <div class="col-xs-1 col-xs-offset-3">
                <input id="btn_salvar" type="submit" class="button btn btn-danger btn_geral" value="Salvar"/>
              </div>
              <div class="col-xs-1" style="margin-left: 2vw;">
                <input id="btn_end" type="button" class="btn btn-danger btn_geral btn_endereco" onclick="location.href='<?php echo $home; ?>/listar-enderecos/?id_cmp=<?php echo $id_cmp; ?>';" 
                value="Endereços" <?php if ($id_cmp <=0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
              </div> 
              <div class="col-xs-1">
                <input id="btn_ctt" type="button" class="btn btn-danger btn_geral btn_contato" onclick="location.href='<?php echo $home; ?>/listar-contatos/?id_cmp=<?php echo $id_cmp; ?>';" 
                value="Contatos" <?php if ($id_cmp <=0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
              </div> 
              <div class="col-xs-1">
                <input id="btn_vac" class="btn btn-danger" type="button" onclick="location.href='<?php echo $home; ?>/cadastrar-vacina-campanha/?id=<?php echo $id_cmp; ?>';" 
                value="Vacinas" <?php if ($id_cmp <= 0) { echo "disabled='true' style='background-color:slateGray; border: none;'"; } ?>/>
              </div>  
              
            </div>

          </form><!-- fecha form -->
        </div><!-- fecha col 12 -->
      </div><!-- fecha row txtbox -->
      
    </div><!-- fecha container principal -->  

	  <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#dt_ini").mask("99/99/9999");
      });
      $(document).ready(function(){	
        $("#dt_fim").mask("99/99/9999");
      });
    </script>
  </body>
  </html>
  
