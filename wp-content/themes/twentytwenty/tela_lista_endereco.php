<?php /* Template Name: TelaListaEndereco */

global $wpdb;
if(isset($_GET['id'])){
  $id_cli = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Endereços do Cliente</title>
    <!-- Bootstrap -->
    <!-- <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

  </head>
  <body>
  
  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Endereços do Cliente
          <!-- <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small> -->
          </h3>
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
                      <table class="table table-striped" id="tab_lista_end">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Logradouro</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Ativo</th>
                            <!-- <th>Ações</th> -->
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
                            VCL_ENDERECO.cd_cli={$id_cli} order by `nm_end`, `logradouro`
                            "
                          );
                          
                          foreach ( $enderecos as $endereco ) 
                          {
                        ?>
                          <tr>
                            <td><?php echo $endereco->nm_end ?></td>
                            <td><?php echo $endereco->logradouro ?></td>
                            <td><?php echo $endereco->num_end ?></td>
                            <td><?php echo $endereco->bairro ?></td>
                            <td><?php echo $endereco->cep ?></td>
                            <td><?php echo $endereco->cidade ?></td>
                            <td><?php echo $endereco->estado ?></td>
                            <td><?php echo $endereco->ativo ?></td>
                            <!-- <td>
                              <a><i class="material-icons" style="padding-left: 5px; color: CornflowerBlue; cursor: pointer;">description</i></a>
                              <a href='http://vacinarte-admin.com.br/cadastrar-endereco/?id=<?php //echo $endereco->cd_end; ?>'><i class="material-icons" style="padding-left: 5px; color: SlateGray; cursor: pointer;">edit</i></a>
                              <a><i class="material-icons" style="padding-left: 5px; color: tomato; cursor: pointer;">delete</i></a>
                            </td> -->
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
    <div class="col-xs-2 col-xs-offset-1">
      <input type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-endereco/';" 
      value="Novo" />
    </div>
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

    <!-- <script>
      //datatable
	$(document).ready(function() {
    $('#tab_cli_pf').DataTable({
	       
	        "lengthMenu": [
	            [20, 30, 50, -1],
	            [20, 30, 50, "Todos"]
	        ],
	        "ordering": true,
	        "paginate": true,
	        "pagingType": "full_numbers",
	        "searching": true,
	        "paging": true,
	        "info": false,
	        "autoWidth": false,
	        "bStateSave": false,
          "bLengthChange": true,
          "aoColumns": [
	            null,
	            null,
	            null,
	            null
	        ],
	        
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

    </script> -->
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.dataTables.min.js"></script>
    
    <script>
      //datatable
	$(document).ready(function(){
    $('#tab_lista_end').DataTable({
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
  </body>
  </html>
