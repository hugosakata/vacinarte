<?php /* Template Name: Login */
//passo a passo pra voltar pra producao
//mudar as variaveis no arquiv wp-config.php
//retirar o site home e url
//comentar o banco de desenv e colocaro banco producao

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

global $wpdb;

$home = get_home_url();
?>

<?php require "sql/sql_vacinarte.php"; ?> 
<?php require "backend/login.php"; ?> 
<?php require "frontend/login.php"; ?>
<?php //$wpdb->show_errors(); ?>
<?php //$wpdb->print_error(); ?> 
