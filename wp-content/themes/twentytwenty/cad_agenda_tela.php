
 <!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agendamentos</title>
    
    
    <!-- Google Material Icons -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css"
          href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
    
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
    </style>
    <script type='text/javascript'
            src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type='text/javascript'
            src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    
  </head>
  <body class="corpo">

  <?php include 'tela_header.php';?>

    <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='{$home}';</script>";
    }?>

<div class="container"><!-- container principal-->
    
  <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header">Agendamento de campanha</h3>
      </div>
  </div><!-- fecha div row -->

  <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

  <div class="row txtbox"><!-- row formulario -->
        <div class="col-lg-12 col-xs-8" style="margi-top: 1vw;">

            <div class="accordion" id="searchAccordion">
                <div class="accordion-group">
                      <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse"
                          data-parent="#searchAccordion" id="idOne">+ Dados da campanha - <?php echo $campanha->nm_cmp; ?></a> 
                      </div>

                    <div id="collapseOne" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <form>
                                <div class="row campanha page-header">
                            
                                    <div class="form-group col-xs-8 col-xs-offset-1">
                                        <label>Nome</label>
                                        <input type="text" name="nm_cmp" class="form-control" 
                                        value="<?php echo $campanha->nm_cmp; ?>" disabled>
                                    </div>
                                    <div class="form-group col-xs-2">
                                        <label style="font-size: 12px;">Tipo</label>
                                        <input type="text" name="nm_srv" class="form-control"
                                        value="<?php echo $campanha->nm_tp_srv; ?>" disabled>
                                    </div>

                                    <div class="form-group col-xs-6 col-xs-offset-1">
                                        <label>Empresa</label>
                                        <input type="text" name="nm_srv" class="form-control"
                                        value="<?php echo $campanha->nm_fant; ?>" disabled>
                                    </div>
                                
                                    <div class="form-group col-xs-2">
                                        <label style="font-size: 12px;">Data de início</label>
                                        <input type="text" name="nm_srv" class="form-control"
                                        value="<?php echo $campanha->dt_ini ?>" disabled>
                                    </div>
                                    <div class="form-group col-xs-2">
                                        <label style="font-size: 12px;">Data de término</label>
                                        <input type="text" name="nm_srv" class="form-control"
                                        value="<?php echo $campanha->dt_fim; ?>" disabled>
                                    </div>

                                </div>
                            </form><!-- fecha form -->
                        </div><!-- fecha inner -->
                    </div><!-- fecha collapseOne -->
                </div><!-- fecha accord group -->


                <form action="#" method="post">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse"
                        data-parent="#searchAccordion" id="idThree">+ Dados da Vacina </a> 
                    </div>

                    <div id="collapseThree" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <!-- <form> -->
                                <div class="row vacina page-header">

                                  <!-- como fazer um forEach nessa row -->
                                  <!-- a consulta feita para alimentar essa tela já traz as vacinas de uma campanha -->
                                  <!-- a campanha 17, por exemplo, tem 3 vacinas cadastradas-->
                                  <!-- Se fizer um forEach aqui com os dados da campanha 17, 3 rows dessa vão pipocar na tela -->
                                  <!-- aí, o problema será os ids cd_vcl_vcna_cmp e nomes de cada campo para mandar no submit --> 
                                  <?php foreach($campanhas as $campanha_item) {?>
                                    <div class="row">
                                        <div class="form-group col-xs-4 col-xs-offset-1">
                                            <label>Vacina</label>
                                            <input type="text" name="nm_gen" class="form-control" 
                                            value="<?php echo $campanha_item->nm_gen; ?>" disabled>
                                        </div>
                                        
                                        <div class="form-group col-xs-2">
                                            <label style="font-size: 14px;">Qtde Contratada</label>
                                            <input type="text" id="qtd_vcna_contratada" name="qtd_vcna_contratada" class="form-control"
                                            value="<?php echo $campanha_item->qtd_vcna_contratada; ?>" disabled />
                                        </div>

                                        <div class="form-group col-xs-2">
                                            <label>Qtd Restante</label>
                                            <input type="text" id="qtd_vcna_restante" name="qtd_vcna_restante" class="form-control"
                                            value="<?php echo $campanha_item->qtd_vcna_restante; ?>" disabled />
                                        </div>

                                        <div class="form-group col-xs-2">
                                            <label>Qtd Envio</label>
                                            <input type="text" id="<?php echo $campanha_item->cd_vcl_vcna_cmp; ?>" name="<?php echo $campanha_item->cd_vcl_vcna_cmp; ?>" class="form-control"
                                            value="<?php echo $qtd_vcna_envio; ?>">
                                        </div>
                                    </div>
                                  <?php } ?>

                                </div>
                            <!-- </form> fecha form -->
                        </div>
                    </div>
                </div>

                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse"
                        data-parent="#searchAccordion" id="idTwo">+ Dados do agendamento</a>
                    </div>

                    <div id="collapseTwo" class="accordion-body collapse">
                        <div class="accordion-inner">
                            

                                <div class="row agendamento page-header">

                                    <div class="form-group col-xs-4 col-xs-offset-1">
                                        <label>Enfermeiro(a)</label>
                                        <input type="text" name="nm_enfermeiro" class="form-control" 
                                        value="<?php echo $nm_enfermeiro; ?>">
                                    </div>
                                    
                                    <div class="form-group col-xs-2">
                                        <label style="font-size: 14px;">Data</label>
                                        <input type="text" id="dt_atend" name="dt_atend" class="form-control"
                                        value="<?php echo $dt_atend; ?>"/>
                                    </div>

                                    <div class="form-group col-xs-2">
                                        <label>Hora Início</label>
                                        <input type="text" id="hr_ini" name="hr_ini" class="form-control"
                                        value="<?php echo $hr_ini; ?>">
                                    </div>

                                    <div class="form-group col-xs-2">
                                        <label>Hora Fim</label>
                                        <input type="text" id="hr_fim" name="hr_fim" class="form-control"
                                        value="<?php echo $hr_fim; ?>">
                                    </div>

                                </div><!-- fecha row agendamento-->          
                            
                                <div class="row btns">
                                    <div class="col-xs-2 col-xs-offset-3">
                                        <input type="submit" class="button btn btn-danger " value="Agendar">
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <input type="button" class="btn btn-danger" onclick="<?php echo "location.href='{$home}/cadastrar-vacina-campanha/?id={$id_cmp}';" ; ?>" 
                                        value="Vacinas" <?php if ($id_cmp <= 0) { echo "disabled='true' style='background-color:slateGray'"; } ?>/>
                                    </div>
                                </div>

                            <!-- </form>fecha form -->
                        </div>
                    </div>
                </div>
                </form><!-- fecha form -->

            </div>

        </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    <script>
        $("#idOne").click(function(){
          if (document.getElementById('collapseOne').classList.contains("in")){
              document.getElementById('collapseOne').setAttribute('class','accordion-body collapse');
              $("#idOne").text("+" + $("#idOne").text().substring(1));
          } else {
              document.getElementById('collapseOne').setAttribute('class','accordion-body collapse in');
              $("#idOne").text("-" + $("#idOne").text().substring(1));
          }
        });
        $("#idTwo").click(function(){
          if (document.getElementById('collapseTwo').classList.contains("in")){
              document.getElementById('collapseTwo').setAttribute('class','accordion-body collapse');
              $("#idTwo").text("+" + $("#idTwo").text().substring(1));
          } else {
              document.getElementById('collapseTwo').setAttribute('class','accordion-body collapse in');
              $("#idTwo").text("-" + $("#idTwo").text().substring(1));
          }
        });
        $("#idThree").click(function(){
          if (document.getElementById('collapseThree').classList.contains("in")){
              document.getElementById('collapseThree').setAttribute('class','accordion-body collapse');
              $("#idThree").text("+" + $("#idThree").text().substring(1));
          } else {
              document.getElementById('collapseThree').setAttribute('class','accordion-body collapse in');
              $("#idThree").text("-" + $("#idThree").text().substring(1));
          }
        });
        
    </script>

</div><!-- fecha container principal -->  

    


    <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://www.vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#dt_atend").mask("99/99/9999");
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#hr_ini").mask("99:99");
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){	
        $("#hr_fim").mask("99:99");
      });
    </script>
  </body>
  </html>