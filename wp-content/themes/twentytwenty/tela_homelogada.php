<?php /* Template Name: HomeLogada */

global $wpdb;
?>
 
 <?php

$sql = "SELECT count(*) as total FROM CLIENTE where cd_tp_cli=1";
$total_clientes_pf = $wpdb->get_var($sql);

$sql = "SELECT count(*) as total FROM CLIENTE where cd_tp_cli=2";
$total_clientes_pj = $wpdb->get_var($sql);

?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<title>Página de exemplo &#8211; Vacinarte</title>
<meta name='robots' content='noindex,nofollow' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Feed para Vacinarte &raquo;" href="http://vacinarte-admin.com.br/feed/" />
<link rel="alternate" type="application/rss+xml" title="Feed de comentários para Vacinarte &raquo;" href="http://vacinarte-admin.com.br/comments/feed/" />
		<script>
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/vacinarte-admin.com.br\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.3.2"}};
			!function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,55356,57342,8205,55358,56605,8205,55357,56424,55356,57340],[55357,56424,55356,57342,8203,55358,56605,8203,55357,56424,55356,57340])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style>
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
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
<script src='http://vacinarte-admin.com.br/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4'></script>
<script>
jQuery(document).ready(function(jQuery){jQuery.datepicker.setDefaults({"closeText":"Fechar","currentText":"Hoje","monthNames":["janeiro","fevereiro","mar\u00e7o","abril","Maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"],"monthNamesShort":["jan","fev","mar","abr","Maio","jun","jul","ago","set","out","nov","dez"],"nextText":"Seguinte","prevText":"Anterior","dayNames":["domingo","segunda-feira","ter\u00e7a-feira","quarta-feira","quinta-feira","sexta-feira","s\u00e1bado"],"dayNamesShort":["dom","seg","ter","qua","qui","sex","s\u00e1b"],"dayNamesMin":["D","S","T","Q","Q","S","S"],"dateFormat":"d \\dd\\e MM \\dd\\e yy","firstDay":0,"isRTL":false});});
</script>
<script src='http://vacinarte-admin.com.br/wp-content/plugins/wp-datepicker/js/scripts-front.js?ver=5.3.2'></script>

<link rel='stylesheet' id='twentytwenty-print-style-css'  href='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/print.css?ver=1.1' media='print' />
<script src='http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/assets/js/index.js?ver=1.1' async></script>
<link rel='https://api.w.org/' href='http://vacinarte-admin.com.br/wp-json/' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://vacinarte-admin.com.br/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://vacinarte-admin.com.br/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 5.3.2" />
<link rel='shortlink' href='http://vacinarte-admin.com.br/?p=2' />
<link rel="alternate" type="application/json+oembed" href="http://vacinarte-admin.com.br/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fvacinarte-admin.com.br%2Fpagina-exemplo%2F" />
<link rel="alternate" type="text/xml+oembed" href="http://vacinarte-admin.com.br/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fvacinarte-admin.com.br%2Fpagina-exemplo%2F&#038;format=xml" />
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	<style media="print">#wpadminbar { display:none; }</style>
	<style media="screen">
	html { margin-top: 32px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 46px !important; }
		* html body { margin-top: 46px !important; }
	}
</style>

