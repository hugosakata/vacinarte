<?php /* Template Name: CadastroContato */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url();
?>

<?php

$nm_contato = $tel_pri = $email = $obs_ctt = $id_cli = $id_cmp = $id_ctt = "";
$id_ctt = $id_vcl = 0;

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cli = $_GET['id'];
  $id_cmp = $_GET['id_cmp'];
  $id_ctt = $_GET['id_ctt'];
  $acao = $_GET['acao'];

  $sql = "SELECT * FROM CONTATO WHERE cd_ctt = '{$id_ctt}'";
  $contato = $wpdb->get_row($sql);
}

 function load(){
    global $nm_contato, $tel_pri, $email, $obs_ctt, $acao, $id_ctt, $id_cli, $id_cmp;

    $acao = str_replace("'", "", trim($_POST["acao"]));
    $id_ctt = str_replace("'", "", trim($_POST["id_ctt"]));
    $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
    $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));

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

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    if ($acao == "edit"){
      $linhas_afetadas = $wpdb->update(
        'CONTATO',
        array(
          //'cd_cli'  => $id_cli,
          'nm_ctt'  => $nm_contato,
          'tel_pri' => $tel_pri,
          'email'   => $email,
          'obs_ctt' => $obs_ctt
        ),
        array( 'cd_ctt' =>  $id_ctt),
        array(
          //'%d',
          '%s',
          '%s',
          '%s',
          '%s'
        ),
        array( '%d' )
      );
      if ($linhas_afetadas > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Contato salvo com sucesso!');</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
      }
    } else {

      $wpdb->query ("START TRANSACTION");
      $wpdb->insert(
        'CONTATO',
        array(
          //'cd_cli'  => $id_cli,
          'nm_ctt'  => $nm_contato,
          'tel_pri' => $tel_pri,
          'email'   => $email,
          'obs_ctt' => $obs_ctt
        ),
        array(
          //'%d',
          '%s',
          '%s',
          '%s',
          '%s'
        )
      );
      $id_ctt = $wpdb->insert_id;

      if ($id_cli > 0){
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
      } else if ($id_cmp>0) {
        $wpdb->insert(
          'VCL_CTT_CMP',
          array(
            'cd_cmp'      => $id_cmp,
            'cd_ctt'      => $id_ctt        
          ),
          array(
            '%s',
            '%s'
          )
        );
        $id_vcl = $wpdb->insert_id;
      }

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
    <!-- Styles -->
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
      #btn_salvar, #btn_end{
        width: 8vw;
        font-size: 14px;
        border-radius: 6px;
        height: 3vw;
      }
      #btn_end{
        padding-left: 10px;
        margin-left: 2vw;
      }
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
          <div class="col-lg-12">
            <h3 class="page-header texto_cabeca">Cadastro de Contato</h3>
          </div>
      </div><!-- fecha div row -->

      <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

      <div class="row txtbox"><!-- row formulario -->
        <div class="col-lg-12 col-xs-8">
          <form action="#" method="post">
            
            <div class="hide">
                <input type="text" id="acao" name="acao" class="form-control"
                    value="<?php echo $acao; ?>"/>
                <input type="text" id="id_cli" name="id_cli" class="form-control"
                    value="<?php echo $id_cli; ?>"/>
                <input type="text" id="id_cmp" name="id_cmp" class="form-control"
                    value="<?php echo $id_cmp; ?>"/>
                <input type="text" id="id_ctt" name="id_ctt" class="form-control"
                    value="<?php echo $id_ctt; ?>"/>
              </div>

            <div class="row">
              <div class="form-group col-xs-5 col-xs-offset-2">
                <label style="font-size: 14px;">Nome do contato*</label>
                <input type="text" name="nm_contato" class="form-control" placeholder="Nome do contato"
                value="<?php echo $contato->nm_ctt; ?>">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-5 col-xs-offset-2">
                <label style="font-size: 14px;">Telefone*</label>
                <input type="text" id="tel_pri" name="tel_pri" class="form-control" placeholder="telefone principal"
                value="<?php echo $contato->tel_pri; ?>">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-5 col-xs-offset-2">
                <label style="font-size: 14px;">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" 
                onblur="IsEmail(this.value);"
                value="<?php echo $contato->email; ?>">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-5 col-xs-offset-2">
                <label style="font-size: 14px;">Observação</label>
                <input type="text" name="obs_ctt" class="form-control" placeholder="Observações gerais"
                value="<?php echo $contato->obs_ctt; ?>">
              </div>
            </div>
            
            <div class="row btns">
              <div class="col-xs-1 col-xs-offset-2">
                <input id="btn_salvar" type="submit" class="button btn btn-danger btn_geral" value="Salvar">
              </div>
              <div class="col-xs-1">
                <input id="btn_end" class="btn btn-danger" type="button" onclick="location.href='<?php echo $home; ?>/listar-enderecos/?id=<?php echo $id_cli; ?>';" 
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
