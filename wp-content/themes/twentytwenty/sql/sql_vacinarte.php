<?php

    /****************LOGIN**************/
    $login = "
            select nm_usu, 
            ifnull(bl_sit_usu, 0) as ativo, 
            count(tx_log_usu) as existe from LOG_USU 
            where tx_log_usu = '%s' and pw_usu = '%s'";

    /****************CAMPANHA*******************/

    $selecionar_total_campanha_ativa = "
        SELECT COUNT(CD_CMP) QTD_CMP FROM CAMPANHA WHERE DT_FIM >= date(NOW());";

    $listar_campanhas = "
        SELECT 
        CAMPANHA.`cd_cmp`, `nm_cmp`, `nm_fant`, `cd_vcl_end`, `nm_tp_srv`, 
        date_format(`dt_ini`, '%%d/%m/%Y') AS dt_ini, 
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
    
    $listar_campanhas_com_totais = "
        SELECT
          CMP.CD_CMP,
          CMP.NM_CMP,
          CMP.CD_CLI,
          CLI.NM_FANT,
          CMP.CD_TP_SRV,
          SRV.NM_TP_SRV,
          date_format(`DT_INI`, '%%d/%m/%Y') AS DT_INI,
          date_format(`DT_FIM`, '%%d/%m/%Y') AS DT_FIM,
          (select count(cd_vcl_end_cmp) from VCL_END_CMP vlc, ENDERECO ende where vlc.cd_end=ende.cd_end and vlc.ativo=1 and ende.ativo=1 and vlc.CD_CMP=CMP.CD_CMP) as total_end,
          (select count(cd_vcl_ctt_cmp) from VCL_CTT_CMP vlc, CONTATO ctt where vlc.cd_ctt=ctt.cd_ctt and ctt.status=1 and vlc.ativo=1 AND vlc.CD_CMP=CMP.CD_CMP) as total_ctt,
          (select count(cd_vcl_vcna_cmp) from VCL_VCNA_CMP vlc, VACINA vcna where vlc.cd_vcna=vcna.cd_vcna and vlc.CD_CMP=CMP.CD_CMP and vlc.ativo=1 and vcna.ativo=1) as total_vcna
        FROM
          CAMPANHA CMP,
          TP_SRV SRV, 
          CLIENTES CLI
          
        WHERE
        CMP.CD_TP_SRV = SRV.CD_TP_SRV and
        CMP.CD_CLI = CLI.CD_CLI and
        
          CMP.DT_FIM >= date(now())
        ORDER BY
          CMP.DT_INI ASC;";

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

    $selecionar_contatos_campanha_group = "
        SELECT GROUP_CONCAT(DISTINCT cd_ctt
        ORDER BY cd_ctt
        SEPARATOR ',') as cd_ctts FROM `VCL_CTT_CMP` where cd_cmp='%d' and `VCL_CTT_CMP`.ativo=1";

    $selecionar_contatos_cliente = "
        SELECT 
        (select count(cd_vcl_ctt_cmp) from `VCL_CTT_CMP` where `VCL_CTT_CMP`.cd_ctt=CONTATO.cd_ctt and 
        `VCL_CTT_CMP`.cd_cmp=%d and `VCL_CTT_CMP`.ativo=1) as total,
        CONTATO.`cd_ctt`, `nm_ctt`, `tel_pri`, `tel_sec`, `email`, `linkedin`, `site_blog`, `obs_ctt` 
        FROM `CONTATO` as CONTATO, 
        `VCL_CONTATO` as VCL_CONTATO 
        WHERE 
        CONTATO.cd_ctt=VCL_CONTATO.cd_ctt and 
        VCL_CONTATO.cd_cli=%d and status=1 order by `nm_ctt`";
        

    /*************CLIENTE************/

    $selecionar_cliente = "
        SELECT * FROM CLIENTES WHERE cd_cli = '%d'";

    $selecionar_total_clientes_pf = "
        SELECT count(*) as total FROM CLIENTES where cd_tp_cli=1";

    $selecionar_total_clientes_pj = "
        SELECT count(*) as total FROM CLIENTES where cd_tp_cli=2";

    $listar_clientes_pj = "
        SELECT cli.cd_cli, nm_rz_soc, nm_fant, cpf_cnpj,
        (select count(cd_vcl_end) from VCL_ENDERECO vlc, ENDERECO ende where vlc.cd_end=ende.cd_end and ende.ativo=1 and vlc.cd_cli=cli.cd_cli) as total_end,
        (select count(cd_vcl_ctt) from VCL_CONTATO vlc, CONTATO ctt where vlc.cd_ctt=ctt.cd_ctt and ctt.status=1 and vlc.cd_cli=cli.cd_cli) as total_ctt
        FROM CLIENTES cli
        WHERE cd_tp_cli=2 order by nm_rz_soc, nm_fant";

    /**************ENDERECO************/
    $selecionar_endereco_campanha_group = "
        SELECT GROUP_CONCAT(DISTINCT cd_end
        ORDER BY cd_end
        SEPARATOR ',') as cd_ends FROM `VCL_END_CMP` where cd_cmp='%d' and `VCL_END_CMP`.ativo=1";

    $selecionar_enderecos_campanha_status = "
        SELECT cd_vcl_end_cmp, ativo FROM VCL_END_CMP WHERE cd_cmp = '%d' and cd_end = '%d'";

    $selecionar_enderecos_cliente = "
        SELECT 
        (select count(cd_vcl_end_cmp) from `VCL_END_CMP` where `VCL_END_CMP`.cd_end=ENDERECO.cd_end and 
        `VCL_END_CMP`.cd_cmp=%d and `VCL_END_CMP`.ativo=1) as total,
        ENDERECO.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `ativo` 
        FROM `ENDERECO` as ENDERECO, 
        `VCL_ENDERECO` as VCL_ENDERECO 
        WHERE 
        ENDERECO.cd_end=VCL_ENDERECO.cd_end and 
        VCL_ENDERECO.cd_cli=%d and ativo=1 order by `nm_end`, `logradouro`";
    
    $selecionar_enderecos_campanha = "
        SELECT 
        `ENDERECO`.cd_end, `nm_end`, `logradouro`, `num_end`, `bairro`, `cep`, `cidade`, `estado`, `VCL_END_CMP`.`ativo` 
        FROM `ENDERECO`,
        `VCL_END_CMP`
        WHERE 
        `ENDERECO`.cd_end=`VCL_END_CMP`.cd_end and 
        `VCL_END_CMP`.cd_cmp=%d and 
        `VCL_END_CMP`.ativo=1 and 
        `ENDERECO`.ativo=1 and `VCL_END_CMP`.ativo=1 order by `nm_end`, `logradouro`";

    /**************VACINA*************/

    $selecionar_vacinas_campanha = "
        SELECT * FROM `VCL_VCNA_CMP`, `VACINA`
        WHERE VCL_VCNA_CMP.cd_vcna=VACINA.cd_vcna and
        VCL_VCNA_CMP.cd_vcl_vcna_cmp = '%d'";

    $selecionar_vinculo_vacina = "
        SELECT * FROM VCL_VCNA_CMP WHERE cd_vcna = '%d'";

    $listar_vacinas = "
        SELECT
        a.cd_vcna,
        a.nm_reg,
        a.cd_fbcnte_vcna,
        b.nm_fbcnte_vcna
        FROM
        VACINA a
        LEFT JOIN
        FBCNTE_VCNA b on a.cd_fbcnte_vcna = b.cd_fbcnte_vcna";

    $listar_vacinas_campanha = "
      SELECT 
      `VCL_VCNA_CMP`.cd_vcl_vcna_cmp, 
      `VACINA`.`cd_vcna`, 
      `nm_reg`, 
      `nm_gen`, 
      `FBCNTE_VCNA`.`nm_fbcnte_vcna`,
      `obs_vcna`, 
      `VCL_VCNA_CMP`.qtd_vcna_contratada, 
      `VCL_VCNA_CMP`.vlr_vcna, 
      `VCL_VCNA_CMP`.qtd_vcna_restante
      FROM `VACINA`, `VCL_VCNA_CMP`, `FBCNTE_VCNA`
      WHERE 
      `VCL_VCNA_CMP`.`cd_vcna`=`VACINA`.`cd_vcna` and
      `VCL_VCNA_CMP`.`cd_cmp`=%d and `VCL_VCNA_CMP`.`ativo`=1 and `VACINA`.`ativo`=1 and
      `FBCNTE_VCNA`.`cd_fbcnte_vcna`=`VACINA`.`cd_fbcnte_vcna` order by `nm_reg`
      ";
    /***********AGENDAMENTO*************/

    $selecionar_total_agendamento_ativo = "
        SELECT COUNT(CD_ATEND) QT_AGENDA FROM ATENDIMENTO WHERE DT_ATEND >= date(NOW()) AND BL_FECHAMENTO = 0;";

    $selecionar_agendamento = "
        SELECT
        ATEND.CD_ATEND,
        ATEND.CD_CMP,
        CMP.NM_CMP,
        date_format(`DT_ATEND`, '%%d/%m/%Y') AS DT_ATEND, 
        ATEND.NM_ENFERMEIRO,

        VCNA.NM_REG,

        VVA.CD_VCL_VCNA_ATEND,
        VVA.QTD_VCNA_RETORNO,
        VVA.QTD_VCNA_ENVIO,
        VVA.qtd_cortesia
        FROM
        ATENDIMENTO ATEND,
        VCL_VCNA_ATEND VVA,
        VCL_VCNA_CMP VVC,
        CAMPANHA CMP,
        VACINA VCNA
        WHERE
        ATEND.CD_ATEND = %d AND
        ATEND.CD_ATEND = VVA.CD_ATEND AND
        CMP.CD_CMP     = ATEND.CD_CMP AND
        VVA.cd_vcl_vcna_cmp    = VVC.cd_vcl_vcna_cmp AND
        VCNA.cd_vcna = VVC.cd_vcna";

    $listar_agendamentos = "
        SELECT 
            `cd_atend`,
            `nm_cmp`,
            `nm_fant`,
            `ENDERECO`.`logradouro`,
            `ENDERECO`.`nm_end`,
            `ENDERECO`.`num_end`,
            `ENDERECO`.`complemento`,
            `ENDERECO`.`bairro`,
            `ENDERECO`.`cep`,
            `ENDERECO`.`cidade`,
            `ENDERECO`.`estado`,
            date_format(`dt_atend`, '%%d/%m/%Y') AS dt_atend,
            `hr_ini`,
            `hr_fim`,
            `nm_enfermeiro`
        FROM
            `ATENDIMENTO`,
            `CAMPANHA`,
            `CLIENTES`,
            `VCL_END_CMP`,
            `VCL_ENDERECO`,
            `ENDERECO`
        WHERE
            `ATENDIMENTO`.`cd_cmp` = `CAMPANHA`.`cd_cmp`
          AND `CAMPANHA`.`cd_cli` = `CLIENTES`.`cd_cli`
          AND `CAMPANHA`.`cd_cmp` = `VCL_END_CMP`.`cd_cmp`
            and `VCL_END_CMP`.`cd_end` = `VCL_ENDERECO`.`cd_end`
          AND `VCL_ENDERECO`.`cd_end` =  `ENDERECO`.`cd_end`
          AND `ATENDIMENTO`.`bl_fechamento` = 0
            AND `ATENDIMENTO`.`dt_atend` >= date(now())
        ORDER BY `cd_atend` DESC";

?>