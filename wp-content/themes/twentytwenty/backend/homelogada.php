<?php

// $sql = "SELECT count(*) as total FROM CLIENTES where cd_tp_cli=1";
$sql = $wpdb->prepare($selecionar_total_clientes_pf );
$total_clientes_pf = $wpdb->get_var($sql);

// $sql = "SELECT count(*) as total FROM CLIENTES where cd_tp_cli=2";
$sql = $wpdb->prepare($selecionar_total_clientes_pj );
$total_clientes_pj = $wpdb->get_var($sql);

$wpdb->query ("START TRANSACTION");
$wpdb->query ("SET time_zone = '-3:00'");
// $sql = "SELECT COUNT(CD_CMP) QTD_CMP FROM CAMPANHA WHERE DT_FIM >= date(NOW());";
$sql = $wpdb->prepare($selecionar_total_campanha_ativa );
$total_campanha_ativa = $wpdb->get_var($sql);

// $sql = "SELECT COUNT(CD_ATEND) QT_AGENDA FROM ATENDIMENTO WHERE DT_ATEND >= date(NOW()) AND BL_FECHAMENTO = 0;";
$sql = $wpdb->prepare($selecionar_total_agendamento_ativo );
$total_agenda = $wpdb->get_var($sql);
$wpdb->query("COMMIT");

?>