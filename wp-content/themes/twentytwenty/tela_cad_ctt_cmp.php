<?php /* Template Name: TelaCadCttCmp */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url(); 

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cmp = $_GET['id_cmp'];

  $sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_cmp}'";
  $campanha = $wpdb->get_row($sql);
  $id_cli = $campanha->cd_cli;

  $sql = "SELECT GROUP_CONCAT(DISTINCT cd_ctt
  ORDER BY cd_ctt
  SEPARATOR ',') as cd_ctts FROM `VCL_CTT_CMP` where cd_cmp='{$id_cmp}' and `VCL_CTT_CMP`.ativo=1";

  $campanha_ctts = $wpdb->get_row($sql);
  $selecionados = $campanha_ctts->cd_ctts;
}

function load(){
  global $selecionados, $id_cli, $id_cmp;

  $selecionados = str_replace("'", "", trim($_POST["selecionados"]));
  $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
  $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));
}

function form_valido() {
  global $selecionados, $id_cmp, $id_cli;

  //echo "<script language='javascript' type='text/javascript'>
  //alert('{$selecionados} , {$id_cmp} , {$id_cli}');</script>";

  $valido = false;
  if (!empty($selecionados) &&
      !empty($id_cmp) &&
      !empty($id_cli)){
        $valido = true;
  }

  return $valido;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){

    $arr_selecionados = explode(",", $selecionados);    

    $sucesso = true;
    $wpdb->query ("START TRANSACTION");
    foreach ( $arr_selecionados as $arr_selecionado ) 
    {
      if ($arr_selecionado > 0) {

        $sql = "SELECT cd_vcl_ctt_cmp FROM VCL_CTT_CMP WHERE cd_cmp = '{$id_cmp}' and cd_ctt = '{$arr_selecionado}'";
        $vlc_ctt_cmp = $wpdb->get_row($sql);
        $id_vcl = $vlc_ctt_cmp->cd_vcl_ctt_cmp;
        if ($id_vcl > 0){
          $linhas_afetadas = $wpdb->update(
            'VCL_CTT_CMP',
            array(
              'ativo'  => 1
            ),
            array( 'cd_vcl_ctt_cmp' =>  $id_vcl),
            array(
              '%d'
            )
          );
          $id_vcl = ($linhas_afetadas > 0);
        } else {
          $vinculo = $wpdb->insert(
            'VCL_CTT_CMP',
            array(
              'cd_cmp' => $id_cmp,
              'cd_ctt' => $arr_selecionado
            ),
            array(
              '%d',
              '%d'
            )
          );
          $id_vcl = $wpdb->insert_id;
        }

        if ($id_vcl == false){
          $sucesso = false;
          break;
        }
      }
    }

    if($sucesso == true){
      $wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Contato salvo com sucesso!');</script>";
    }else{
     $wpdb->query("ROLLBACK");

      echo "<script language='javascript' type='text/javascript'>
          alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
    }  
  } else {
    $msg_err = "Ops! Faltou selecionar algum contato";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >

   
    <title>Contatos do Cliente desta Campanha</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- DataTable -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></script>

  </head>
  <style>
    .corpo{
      background-color: WhiteSmoke;
    }
    .texto_cabeca{
      font-size: 25px;
      margin-top: 2vw !important;
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
    #tab_lista_ctt_info, #tab_lista_ctt_paginate{
      font-size: 15px;
    }
    .dataTables_empty{
      text-align: center;
      font-weight: bold;
    }
    #tab_lista_ctt_filter{
      width: 30%;
      margin-right: 2vw;
    }
    #tab_lista_ctt_length{
      width: 30%;
      margin-left: 1vw;
    }
    #tab_lista_ctt_filter.label#text{
      text-align: left;
    }
    input{
      height: 2vw;
    } 
    #btn_salvar{
      width: 8vw;
      font-size: 14px;
      border-radius: 6px;
      height: 3.5vw;
      margin-top: 1vw;
      margin-right: 1.5vw;
    }
    #btn_novo{
      width: 8vw;
      font-size: 14px;
      border-radius: 6px;
      height: 3.5vw;
      margin-top: 1vw;
    }
    
  </style>
  <body class="corpo">
  
    <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}/';</script>";
    }?>
  
  <div class="container-fluid barra4vw">
    <div >
        <nav class="navbar navbar-default cabeca barra4vw">
          <div class="container-fluid barra4vw" style="background-color: Gainsboro;">
            <!-- Brand and toggle get grouped for better mobile display -->
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar barra4vw">
              <ul class="nav navbar-nav" style="margin-top: 1vw;">
                <a class="link_home" href="<?php echo $home; ?>/home"><span>Vacinarte</span></a>
              </ul>

              <ul class="nav navbar-nav" style="margin-left: 48vw;">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle fontMenu" data-toggle="dropdown" 
                    role="button" aria-haspopup="true" 
                    aria-expanded="false">Cadastrar <span class="caret"></span></a>
                  <ul class="dropdown-menu">
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
                    <li><a href="<?php echo $home; ?>/listar-pj/">Pessoa jurídica</a></li>
                    <li><a href="<?php echo $home; ?>/listar-campanhas/">Campanhas</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav">
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
        <div class="col-xs-9">
          <h3 class="page-header texto_cabeca">Contatos do Cliente desta Campanha</h3>
        </div>
        <div class="col-xs-1 col-xs-offset-1" style="align:center">
          <form action="#" method="post">
          <div class="hide">
              <input type="text" id="selecionados" name="selecionados" class="form-control" value="<?php echo $selecionados; ?>"/>
              <input type="text" id="id_cmp" name="id_cmp" class="form-control" value="<?php echo $id_cmp; ?>"/>
              <input type="text" id="id_cli" name="id_cli" class="form-control" value="<?php echo $id_cli; ?>"/>
            </div>
            <input id="btn_salvar" class="btn btn-danger pull-right" type="submit"  value="Salvar" />
          </form>
        </div>
        <div class="col-xs-1">
          <input id="btn_novo" class="btn btn-danger pull-right" value="Novo" 
          onclick="location.href='<?php echo $home; ?>/cadastrar-contato/?id_cmp=<?php echo $id_cmp; ?>';"/>
        </div>
    </div><!-- fecha div row -->

    <div class="row">
        <div class="col-xs-10">
        <p>Marque os contatos do cliente que deseja vincular a campanha</p>
        </div>
    </div>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-12">
        <div class="row"><!--div row painel de consulta -->
          <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active">
            <div class="col-lg-12 col-xs-12">
              <div class="row paineldeconsulta">
                <div class="col-lg-12 col-xs-12"><!-- posiciona painel -->
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table table-striped" id="tab_ctt_cmp">
                        <thead>
                          <tr>
                            <th>Selecionar</th>
                            <th>Nome do contato </th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Observação</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          $contatos = $wpdb->get_results( 
                            "
                            SELECT 
                            (select count(cd_vcl_ctt_cmp) from `VCL_CTT_CMP` where `VCL_CTT_CMP`.cd_ctt=CONTATO.cd_ctt and `VCL_CTT_CMP`.cd_cmp={$id_cmp}) as total,
                            CONTATO.`cd_ctt`, `nm_ctt`, `tel_pri`, `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
                            FROM `CONTATO` as CONTATO, 
                            `VCL_CONTATO` as VCL_CONTATO 
                            WHERE 
                            CONTATO.cd_ctt=VCL_CONTATO.cd_ctt and 
                            VCL_CONTATO.cd_cli={$id_cli} and status=1 order by `nm_ctt`
                            "
                          );
                          
                          // if (count($contatos)<=0){
                          //   echo "<script language='javascript' type='text/javascript'>
                          //   window.location.href='{$home}/cadastrar-endereco/?id={$id_cli}';</script>";
                          // }


                          foreach ( $contatos as $contato ) 
                          {
                        ?>
                          <tr>
                            <td>
                              <a class="sel <?php if ($contato->total > 0){ echo 'hide'; }?>" id="sel_<?php echo $contato->cd_ctt; ?>" onclick="montaArr('<?php echo $contato->cd_ctt; ?>', 'sel')";>
                                <i class="material-icons" style="padding-left: 5px; color: DimGray; cursor: pointer;">done</i>
                              </a>
                              <a class="done <?php if ($contato->total <= 0){ echo 'hide'; }?>" id="done_<?php echo $contato->cd_ctt; ?>" onclick="montaArr('<?php echo $contato->cd_ctt; ?>', 'done')">
                                <i class="material-icons" style="padding-left: 5px; color: Lime; cursor: pointer;">done_all</i>
                              </a>
                            </td>
                            <td><?php echo $contato->nm_ctt ?></td>
                            <td><?php echo $contato->tel_pri ?></td>
                            <td><?php echo $contato->email ?></td>
                            <td><?php echo $contato->obs_ctt ?></td>
                          </tr>
                          <?php
                            }
                          ?>

                        </tbody>
                      </table>
                    </div><!-- fecha panel corpo -->
                  </div><!-- fecha panel default -->
                </div><!-- fecha col lg 12 -->
              </div><!-- fecha row paineldemequipe -->
          </div><!-- fecha col lg 12 -->
          </div><!-- fecha div painel pdequipe -->
        </div>
        </div>
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->
  </div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.dataTables.min.js"></script>
    
    <script>
    var arr = [<?php if (!empty($selecionados)) echo "'" . str_replace(",", "','", $selecionados) . "'"; else echo "''"; ?>];

      //datatable
	$(document).ready(function(){
    $('#tab_ctt_cmp').DataTable({
      "ordering": true,
	    "paginate": true,
      "oLanguage": {
	            "sProcessing": "Processando...",
	            "sLengthMenu": "Exibir _MENU_ registros",
	            "sZeroRecords": "N&atilde;o foram encontrados resultados.",
	            "sInfo": "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
	            "sInfoEmpty": "Mostrando de 0 at&eacute; 0 de um total de 0 registros",
	            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
	            "sInfoPostFix": "",
	            "sSearch": "Procurar:",
	            "sUrl": "",
	            "oPaginate": {
	                "sFirst": "Primeiro",
	                "sPrevious": "Anterior",
	                "sNext": "Pr&oacute;ximo",
	                "sLast": "&Uacute;ltimo"
	            }
	        }
    });
    $('#tab_lista_ctt_filter').addClass('pull-right');
    $('#tab_lista_ctt_paginate').addClass('pull-right');
  });


  function montaArr(id, origem){
    if(origem == 'sel'){
      arr.push(id);
      $('#sel_'+id).addClass('hide');
      $('#done_'+id).removeClass('hide');
    }else{
      arr.splice(arr.indexOf(id), 1);
      $('#sel_'+id).removeClass('hide');
      $('#done_'+id).addClass('hide');
    }
    console.log(arr);
    $('#selecionados').val(arr);
  }
    </script>

<script type="text/javascript">
      window.onload = function() { 
        if(performance.navigation.type == 2){
          location.reload(true);
        }
      };
      window.onunload = function(){};
    </script>
  </body>
  </html>
