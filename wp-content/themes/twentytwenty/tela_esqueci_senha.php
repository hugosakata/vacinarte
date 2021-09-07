<?php /* Template Name: EsqueciSenha */
global $wpdb;

$home = get_home_url();
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/esqueci_senha.php"; ?> 
<?php require "frontend/esqueci_senha.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 
