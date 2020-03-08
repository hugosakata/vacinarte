<?php /* Template Name: CadastroCliente */

global $wpdb;

get_header(); ?>

<?php

 function load(){
  $nomePF = str_replace("'", "", trim($_POST["nomePF"]));
  $cpf = str_replace("'", "", trim($_POST["cpf"]));
  $tel = str_replace("'", "", trim($_POST["tel"]));
  $email = str_replace("'", "", trim($_POST["email"]));
  $logra = str_replace("'", "", trim($_POST["logra"]));
  $num_logra = str_replace("'", "", trim($_POST["num_logra"]));
  $compl_logra = str_replace("'", "", trim($_POST["compl_logra"]));
  $bairro = str_replace("'", "", trim($_POST["bairro"]));
  $cep = str_replace("'", "", trim($_POST["cep"]));
  $cidade = str_replace("'", "", trim($_POST["cidade"]));
 }

 function form_valido() {
    $valido = false;
    $msg_err = $nomePF . " valor";
    

    if (!empty($nomePF) && 
        !empty($cpf) &&
        !empty($tel) &&
        !empty($logra) &&
        !empty($num_logra) &&
        !empty($bairro) &&
        !empty($cep) &&
        !empty($cidade)){
          $valido = true;
    }

    return $valido;
 }

 load();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (form_valido()){
      $msg_err .= $_POST["nomePF"];
  } else {
      $msg_err .= $_POST["nomePF"];
  }
}

// Define variables and initialize with empty values
//$username = $password = $msg_err = "";
//$username_err = $password_err = "";

// Processing form data when form is submitted
//  if($_SERVER["REQUEST_METHOD"] == "POST"){
 
//     $username = str_replace("'", "", trim($_POST["username"]));
//     $password = str_replace("'", "", trim($_POST["password"]));

//     if(empty($username)){
//         $username_err = "Campo usuário vazio!";
//     } elseif(empty($password)) {
//         $password_err = "Campo senha vazio!";
//     } else {
//         $sql = "select nm_usu, ";
//         $sql .="ifnull(bl_sit_usu, 0) as ativo, ";
//         $sql .="count(tx_log_usu) as existe from LOG_USU ";
//         $sql .="where tx_log_usu = '{$username}' and pw_usu = '{$password}'";
//         $user = $wpdb->get_row($sql);
//         if($user->ativo == 1 && $user->existe == 1){
//             $msg_err="Bem-vindo " . $user->nm_usu;
//         } else {
//             $msg_err="Não achou!";
//         }
//     }
// }
//         // Prepare a select statement
//         $sql = "SELECT id FROM users WHERE username = ?";
        
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_username);
            
//             // Set parameters
//             $param_username = trim($_POST["username"]);
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 /* store result */
//                 mysqli_stmt_store_result($stmt);
                
//                 if(mysqli_stmt_num_rows($stmt) == 1){
//                     $username_err = "This username is already taken.";
//                 } else{
//                     $username = trim($_POST["username"]);
//                 }
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Validate password
//     if(empty(trim($_POST["password"]))){
//         $password_err = "Please enter a password.";     
//     } elseif(strlen(trim($_POST["password"])) < 6){
//         $password_err = "Password must have atleast 6 characters.";
//     } else{
//         $password = trim($_POST["password"]);
//     }
    
//     // Validate confirm password
//     if(empty(trim($_POST["confirm_password"]))){
//         $confirm_password_err = "Please confirm password.";     
//     } else{
//         $confirm_password = trim($_POST["confirm_password"]);
//         if(empty($password_err) && ($password != $confirm_password)){
//             $confirm_password_err = "Password did not match.";
//         }
//     }
    
//     // Check input errors before inserting in database
//     if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
//         // Prepare an insert statement
//         $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
//             // Set parameters
//             $param_username = $username;
//             $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Redirect to login page
//                 header("location: login.php");
//             } else{
//                 echo "Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }
    
//     // Close connection
//     mysqli_close($link);
//}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clientes - Cadastro</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('logra').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf_br').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logra').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf_br').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logra').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf_br').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

  </head>
  <body>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Cadastro de Cliente PF
          <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <span class="help-block"><?php echo $msg_err; ?></span>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">
          <div class="row">  
            <div class="form-group col-xs-6 col-xs-offset-1">
              <label>Nome*</label>
              <input type="text" name="nomePF" 
                class="form-control" placeholder="Nome do cliente" value="<?php echo $nomePF; ?>">
            </div>
            <div class="form-group col-xs-3">
              <label>CPF*</label>
              <input type="text" name="cpf" 
                class="form-control" placeholder="Digite CPF sem pontos/hífen" value="<?php echo $cpf; ?>">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Tel. celular*</label>
              <input type="text" name="cel" class="form-control" 
                placeholder="Telefone celular" value="<?php echo $cel; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Tel. fixo</label>
              <input type="text" name="tel" class="form-control" 
                placeholder="Telefone fixo" value="<?php echo $tel; ?>">
            </div>
            <div class="form-group col-xs-5">
              <label>Email</label>
              <input type="text" name="email" class="form-control" 
                placeholder="xyz@xyz.com - letras minúsculas" value="<?php echo $email; ?>">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-2">
              <label>CEP*</label>
              <input type="text" name="cep" class="form-control" 
                placeholder="Sem hífen"
              onblur="pesquisacep(this.value);" value="<?php echo $cep; ?>">
            </div>
            <div class="form-group col-xs-6 col-xs-offset-1">
              <label>Logradouro*</label>
              <input type="text" name="logra" class="form-control" 
                placeholder="Rua / Avenida..." value="<?php echo $logra; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label>Número*</label>
              <input type="text" name="num_logra" class="form-control" 
                placeholder="Nº" value="<?php echo $num_logra; ?>">
            </div>
            <div class="form-group col-xs-2">
              <label>Complemento</label>
              <input type="text" name="compl_logra" 
                class="form-control" placeholder="apto / lote / bloco"
                value="<?php echo $compl_logra; ?>">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label>Bairro*</label>
              <input type="text" name="bairro" class="form-control" 
                placeholder="Bairro" value="<?php echo $bairro; ?>">
            </div>
            
            <div class="form-group col-xs-3">
              <label>Cidade*</label>
              <input type="text" name="cidade" class="form-control" 
                placeholder="Cidade" value="<?php echo $cidade; ?>">
            </div>
            <div class="form-group col-xs-1">
              <label>UF*</label>
              <select class="selectpicker form-control" name="uf_br"
              value="<?php echo $uf_br; ?>">
                <option value=""></option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
              </select>
            </div>
          </div>
          <div class="row btns">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Cadastrar">
            </div>  
          </div>

        </form><!-- fecha form -->
      </div><!-- fecha col 12 -->
    </div><!-- fecha row txtbox -->

    


    
</div><!-- fecha container principal -->  


    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/jquery.min.js"></script>
    <script src="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/js/bootstrap.min.js"></script>

  </body>
  </html>
