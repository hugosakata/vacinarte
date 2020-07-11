<?php /* Template Name: TelaListaContato */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url(); 
?>

<?php require "backend/lista_contato.php"; ?> 
<?php require "frontend/lista_contato.php"; ?>