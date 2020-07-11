<?php

/****************CAMPANHA*******************/
$listar_campanhas = "
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

$listar_campanhas_por_nm_fant = "
    SELECT cli.cd_cli, nm_rz_soc, nm_fant 
    FROM CLIENTES cli
    WHERE cd_tp_cli=2 and 
    (select count(cd_vcl_end) from VCL_ENDERECO vlc where vlc.cd_cli=cli.cd_cli) > 0 and
    (select count(cd_vcl_ctt) from VCL_CONTATO vlc where vlc.cd_cli=cli.cd_cli) > 0                            
    order by nm_fant";

$selecionar_campanha = "
    SELECT * FROM CAMPANHA WHERE cd_cmp = '%d'";

$selecionar_campanha_com_tratamento = "
    SELECT 
    CMP.`cd_cmp`, CMP.`nm_cmp`, 
    CMP.`cd_cli`, 
    CLI.nm_fant,
    `cd_vcl_end`, 
    IF(`cd_tp_srv` = 1, 'Gesto', 'Completo') as nm_tp_srv, 
    IF(`cd_local_srv` = 1, 'In Loco', 'Balcão') as nm_local_srv, 
    date_format(`dt_ini`, '%%d/%m/%Y') AS dt_ini, 
    date_format(`dt_fim`, '%%d/%m/%Y') AS dt_fim
    FROM CAMPANHA CMP, CLIENTES CLI 
    WHERE 
    CMP.cd_cli=CLI.cd_cli AND 
    CMP.cd_cmp = '%d'";

/**************CONTATO*****************/

$selecionar_contato = "
    SELECT * FROM CONTATO WHERE cd_ctt = '%d'";

$listar_contatos_cliente = "
    SELECT `CONTATO`.`cd_ctt`, `nm_ctt`, `tel_pri`, 
    `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
    FROM `CONTATO`, `VCL_CONTATO`
    WHERE 
    `VCL_CONTATO`.`cd_ctt`=`CONTATO`.`cd_ctt` and
    `VCL_CONTATO`.`cd_cli`=%d and status=1 order by `nm_ctt`";

$listar_contatos_campanha = "
    SELECT `CONTATO`.`cd_ctt`, `nm_ctt`, `tel_pri`, 
    `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
    FROM `CONTATO`, `VCL_CTT_CMP`
    WHERE 
    `VCL_CTT_CMP`.`cd_ctt`=`CONTATO`.`cd_ctt` and
    `VCL_CTT_CMP`.`cd_cmp`=%d and `CONTATO`.`status`=1 and `VCL_CTT_CMP`.`ativo`=1 order by `nm_ctt`";

$selecionar_contatos_campanha_status = "
    SELECT cd_vcl_ctt_cmp, ativo FROM VCL_CTT_CMP WHERE cd_cmp = '%d' and cd_ctt = '%d'";

?>