<style type="text/css">
    .help-block{ display: block;
                    margin-top: 5px;
                    margin-bottom: 10px;
                    color: #a94442; }
</style>
</head>
<body>
    
    <?php include 'tela_header.php';?>

    <?php if ($_COOKIE["logado"] <= 0){
        echo "<script language='javascript' type='text/javascript'>
        window.location.href='http://vacinarte-admin.com.br/';</script>";
    }?>
    
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php get_template_part( 'template-parts/page/content', 'page' );?>
        
                <div class="container">

                    <div class="row" style="text-align:center;">
                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2><?php echo $total_clientes_pf; ?></h2></div>
                                            <div>Clientes PF</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="http://vacinarte-admin.com.br/listar-pf/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Listar clientes</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>

                                <a href="http://vacinarte-admin.com.br/cadastrar-pf/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Cadastrar cliente</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->

                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2><?php echo $total_clientes_pj; ?></h2></div>
                                            <div>Clientes PJ</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="http://vacinarte-admin.com.br/listar-pj/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Listar clientes</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>

                                <a href="http://vacinarte-admin.com.br/cadastrar-pj/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Cadastrar cliente</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->
                        
                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h5>Atendimento</h5></div>
                                            
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="http://vacinarte-admin.com.br/iniciar-atendimento/">
                                    <div class="panel-footer">
                                        <span class="pull-left">Iniciar</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->

                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2>176</h2></div>
                                            <div>Demandas Ativas</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Detalhar</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->

                    </div><!-- fecha row -->

                    <div class="row" style="text-align:center;">
                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2>176</h2></div>
                                            <div>Demandas Ativas</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Detalhar</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->
    
                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2>176</h2></div>
                                            <div>Demandas Ativas</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Detalhar</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->
    
    
                        <div class="col" style="display:inline-block; margin: 10px; width: 15vw;">
                            <div class="panel panel-primary" id="dash_demandas">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <div class="huge"><h2>176</h2></div>
                                            <div>Demandas Ativas</div>
                                        </div><!-- fecha col xm 12 -->
                                    </div><!-- fecha row -->
                                </div><!-- fecha panel heading -->
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Detalhar</span>
                                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div><!-- fecha panel hfooter -->
                                </a>
                            </div><!-- fecha panel dags_totaldem -->
                        </div><!-- fecha col -->
    
                    </div><!-- fecha row -->

                </div>


        
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<script type="text/javascript" language="javascript">
	

	jQuery(document).ready(function($){
		
		if($('.wpcf7-form-control.wpcf7-repeater-add').length>0){
			$('.wpcf7-form-control.wpcf7-repeater-add').on('click', function(){
				wpdp_refresh(jQuery, true);
			});
		}
		
	
});
var wpdp_refresh_first = 'yes';
var wpdp_counter = 0;
var wpdp_month_array = [];
var wpdp_dateFormat = "dd/mm/yy";
var wpdp_defaultDate = "dd/mm/yy";
function wpdp_refresh($, force){
				if(typeof $.datepicker!='undefined' && typeof $.datepicker.regional["en-GB"]!='undefined'){
					
				wpdp_month_array = $.datepicker.regional["en-GB"].monthNames;
									
				}
		
		
				

				

				if($("#datepicker").length>0){
					
				$("#datepicker").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first=='yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$("#datepicker").datepicker( "destroy" );
					
					$("#datepicker").removeClass("hasDatepicker");
					wpdp_refresh_first = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//#datepicker									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter>2)
				clearInterval(wpdp_intv);		
				
				if(!$("#datepicker").hasClass('hasDatepicker')){

				
					
				$("#datepicker").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				$("#datepicker").attr('readonly', 'readonly');
				
				
				
				
				$("#datepicker").datepicker( "option", "dateFormat", "dd/mm/yy" );
setTimeout(function(){ $("#datepicker").datepicker().datepicker('setDate', "dd/mm/yy"); }, 100);
									
					$.each($("#datepicker"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}

				

				if($(".hasDatepicker").length>0){
					
				$(".hasDatepicker").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first=='yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$(".hasDatepicker").datepicker( "destroy" );
					
					$(".hasDatepicker").removeClass("hasDatepicker");
					wpdp_refresh_first = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//.hasDatepicker									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter>2)
				clearInterval(wpdp_intv);		
				
				if(!$(".hasDatepicker").hasClass('hasDatepicker')){

				
					
				$(".hasDatepicker").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				$(".hasDatepicker").attr('readonly', 'readonly');
				
				
				
				
				$(".hasDatepicker").datepicker( "option", "dateFormat", "dd/mm/yy" );
setTimeout(function(){ $(".hasDatepicker").datepicker().datepicker('setDate', "dd/mm/yy"); }, 100);
									
					$.each($(".hasDatepicker"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}

				

				if($(".date-field").length>0){
					
				$(".date-field").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first=='yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$(".date-field").datepicker( "destroy" );
					
					$(".date-field").removeClass("hasDatepicker");
					wpdp_refresh_first = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//.date-field									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter>2)
				clearInterval(wpdp_intv);		
				
				if(!$(".date-field").hasClass('hasDatepicker')){

				
					
				$(".date-field").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				$(".date-field").attr('readonly', 'readonly');
				
				
				
				
				$(".date-field").datepicker( "option", "dateFormat", "dd/mm/yy" );
setTimeout(function(){ $(".date-field").datepicker().datepicker('setDate', "dd/mm/yy"); }, 100);
									
					$.each($(".date-field"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}
		
		
			
		
		$('.ui-datepicker').addClass('notranslate');
}
	var wpdp_intv = setInterval(function(){
		wpdp_counter++;
		wpdp_refresh(jQuery, false);
	}, 500);

	
	
	</script>
</body>
</html>

