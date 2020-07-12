<?php /* Template Name: TelaListaEndereco */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));

global $wpdb;
$home = get_home_url(); 
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/lista_endereco.php"; ?> 
<?php require "frontend/lista_endereco.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 
