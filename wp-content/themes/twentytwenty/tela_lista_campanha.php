<?php /* Template Name: TelaListaCampanha */

global $wpdb;
$home = get_home_url(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Campanhas Ativas</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
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
  #btn_novo{
      width: 8vw;
      font-size: 14px;
      border-radius: 6px;
      height: 3.5vw;
      margin-top: 1vw;
    }
  .dataTables_empty{
    text-align: center;
    font-weight: bold;
  }
  #tab_lista_campanha_info, #tab_lista_campanha_paginate{
    font-size: 15px;
  }
  #tab_lista_campanha_filter{
    width: 30%;
  }
  #tab_lista_campanha_length{
    width: 30%;
    margin-left: 1vw;
  }
  input{
    height: 2vw;
  } 
  .btn_cad{
    margin-top: 2.6vw;
    height: 4.5vw;
  }
  .fontTH{
    font-size: 14px;
  }
  .fontTD{
    font-size: 12px;
  }
  </style>
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
              <ul class="nav navbar-nav" style="margin-top: 1vw;">
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

    <div class="container" style="width: 100%;"><!-- container principal-->
      
      <div class="row">
          <div class="col-xs-10">
            <h3 class="page-header texto_cabeca">Campanhas</h3>
          </div>
          <div class="col-xs-2" style="align:center">
            <input id="btn_novo" class="btn btn-danger pull-right" type="button" onclick="location.href='<?php echo $home; ?>/campanha/';" 
            value="Novo" />
          </div>
      </div><!-- fecha div row -->

      <div class="row txtbox"><!-- row  -->
        <div class="col-lg-12 col-xs-12">
          <div class="row"><!--div row de consulta -->
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active">
              <div class="col-lg-12 col-xs-12">
                <div class="row paineldeconsulta">
                  <div class="col-lg-12 col-xs-12"><!-- posiciona  -->
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <table class="table table-striped" id="tab_lista_campanha">
                          <thead>
                            <tr>
                              <th class="fontTH">Nome Campanha</th>
                              <th class="fontTH">Cliente</th>
                              <th class="fontTH">Tipo Serviço</th>
                              <th class="fontTH">Data Início</th>
                              <th class="fontTH">Data Fim</th>
                              <th class="fontTH">Endereço</th>
                              <th class="fontTH">Contato</th>
                              <th class="fontTH">Vacina</th>
                              <th class="fontTH">Qtde</th>
                              <th class="fontTH">Valor Unit</th>
                              <th class="fontTH">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                          <?php
                            $campanhas = $wpdb->get_results( 
                              "
                              SELECT
                                CMP.CD_CMP,
                                CMP.NM_CMP,
                                CMP.CD_CLI,
                                CLI.NM_FANT,
                                CMP.CD_TP_SRV,
                                SRV.NM_TP_SRV,
                                CMP.DT_INI,
                                CMP.DT_FIM,
                                END.CD_END,
                                CONCAT(END.LOGRADOURO, ', ', END.NUM_END, ', ', END.COMPLEMENTO, ', ', END.BAIRRO, ' - ', END.CIDADE) LOCAL,
                                VC.CD_CTT,
                                CONCAT(CON.NM_CTT, ': ', CON.TEL_PRI, ' / ', CON.EMAIL) CTTO,
                                VVC.CD_VCL_VCNA_CMP,
                                VVC.CD_VCNA,
                                CONCAT(VCNA.NM_REG, ' - ', FAB.NM_FBCNTE_VCNA) VAC,
                                VVC.QTD_VCNA,
                                VVC.VLR_VCNA
                              FROM
                                CAMPANHA CMP
                                LEFT JOIN TP_SRV SRV ON CMP.CD_TP_SRV = SRV.CD_TP_SRV
                                LEFT JOIN CLIENTES CLI ON CMP.CD_CLI = CLI.CD_CLI
                                LEFT JOIN VCL_ENDERECO VE ON CMP.CD_VCL_END = VE.CD_VCL_END
                                LEFT JOIN ENDERECO END ON VE.CD_END = END.CD_END AND CMP.CD_CLI = VE.CD_CLI
                                LEFT JOIN VCL_CONTATO VC ON CMP.CD_CLI = VC.CD_CLI
                                LEFT JOIN CONTATO CON ON VC.CD_CTT = CON.CD_CTT
                                LEFT JOIN VCL_VCNA_CMP VVC ON CMP.CD_CMP = VVC.CD_CMP
                                LEFT JOIN VACINA VCNA ON VVC.CD_VCNA = VCNA.CD_VCNA
                                LEFT JOIN FBCNTE_VCNA FAB ON VCNA.CD_FBCNTE_VCNA = FAB.CD_FBCNTE_VCNA
                              WHERE
                                CMP.DT_FIM >= now()
                              ORDER BY
                                CMP.DT_INI ASC

                              "
                            );
                            
                            foreach ( $campanhas as $campanha ) 
                            {
                          ?>
                            <tr title="-Endereço:&&#35;13;<?php echo $campanha->LOCAL ?>&&#35;13;-Contato:&&#35;13;<?php echo $campanha->CTTO ?>">
                              <td class="fontTD"><?php echo $campanha->NM_CMP ?></td>
                              <td class="fontTD"><?php echo $campanha->NM_FANT ?></td>
                              <td class="fontTD"><?php echo $campanha->NM_TP_SRV ?></td>
                              <td class="fontTD"><?php echo $campanha->DT_INI ?></td>
                              <td class="fontTD"><?php echo $campanha->DT_FIM ?></td>
                              <td class="fontTD"><?php echo $campanha->LOCAL ?></td>
                              <td class="fontTD"><?php echo $campanha->CTTO ?></td>
                              <td class="fontTD"><?php echo $campanha->VAC ?></td>
                              <td class="fontTD"><?php echo $campanha->QTD_VCNA ?></td>
                              <td class="fontTD"><?php echo $campanha->VLR_VCNA ?></td>
                              <td class="fontTD">
                                <a title='Agendar' href='<?php echo $home; ?>/cadastrar-agendamento/?id=<?php echo $campanha->CD_CMP; ?>' ><i class="material-icons" style="padding-left: 5px; color: DarkGreen; cursor: pointer;">access_alarm</i></a>
                                <a title='Vacinas' href='<?php echo $home; ?>/cadastrar-vacina-campanha/?id=<?php echo $campanha->CD_CMP; ?>' ><i class="material-icons" style="padding-left: 5px; color: DarkSlateBlue; cursor: pointer;">opacity</i></a>
                                
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
            </div><!-- fecha div painel  -->
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
    $('#tab_lista_campanha').DataTable({
      "ordering": true,
	    "paginate": true,
      "dateFormat": "dd/mm/yyyy",
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
