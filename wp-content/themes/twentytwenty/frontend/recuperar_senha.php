<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recuperar Senha</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="css/styles.css" rel="stylesheet" >
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<style>
.tit {
    margin-top: 20px;
    font-size: 25px;
    color: tomato;
}
.warn {
    margin: 0 0 10px;
    color: tomato;
    font-size: 15px;
}
</style>
<body class="corpo">
    
    
    <div class="wrap">
	
        <center><p class="tit">Recuperar senha</p></center>
        
        <form action="<?php echo $home; ?>/recuperarsenha/?<?php if ($acao=="send_email") echo "acao=new_pass"; else "acao=send_email";?>" method="post" style="margin-top: -2vw;">

            <!-- etapa 1 -->
            <div id="div_email" style="margin-top: 200px;">
                <div class="col-xs-offset-4 col-xs-4" >
                    <input type="text" id="to_mail" name="to_mail" class="form-control" placeholder="Digite seu email"
                    value=""/>
                </div>
            </div>

            <!-- etapa 2 -->
            <?php if ($acao =="send_email") { ?>
                <div id="div_novapass" style="margin-top: 200px;">
                    <div class="col-xs-offset-4 col-xs-4" >
                        <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Digite o código recebido"
                        value=""/>
                    </div>
                    <div class="col-xs-offset-4 col-xs-4" style="margin-top: 20px;">
                        <input type="password" id="novapass" name="novapass" class="form-control " placeholder="Digite nova senha"
                        value=""/>
                    </div>
                    <a href="<?php echo $home; ?>/recuperarsenha/?acao=send_email">
                        <i class="material-icons" style="color: tomato; font-size: 43px; margin-top: 50px; cursor: pointer;">send</i>
                    </a>

                </div>
            <?php }?>
            <input id="btn" type="submit" class="button btn btn-danger btn_geral" value="Enviar"/>
        </form>
		      
        

    </div></center>

	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>