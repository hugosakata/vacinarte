<?php /* Template Name: TelaListaPj */

global $wpdb;

?>


<?php
// if($_SERVER["REQUEST_METHOD"] == "GET"){
//   $id_delete = $_GET["delete"];

//   if ($id_delete > 0){
//     $wpdb->delete( 'CLIENTE', array( 'cd_cli' => id_delete ), array( '%d' ) );
//   }
  
// }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Clientes PJ</title>
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
   
    <style>
    .corpo{
      background-color: WhiteSmoke;
    }
    #tab_cli_pj_info, #tab_cli_pj_paginate{
      font-size: 15px;
    }
    input{
      height: 2vw;
    }
    #tab_cli_pj_length{
      width: 30%;
      margin-left: 1vw;
    }
    #tab_cli_pj_filter{
      width: 30%;
      margin-right: 2vw;
    }
    #tab_cli_pj_filter.label#text{
      text-align: left;
    }
    #btn_salvar{
      width: 8vw;
      font-size: 14px;
      border-radius: 6px;
      height: 3.5vw;
      margin-top: 1vw;
    }
    .texto_cabeca{
      font-size: 25px;
      margin-top: 2vw !important;
      color: dimgray;
      }
    .btn_icon{
      padding-left: 5px;
      cursor: pointer;
    }
    .btn_edit{
      color: CornflowerBlue;
    }
    .btn_endereco{
      color: GoldenRod;
    }
    .btn_contato{
      color: DarkCyan;
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
      color: DimGray;
      font-size: 20px;
    }
    .fontMenu{
      font-size: 15px;
      font-weight: bold;
    }
    .th_1{
      width: 35%;
    }
    .th_2{
      width: 30%;
    }
    .th_3{
      width: 20%;
    }
    .th_4{
      width: 15%;
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
              <ul class="nav navbar-nav" style="margin-top: 1vw;">
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
        <div class="col-xs-10">
          <h3 class="page-header texto_cabeca">Clientes PJ</h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input id="btn_salvar" class="btn btn-danger pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-pj/';" 
          value="Novo"/>
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
                      <table class="table table-striped" id="tab_cli_pj">
                        <thead>
                          <tr>
                            <th class="th_1">Razão Social</th>
                            <th class="th_2">Nome Fantasia</th>
                            <th class="th_3">CNPJ</th>
                            <th class="th_4">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          $clientes = $wpdb->get_results( 
                            "
                            SELECT cd_cli, nm_rz_soc, nm_fant, cpf_cnpj 
                            FROM CLIENTES
                            WHERE cd_tp_cli=2 order by nm_rz_soc, nm_fant
                            "
                          );
                          
                          foreach ( $clientes as $cliente ) 
                          {
                        ?>

                          <tr id="<?php echo $cliente->cd_cli; ?>">
                            <td><?php echo $cliente->nm_rz_soc ?></td>
                            <td><?php echo $cliente->nm_fant ?></td>
                            <td><?php echo $cliente->cpf_cnpj ?></td>
                            <td>
                              <a title='Editar' href='http://vacinarte-admin.com.br/cadastrar-pj/?id=<?php echo $cliente->cd_cli; ?>' ><i class="material-icons btn_icon btn_edit">edit</i></a>
                              <a title='Endereços' href='http://vacinarte-admin.com.br/listar-enderecos/?id=<?php echo $cliente->cd_cli; ?>' ><i class="material-icons btn_icon btn_endereco">home</i></a>
                              <a title='Contatos' href='http://vacinarte-admin.com.br/listar-contatos/?id=<?php echo $cliente->cd_cli; ?>' ><i class="material-icons btn_icon btn_contato">phone</i></a>
                              <!-- <a href='#/?delete=<?php //echo $cliente->cd_cli; ?>'><i class="material-icons" style="padding-left: 5px; color: tomato; cursor: pointer;">delete</i></a> -->
                            </td>
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
      //datatable
	$(document).ready(function(){
    $('#tab_cli_pj').DataTable({
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
  });

    </script>
    <script>
    $('tr').dblclick(function(){
      var id = $(this).attr('id');
      window.location = "http://vacinarte-admin.com.br/cadastrar-pj/?id=" + id;
      return false;
    })
    </script>
  </body>
  </html>
