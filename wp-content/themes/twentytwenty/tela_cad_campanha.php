<?php /* Template Name: TelaCadCampanha */
//cada vez q o header carregar renova a sessao de logado
setcookie("logado", 1, (time() + (0.5 * 3600)));
//https://www.hostinger.com.br/tutoriais/como-alterar-fuso-horario-usando-htaccess
global $wpdb;
$home = get_home_url();
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/cad_campanha.php"; ?> 
<?php require "frontend/cad_campanha.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 