<?php /* Template Name: Login */
//passo a passo pra voltar pra producao
//mudar as variaveis no arquiv wp-config.php
//retirar o site home e url
//comentar o banco de desenv e colocaro banco producao
global $wpdb;

$home = get_home_url();
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/login.php"; ?> 
<?php require "frontend/login.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 
