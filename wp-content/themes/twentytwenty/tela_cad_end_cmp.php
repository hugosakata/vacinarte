<?php /* Template Name: TelaCadEndCmp */

global $wpdb;
$home = get_home_url(); 

load();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id_cmp = $_GET['id_cmp'];

  $sql = "SELECT * FROM CAMPANHA WHERE cd_cmp = '{$id_cmp}'";
  $campanha = $wpdb->get_row($sql);
  $id_cli = $campanha->cd_cmp;
}

function load(){
  global $selecionados, $id_cli, $id_cmp;

  $selecionados = str_replace("'", "", trim($_POST["selecionados"]));
  $id_cli = str_replace("'", "", trim($_POST["id_cli"]));
  $id_cmp = str_replace("'", "", trim($_POST["id_cmp"]));
}

function form_valido() {
  global $selecionados, $id_cmp, $id_cli;

  echo "<script language='javascript' type='text/javascript'>
  alert('{$selecionados} , {$id_cmp} , {$id_cli}');</script>";

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
    //$wpdb->query ("START TRANSACTION");
    foreach ( $arr_selecionados as $arr_selecionado ) 
    {
      // $vinculo = $wpdb->insert(
      //   'VCL_END_CMP',
      //   array(
      //     'cd_cmp' => $id_cmp,
      //     'cd_end'   => $arr_selecionado
      //   ),
      //   array(
      //     '%d',
      //     '%d'
      //   )
      // );
      // $id_vcl = $wpdb->insert_id;

      echo "<script language='javascript' type='text/javascript'>
      alert('{$id_cmp}, {$arr_selecionado}');</script>";

      if ($id_vcl == false){
        $sucesso = false;
        break;
      }
    }

    if($sucesso == true){
      //$wpdb->query("COMMIT");

      echo "<script language='javascript' type='text/javascript'>
      alert('Endereço salvo com sucesso!');</script>";
    }else{
     // $wpdb->query("ROLLBACK");

      echo "<script language='javascript' type='text/javascript'>
          alert('Ops! Algo deu errado, tente novamente mais tarde!');</script>";
    }  
  } else {
    $msg_err = "Ops! Faltou selecionar algum endereço";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >

   
    <title>Endereços da Campanha</title>
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
    #tab_lista_end_info, #tab_lista_end_paginate{
      font-size: 15px;
    }
    .dataTables_empty{
      text-align: center;
      font-weight: bold;
    }
    #tab_lista_end_filter{
      width: 30%;
      margin-right: 2vw;
    }
    #tab_lista_end_length{
      width: 30%;
      margin-left: 1vw;
    }
    #tab_lista_end_filter.label#text{
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
          <h3 class="page-header texto_cabeca">Endereços da Campanha</h3>
        </div>
        <div class="col-xs-1" style="align:center">
          <form action="#" method="post">
            <div class="hide">
              <input type="text" id="selecionados" name="selecionados" class="form-control"/>
              <input type="text" id="id_cmp" name="id_cmp" class="form-control" value=<?php echo $id_cmp; ?>/>
              <input type="text" id="id_cli" name="id_cli" class="form-control" value=<?php echo $id_cli; ?>/>
            </div>
            <input id="btn_salvar" class="btn btn-danger pull-right" type="submit"  value="Salvar" />
          </form>
        </div>
        <div class="col-xs-1 col-xs-offset-1">
          <input id="btn_novo" class="btn btn-danger pull-right" value="Novo" 
          onclick="location.href='<?php echo $home; ?>/cadastrar-endereco/?id_cmp=<?php echo $id_cmp; ?>';"/>
        </div>
    </div><!-- fecha div row -->

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
                      <table class="table table-striped" id="tab_end_cmp">
                        <thead>
                          <tr>
                            <th>Selecionar</th>
                            <th>Nome</th>
                            <th>Logradouro</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <!-- <th>Ativo</th> -->
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          $enderecos = $wpdb->get_results( 
                            "
                            SELECT 
                            ENDERECO.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `ativo` 
                            FROM `ENDERECO` as ENDERECO, 
                            `VCL_ENDERECO` as VCL_ENDERECO 
                            WHERE 
                            ENDERECO.cd_end=VCL_ENDERECO.cd_end and 
                            VCL_ENDERECO.cd_cli={$id_cli} and ativo=1 order by `nm_end`, `logradouro`
                            "
                          );
                          
                          // if (count($enderecos)<=0){
                          //   echo "<script language='javascript' type='text/javascript'>
                          //   window.location.href='{$home}/cadastrar-endereco/?id={$id_cli}';</script>";
                          // }


                          foreach ( $enderecos as $endereco ) 
                          {
                        ?>
                          <tr>
                            <td>
                              <a class="sel" id="sel_<?php echo $endereco->cd_end; ?>" onclick="montaArr('<?php echo $endereco->cd_end; ?>', 'sel')";>
                                <i class="material-icons" style="padding-left: 5px; color: DimGray; cursor: pointer;">done</i>
                              </a>
                              <a class="done hide" id="done_<?php echo $endereco->cd_end; ?>" onclick="montaArr('<?php echo $endereco->cd_end; ?>', 'done')">
                                <i class="material-icons" style="padding-left: 5px; color: Lime; cursor: pointer;">done_all</i>
                              </a>
                            </td>
                            <td><?php echo $endereco->nm_end ?></td>
                            <td><?php echo $endereco->logradouro ?></td>
                            <td><?php echo $endereco->num_end ?></td>
                            <td><?php echo $endereco->bairro ?></td>
                            <td><?php echo $endereco->cep ?></td>
                            <td><?php echo $endereco->cidade ?></td>
                            <td><?php echo $endereco->estado ?></td>
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
    var arr = [];  

      //datatable
	$(document).ready(function(){
    $('#tab_end_cmp').DataTable({
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
    $('#tab_lista_end_filter').addClass('pull-right');
    $('#tab_lista_end_paginate').addClass('pull-right');
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
