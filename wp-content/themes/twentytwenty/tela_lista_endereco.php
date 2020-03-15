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
    <meta http-equiv="X-UA-Compatible" content="Chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >

    <link rel="profile" href="https://gmpg.org/xfn/11">
   
    <title>Endereços do Cliente</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name='robots' content='noindex,nofollow' />
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="alternate" type="application/rss+xml" title="Feed para Vacinarte &raquo;" href="http://vacinarte-admin.com.br/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Feed de comentários para Vacinarte &raquo;" href="http://vacinarte-admin.com.br/comments/feed/" />
	0
    <script>
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/vacinarte-admin.com.br\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.3.2"}};
			!function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,55356,57342,8205,55358,56605,8205,55357,56424,55356,57340],[55357,56424,55356,57342,8203,55358,56605,8203,55357,56424,55356,57340])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>

    <link rel='stylesheet' id='dashicons-css'  href='http://vacinarte-admin.com.br/wp-includes/css/dashicons.min.css?ver=5.3.2' media='all' />
    <link rel='stylesheet' id='admin-bar-css'  href='http://vacinarte-admin.com.br/wp-includes/css/admin-bar.min.css?ver=5.3.2' media='all' />
    <link rel='stylesheet' id='wp-block-library-css'  href='http://vacinarte-admin.com.br/wp-includes/css/dist/block-library/style.min.css?ver=5.3.2' media='all' />
    <link rel='stylesheet' id='twentytwenty-style-css'  href='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/style.css?ver=1.1' media='all' />
    <style id='twentytwenty-style-inline-css'>
    .color-accent,.color-accent-hover:hover,.color-accent-hover:focus,:root .has-accent-color,.has-drop-cap:not(:focus):first-letter,.wp-block-button.is-style-outline,a { color: #cd2653; }blockquote,.border-color-accent,.border-color-accent-hover:hover,.border-color-accent-hover:focus { border-color: #cd2653; }button:not(.toggle),.button,.faux-button,.wp-block-button__link,.wp-block-file .wp-block-file__button,input[type="button"],input[type="reset"],input[type="submit"],.bg-accent,.bg-accent-hover:hover,.bg-accent-hover:focus,:root .has-accent-background-color,.comment-reply-link { background-color: #cd2653; }.fill-children-accent,.fill-children-accent * { fill: #cd2653; }body,.entry-title a,:root .has-primary-color { color: #000000; }:root .has-primary-background-color { background-color: #000000; }cite,figcaption,.wp-caption-text,.post-meta,.entry-content .wp-block-archives li,.entry-content .wp-block-categories li,.entry-content .wp-block-latest-posts li,.wp-block-latest-comments__comment-date,.wp-block-latest-posts__post-date,.wp-block-embed figcaption,.wp-block-image figcaption,.wp-block-pullquote cite,.comment-metadata,.comment-respond .comment-notes,.comment-respond .logged-in-as,.pagination .dots,.entry-content hr:not(.has-background),hr.styled-separator,:root .has-secondary-color { color: #6d6d6d; }:root .has-secondary-background-color { background-color: #6d6d6d; }pre,fieldset,input,textarea,table,table *,hr { border-color: #dcd7ca; }caption,code,code,kbd,samp,.wp-block-table.is-style-stripes tbody tr:nth-child(odd),:root .has-subtle-background-background-color { background-color: #dcd7ca; }.wp-block-table.is-style-stripes { border-bottom-color: #dcd7ca; }.wp-block-latest-posts.is-grid li { border-top-color: #dcd7ca; }:root .has-subtle-background-color { color: #dcd7ca; }body:not(.overlay-header) .primary-menu > li > a,body:not(.overlay-header) .primary-menu > li > .icon,.modal-menu a,.footer-menu a, .footer-widgets a,#site-footer .wp-block-button.is-style-outline,.wp-block-pullquote:before,.singular:not(.overlay-header) .entry-header a,.archive-header a,.header-footer-group .color-accent,.header-footer-group .color-accent-hover:hover { color: #cd2653; }.social-icons a,#site-footer button:not(.toggle),#site-footer .button,#site-footer .faux-button,#site-footer .wp-block-button__link,#site-footer .wp-block-file__button,#site-footer input[type="button"],#site-footer input[type="reset"],#site-footer input[type="submit"] { background-color: #cd2653; }.header-footer-group,body:not(.overlay-header) #site-header .toggle,.menu-modal .toggle { color: #000000; }body:not(.overlay-header) .primary-menu ul { background-color: #000000; }body:not(.overlay-header) .primary-menu > li > ul:after { border-bottom-color: #000000; }body:not(.overlay-header) .primary-menu ul ul:after { border-left-color: #000000; }.site-description,body:not(.overlay-header) .toggle-inner .toggle-text,.widget .post-date,.widget .rss-date,.widget_archive li,.widget_categories li,.widget cite,.widget_pages li,.widget_meta li,.widget_nav_menu li,.powered-by-wordpress,.to-the-top,.singular .entry-header .post-meta,.singular:not(.overlay-header) .entry-header .post-meta a { color: #6d6d6d; }.header-footer-group pre,.header-footer-group fieldset,.header-footer-group input,.header-footer-group textarea,.header-footer-group table,.header-footer-group table *,.footer-nav-widgets-wrapper,#site-footer,.menu-modal nav *,.footer-widgets-outer-wrapper,.footer-top { border-color: #dcd7ca; }.header-footer-group table caption,body:not(.overlay-header) .header-inner .toggle-wrapper::before { background-color: #dcd7ca; }
    </style>
    
    <script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/jquery.js?ver=1.12.4-wp'></script>
    <script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
    <script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>

    <link rel='stylesheet' id='twentytwenty-print-style-css'  href='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/print.css?ver=1.1' media='print' />
    <script src='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/assets/js/index.js?ver=1.1' async></script>
    <link rel='https://api.w.org/' href='http://vacinarte-admin.com.br/wp-json/' />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://vacinarte-admin.com.br/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://vacinarte-admin.com.br/wp-includes/wlwmanifest.xml" /> 

    <script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
    <style media="print">#wpadminbar { display:none; }</style>
  </head>
  <style>
  #tab_lista_end_paginate{
    font-size: 15px;
    margin-top: -2vw;
  }
  #tab_lista_end_info{
    font-size: 15px;
  }
  .dataTables_empty{
    text-align: center;
    font-weight: bold;
  }
  #tab_lista_end_filter{
    width: 30%;
    margin-top: -3vw;
  }
  #tab_lista_end_length{
    width: 30%;
  }
  input{
    height: 1vw;
  } 
  .btn_salvar{
    margin-top: 2.6vw;
    height: 4.5vw;
  }
  </style>
  <body>
  
  <?php include 'tela_header.php';?>
  <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-xs-10">
          <h3 class="page-header">Endereços do Cliente
          <!-- <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small> -->
          </h3>
        </div>
        <div class="col-xs-2" style="align:center">
          <input class="btn_salvar pull-right" type="button" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-endereco/';" 
          value="Novo" style="margin-top:35px"/>
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
    <div class="col-xs-2 col-xs-offset-1 hide">
      <input type="button" id="btn_salvar_end" onclick="location.href='http://vacinarte-admin.com.br/cadastrar-endereco/';" 
      value="Novo" />
    </div>
</div><!-- fecha container principal -->  


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
    $('#tab_lista_end_filter').addClass('pull-right');
    $('#tab_lista_end_paginate').addClass('pull-right');
  });

    </script>
  </body>
  </html>
