<?php 
// $sql = "
// SELECT
//   CMP.CD_CMP,
//   CMP.NM_CMP,
//   CMP.CD_CLI,
//   CLI.NM_FANT,
//   CMP.CD_TP_SRV,
//   SRV.NM_TP_SRV,
//   date_format(`DT_INI`, '%d/%m/%Y') AS DT_INI,
//   date_format(`DT_FIM`, '%d/%m/%Y') AS DT_FIM,
//   (select count(cd_vcl_end_cmp) from VCL_END_CMP vlc, ENDERECO ende where vlc.cd_end=ende.cd_end and vlc.ativo=1 and ende.ativo=1 and vlc.CD_CMP=CMP.CD_CMP) as total_end,
//   (select count(cd_vcl_ctt_cmp) from VCL_CTT_CMP vlc, CONTATO ctt where vlc.cd_ctt=ctt.cd_ctt and ctt.status=1 and vlc.ativo=1 AND vlc.CD_CMP=CMP.CD_CMP) as total_ctt,
//   (select count(cd_vcl_vcna_cmp) from VCL_VCNA_CMP vlc, VACINA vcna where vlc.cd_vcna=vcna.cd_vcna and vlc.CD_CMP=CMP.CD_CMP and vlc.ativo=1 and vcna.ativo=1) as total_vcna
// FROM
//   CAMPANHA CMP,
//   TP_SRV SRV, 
//   CLIENTES CLI
  
// WHERE
// CMP.CD_TP_SRV = SRV.CD_TP_SRV and
// CMP.CD_CLI = CLI.CD_CLI and

//   CMP.DT_FIM >= date(now())
// ORDER BY
//   CMP.DT_INI ASC;";
$sql = $wpdb->prepare($listar_campanhas_com_totais );

?>