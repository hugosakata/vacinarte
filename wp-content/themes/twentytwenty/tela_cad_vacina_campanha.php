<?php /* Template Name: TelaCadVacinaCampanha */

global $wpdb;
$home = get_home_url(); 
?>

<?php

$id_vcna_cmp = 0;
$cd_cmp = 0;
$cd_vcna = $qtd_vcna = $vlr_vcna = $vcna = $acao = "";

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $cd_cmp = $_GET['id'];

  $sql = "
    SELECT * FROM `VACINA`, `VCL_VCNA_CMP`
    WHERE VCL_VCNA_CMP.cd_vcna=VACINA.cd_vcna AND
    VCL_VCNA_CMP.cd_cmp= '{$cd_cmp}'";
  $vacina = $wpdb->get_row($sql);

  if (null !== $vacina)
    $acao = "edit";
}

function load(){
  global $cd_vcna, $qtd_vcna, $vlr_vcna, $vcna, $cd_cmp, $acao;

  $acao = str_replace("'", "", trim($_POST["acao"]));
  $cd_vcna = str_replace("'", "", trim($_POST["cd_vcna"]));
  $qtd_vcna = str_replace("'", "", trim($_POST["qtd_vcna"]));
  $vlr_vcna = str_replace("'", "", trim($_POST["vlr_vcna"]));
  
}

function form_valido() {
  global $cd_vcna, $nm_vcna, $qtd_vcna, $vlr_vcna, $cd_cmp;

  $valido = false;
  if (!empty($cd_cmp) &&
      !empty($cd_vcna) &&
      !empty($qtd_vcna) &&
      !empty($vlr_vcna)){
        $valido = true;
  }
  
  return $valido;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  if (form_valido()){
    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'VCL_VCNA_CMP',
        array(
          'cd_cmp'    => $cd_cmp,
          'cd_vcna'   => $cd_vcna,
          'qtd_vcna'  => $qtd_vcna,
          'vlr_vcna'  => $vlr_vcna
        ),
        array( 'cd_cmp' =>  $cd_cmp),
        array(
          '%d',
          '%d',
          '%d',
          '%f'
        )
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Vacina salva com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {
      $wpdb->insert(
        'VCL_VCNA_CMP',
        array(
          'cd_cmp'    => $cd_cmp,
          'cd_vcna'   => $cd_vcna,
          'qtd_vcna'  => $qtd_vcna,
          'vlr_vcna'  => $vlr_vcna
        ),
        array(
          '%d',
          '%d',
          '%d',
          '%f'
        )
      );
      $id_vcna_cmp = $wpdb->insert_id;
      $sql = "SELECT * FROM VCL_VCNA_CMP WHERE cd_vcna = '{$id_vcna_cmp}'";
      $vcna = $wpdb->get_row($sql);
      if ($id_vcna_cmp > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Vacina salva com sucesso!');</script>";
      } else {
        $msg_err = "Ops! Algo deu errado, confirme os dados preenchidos e tente novamente";
      }
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

    <title>Vacina - Cadastro</title>
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
      #btn_salvar{
        width: 8vw;
        font-size: 14px;
        border-radius: 6px;
        margin-left: 10px;
      }
      .formCadVacCmp{
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
    .aviso{
      font-size: 1vw;
      color: maroon;
    }
    </style>

    
  </head>
  <body class="corpo">

    <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/';</script>";
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
                      <!-- <li><a href="http://vacinarte-admin.com.br/listar-pf/">Clientes PF</a></li> -->
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
    
      <div class="row">
          <div class="col-lg-12 col-xs-12">
            <h3 class="page-header texto_cabeca">Vacina</h3>
          </div>
      </div><!-- fecha div row -->

      <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

      <div class="row txtbox"><!-- row formulario -->
        <form class="form" action="#" method="post">
          <div class="hide">
              <input type="text" id="acao" name="acao" class="form-control"
                  value="<?php echo $acao; ?>"/>
          </div>
          <div class="col-lg-12 col-xs-12">
            
            <div class="row formCadVacCmp">
                <div class="form-group col-xs-3 col-xs-offset-2">
                    <label style="font-size: 14px;">Vacina</label>
                      <select class="selectpicker form-control" id="cd_vcna" name="cd_vcna"
                      value="<?php echo $vacina->nm_reg; ?>">
                        <option value=""></option>
                        <?php
                          $vacinas = $wpdb->get_results( 
                            "
                            SELECT
                              a.cd_vcna,
                              a.nm_reg,
                              a.cd_fbcnte_vcna,
                              b.nm_fbcnte_vcna
                            FROM
                              VACINA a
                              LEFT JOIN
                              FBCNTE_VCNA b on a.cd_fbcnte_vcna = b.cd_fbcnte_vcna
                            
                            "
                          );
                          
                          foreach ( $vacinas as $vacinas ) 
                          {
                        ?>
                        <option value=<?php echo $vacinas->cd_vcna ?>; <?php if($vacinas->cd_vcna ==  $vacina->cd_vcna) echo "selected" ; ?>><?php echo $vacinas->nm_reg . " - " . $vacinas->nm_fbcnte_vcna ?></option>
                        <?php
                          }
                        ?>
                      </select>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group col-xs-1 col-xs-offset-2">
                  <label style="font-size: 14px;">Qtde</label>
                  <input type="text" id="qtd_vcna" name="qtd_vcna" class="form-control"
                  onblur="mostraAviso();" value="<?php echo $vacina->qtd_vcna; ?>">
                </div>
              
                <div class="form-group col-xs-2">
                  <label style="font-size: 14px;">Valor Unit</label>
                  <input type="text" id="vlr_vcna" name="vlr_vcna" class="form-control"
                  value="<?php echo $vacina->vlr_vcna; ?>">
                </div>

                <div class="form-group col-xs-5" style="margin-top: 30px;">
                  <span id="avisoPonto" class="aviso">Para colocar centavos, usar ponto ( . ) ao invés de vírgula ( , ). Ex.: 1000.99</span>
                </div>
              </div>
            </div>
            <div class="row btns">
              <div class="col-xs-1 col-xs-offset-2">
                <input id="btn_salvar" type="submit" class="button btn btn-danger btn_salvar" value="Salvar">
              </div>
                
            </div>

          </div><!-- fecha col 12 -->
        </form><!-- fecha form -->
      </div><!-- fecha row txtbox -->

        <!-- Modal -->
        <div id="modalBtnCad" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cadastrar</h4>
              </div>
              <div class="modal-body">
                <div class="col-xs-2" style="align:center">
                  <input id="btn_salvar" class="pull-right" type="button" onclick="location.href='<?php echo $home; ?>/cadastrar-pj/';" 
                  value="Novo"/>
                </div>
                <div class="col-xs-2" style="align:center">
                  <input id="btn_salvar" class="pull-right" type="button" onclick="location.href='<?php echo $home; ?>/listar-campanhas/';" 
                  value="Novo"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>


    
</div><!-- fecha container principal -->  

	  <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      function mostraAviso(){
        $('#avisoPonto').removeClass('hide');
      }
    </script>
   
  </body>
</html>
