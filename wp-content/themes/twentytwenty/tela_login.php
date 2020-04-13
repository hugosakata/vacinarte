<?php /* Template Name: Login */
//passo a passo pra voltar pra producao
//mudar as variaveis no arquiv wp-config.php
//retirar o site home e url
//comentar o banco de desenv e colocaro banco producao


$message_body = array(
	'title' => 'teste push notification',
	'body' => 'teste body teste'
);

$receiver_pn_users = array(
    'post_title' => 'ExponentPushToken[ZDYkv0J59zNuEQ0upuBrzO]'
);
echo "<script language='javascript' type='text/javascript'>
alert('carrendo push {$receiver_pn_users->post_title}');</script>";

$all_messages = [];
foreach ( $receiver_pn_users as $each_user ) {
	$each_message = $message_body;
	$each_message[ "to" ] = $each_user->post_title;	// post_title is the user token
    $all_messages[] = $each_message;
   
}

$all_messages_chucked = array_chunk( $all_messages, 99 );
$responses = [];
foreach ( $all_messages_chucked as $each_messages_chucked ) {
    echo "<script language='javascript' type='text/javascript'>
    alert('enviando push {$each_messages_chucked->to}');</script>";
	// Ref: https://docs.expo.io/versions/latest/guides/push-notifications/#http2-api
	$responses[] = wp_safe_remote_post( "https://exp.host/--/api/v2/push/send", [
		'method' => 'POST',
		'timeout' => 15,
		'httpversion' => '2.0',
		'headers' => [ "content-type" => "application/json" ],
		'body' => json_encode( $each_messages_chucked ),
	] );
}

echo "<script language='javascript' type='text/javascript'>
alert('push enviado');</script>";

global $wpdb;

$home = get_home_url();
?>

<?php
 
if (isset($_GET['sair']))
    setcookie("logado");

// Define variables and initialize with empty values
$username = $password = $msg_err = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
 if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = str_replace("'", "", trim($_POST["username"]));
    $password = str_replace("'", "", trim($_POST["password"]));

    if(empty($username)){
        $username_err = "Campo usuário vazio!";
    } elseif(empty($password)) {
        $password_err = "Campo senha vazio!";
    } else {
        $sql = "select nm_usu, ";
        $sql .="ifnull(bl_sit_usu, 0) as ativo, ";
        $sql .="count(tx_log_usu) as existe from LOG_USU ";
        $sql .="where tx_log_usu = '{$username}' and pw_usu = '{$password}'";
        $user = $wpdb->get_row($sql);
        if($user->ativo == 1 && $user->existe == 1){
            $msg_err="Bem-vindo " . $user->nm_usu;
            // $location = home_url("/teste/");
            // $pages = get_pages();
            // foreach ( $pages as $page ) {
            //     $msg_err .= get_page_link( $page->ID ) . ",\n";
            // }
            // //exit( wp_redirect( "http://vacinarte-admin.com.br/teste/" ) );

            //seta cookie de logado de meia hora - 0.5 * 3600
            setcookie("logado", 1, (time() + (0.5 * 3600)));



            echo "<script language='javascript' type='text/javascript'>
            window.location.href='{$home}/home/';</script>";
        } else {
            $msg_err="Algo deu errado!\n\nVerifique os dados informados e tente novamente!";
        }
    }
}
//         // Prepare a select statement
//         $sql = "SELECT id FROM users WHERE username = ?";
        
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_username);
            
//             // Set parameters
//             $param_username = trim($_POST["username"]);
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 /* store result */
//                 mysqli_stmt_store_result($stmt);
                
//                 if(mysqli_stmt_num_rows($stmt) == 1){
//                     $username_err = "This username is already taken.";
//                 } else{
//                     $username = trim($_POST["username"]);
//                 }
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Validate password
//     if(empty(trim($_POST["password"]))){
//         $password_err = "Please enter a password.";     
//     } elseif(strlen(trim($_POST["password"])) < 6){
//         $password_err = "Password must have atleast 6 characters.";
//     } else{
//         $password = trim($_POST["password"]);
//     }
    
//     // Validate confirm password
//     if(empty(trim($_POST["confirm_password"]))){
//         $confirm_password_err = "Please confirm password.";     
//     } else{
//         $confirm_password = trim($_POST["confirm_password"]);
//         if(empty($password_err) && ($password != $confirm_password)){
//             $confirm_password_err = "Password did not match.";
//         }
//     }
    
//     // Check input errors before inserting in database
//     if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
//         // Prepare an insert statement
//         $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
//             // Set parameters
//             $param_username = $username;
//             $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Redirect to login page
//                 header("location: login.php");
//             } else{
//                 echo "Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Close connection
//     mysqli_close($link);
//}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{
            font: 14px sans-serif;
        }
        .wrapper{
            width: 350px;
            padding: 20px;
        }
        .corpo{
            background-color: WhiteSmoke;
        }
    </style>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<title>Vacinarte</title>
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
</head>
<body class="corpo">
    
    <header id="site-header" class="header-footer-group" role="banner" style="margin-top: -3vw;">
        <div class="header-inner section-inner">
            <div class="header-titles-wrapper">					
                <div class="header-titles">
                    <div class="site-title faux-heading"><a href="http://vacinarte-admin.com.br/">Vacinarte</a></div>
                </div><!-- .header-titles -->
            </div><!-- .header-titles-wrapper -->
        </div><!-- .header-inner -->			
    </header><!-- #site-header -->

    <div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		    <?php get_template_part( 'template-parts/page/content', 'page' );?>
    
    <center><div class="wrapper">

        <span class="help-block"><?php echo $msg_err; ?></span>

        <h2>Olá!</h2>
        <p>Digite usuário e senha para começar</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p> -->
        </form>
    </div></center>
    
    </main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
    
</body>
</html>
<?php
//get_footer();
?>
