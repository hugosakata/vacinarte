<?php
// if($_SERVER["REQUEST_METHOD"] == "GET"){
//   $id_delete = $_GET["delete"];

//   if ($id_delete > 0){
//     $wpdb->delete( 'CLIENTE', array( 'cd_cli' => id_delete ), array( '%d' ) );
//   }
  
// }

// $sql = "
// SELECT cli.cd_cli, nm_rz_soc, nm_fant, cpf_cnpj,
// (select count(cd_vcl_end) from VCL_ENDERECO vlc, ENDERECO ende where vlc.cd_end=ende.cd_end and ende.ativo=1 and vlc.cd_cli=cli.cd_cli) as total_end,
// (select count(cd_vcl_ctt) from VCL_CONTATO vlc, CONTATO ctt where vlc.cd_ctt=ctt.cd_ctt and ctt.status=1 and vlc.cd_cli=cli.cd_cli) as total_ctt
// FROM CLIENTES cli
// WHERE cd_tp_cli=2 order by nm_rz_soc, nm_fant";

$sql = $wpdb->prepare($listar_clientes_pj);

?>