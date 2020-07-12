<?php 
// $sql = "
// SELECT 
//     `cd_atend`,
//     `nm_cmp`,
//     `nm_fant`,
//     `ENDERECO`.`logradouro`,
//     `ENDERECO`.`nm_end`,
//     `ENDERECO`.`num_end`,
//     `ENDERECO`.`complemento`,
//     `ENDERECO`.`bairro`,
//     `ENDERECO`.`cep`,
//     `ENDERECO`.`cidade`,
//     `ENDERECO`.`estado`,
//     date_format(`dt_atend`, '%d/%m/%Y') AS dt_atend,
//     `hr_ini`,
//     `hr_fim`,
//     `nm_enfermeiro`
// FROM
//     `ATENDIMENTO`,
//     `CAMPANHA`,
//     `CLIENTES`,
//     `VCL_END_CMP`,
//     `VCL_ENDERECO`,
//     `ENDERECO`
// WHERE
//     `ATENDIMENTO`.`cd_cmp` = `CAMPANHA`.`cd_cmp`
//   AND `CAMPANHA`.`cd_cli` = `CLIENTES`.`cd_cli`
//   AND `CAMPANHA`.`cd_cmp` = `VCL_END_CMP`.`cd_cmp`
//     and `VCL_END_CMP`.`cd_end` = `VCL_ENDERECO`.`cd_end`
//   AND `VCL_ENDERECO`.`cd_end` =  `ENDERECO`.`cd_end`
//   AND `ATENDIMENTO`.`bl_fechamento` = 0
//     AND `ATENDIMENTO`.`dt_atend` >= date(now())
// ORDER BY `cd_atend` DESC";

$sql = $wpdb->prepare($listar_agendamentos );

?>