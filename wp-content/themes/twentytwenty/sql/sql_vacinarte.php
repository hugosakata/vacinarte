<?php

$lista_campanhas = "
SELECT 
CAMPANHA.`cd_cmp`, `nm_cmp`, `nm_fant`, `cd_vcl_end`, `nm_tp_srv`, date_format(`dt_ini`, '%%d/%m/%Y') AS dt_ini, 
date_format(`dt_fim`, '%%d/%m/%Y') AS dt_fim, `VCL_VCNA_CMP`.`cd_vcl_vcna_cmp`, `VACINA`.nm_gen, 
`VCL_VCNA_CMP`.`qtd_vcna_contratada`, `VCL_VCNA_CMP`.`qtd_vcna_restante`
FROM `CAMPANHA`, `TP_SRV`, `CLIENTES`, `VCL_VCNA_CMP`, `VACINA`
WHERE `CAMPANHA`.`cd_tp_srv`=`TP_SRV`.`cd_tp_srv` AND
`CAMPANHA`.`cd_cli`=`CLIENTES`.`cd_cli` and
VCL_VCNA_CMP.cd_cmp=CAMPANHA.cd_cmp AND
VCL_VCNA_CMP.cd_vcna=VACINA.cd_vcna AND
CAMPANHA.cd_cmp = '%d'";

?>