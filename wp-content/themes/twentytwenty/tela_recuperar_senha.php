<?php /* Template Name: RecuperarSenha */
global $wpdb;

$home = get_home_url();
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/recuperar_senha.php"; ?> 
<?php require "frontend/recuperar_senha.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 
