<?php /* Template Name: CadastroPJ */

global $wpdb;

get_header(); ?>

<?php

$razao = $nm_fant = $cnpj = $tel = $cel = $email = $logra = $num_logra = "";
$compl_logra = $bairro = $cep = $cidade = $msg_err = "";

 function load(){
    global $razao, $nm_fant, $cnpj, $tel, $cel, $email, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $msg_err;

    $razao = str_replace("'", "", trim($_POST["razao"]));
    $nm_fant = str_replace("'", "", trim($_POST["nm_fant"]));
    $cnpj = str_replace("'", "", trim($_POST["cnpj"]));
    $tel = str_replace("'", "", trim($_POST["tel"]));
    $cel = str_replace("'", "", trim($_POST["cel"]));
    $email = str_replace("'", "", trim($_POST["email"]));
    $logra = str_replace("'", "", trim($_POST["logra"]));
    $num_logra = str_replace("'", "", trim($_POST["num_logra"]));
    $compl_logra = str_replace("'", "", trim($_POST["compl_logra"]));
    $bairro = str_replace("'", "", trim($_POST["bairro"]));
    $cep = str_replace("'", "", trim($_POST["cep"]));
    $cidade = str_replace("'", "", trim($_POST["cidade"]));
 }

 function form_valido() {
    global $razao, $nm_fant, $cnpj, $cel, $tel, $email, $logra, $num_logra,
    $compl_logra, $bairro, $cep, $cidade, $msg_err;

    $valido = false;
    if (!empty($razao) && 
        !empty($nm_fant) && 
        !empty($cnpj) &&
        !empty($cel) &&
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
      $msg_err = "valido";
  } else {
      $msg_err = "Ops! Faltou preencher algum campo obrigatório";
  }
}
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

    <title>Clientes PJ - Cadastro</title>
    <!-- Bootstrap -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cesup Styles -->
    <link href="http://vacinarte-admin.com.br/wp-content/themes/twentytwenty/css/styles.css" rel="stylesheet" >

    <style type="text/css">
        .help-block{ display: block;
                     margin-top: 5px;
                     margin-bottom: 10px;
                     color: #a94442; }
    </style>
  </head>
  <body>
  
<div class="container"><!-- container principal-->
    
    <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header">Cadastro de Cliente PJ
          <br>
            <small>Preencha o formulário abaixo para cadastrar um novo cliente</small>
          </h3>
        </div>
    </div><!-- fecha div row -->

    <center><span class="help-block"><h4><?php echo $msg_err; ?></h4></span></center>

    <div class="row txtbox"><!-- row formulario -->
      <div class="col-lg-12 col-xs-8">
        <form action="#" method="post">
          <div class="row">  
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Razão Social*</label>
              <input type="text" name="razao" class="form-control" placeholder="Razão Social da empresa">
            </div>
            <div class="form-group col-xs-3">
              <label>Nome fantasia*</label>
              <input type="text" name="nm_fant" class="form-control" placeholder="Nome fantasia">
            </div>
            <div class="form-group col-xs-2">
              <label>CNPJ*</label>
              <input type="text" name="cnpj" class="form-control" placeholder="Sem pontos/hífen">
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-xs-2 col-xs-offset-1">
              <label>Falar com</label>
              <input type="text" name="nm_contato" class="form-control" placeholder="Nome do contato">
            </div>

            <div class="form-group col-xs-2">
              <label>Tel. celular</label>
              <input type="text" name="cel" class="form-control" placeholder="Telefone celular">
            </div>
            <div class="form-group col-xs-2">
              <label>Tel. fixo</label>
              <input type="text" name="tel" class="form-control" placeholder="Telefone fixo">
            </div>
            <div class="form-group col-xs-4">
              <label>Email</label>
              <input type="text" name="email" class="form-control" placeholder="xyz@xyz.com - letras minúsculas">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
              <label>Logradouro</label>
              <input type="text" name="logra" class="form-control" placeholder="Rua / Avenida...">
            </div>
            <div class="form-group col-xs-1">
              <label>Número</label>
              <input type="text" name="num_logra" class="form-control" placeholder="Nº">
            </div>
            <div class="form-group col-xs-4 ">
              <label>Complemento</label>
              <input type="text" name="compl_logra" class="form-control" placeholder="Edifício / Andar / Sala">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-3 col-xs-offset-1">
              <label>Bairro</label>
              <input type="text" name="bairro" class="form-control" placeholder="Bairro">
            </div>
            <div class="form-group col-xs-2">
              <label>CEP</label>
              <input type="text" id="cep" name="cep" class="form-control" placeholder="Sem hífen">
            </div>
            <div class="form-group col-xs-3">
              <label>Cidade</label>
              <input type="text" name="cidade" class="form-control" placeholder="Cidade">
            </div>
            <div class="form-group col-xs-1">
              <label>UF</label>
              <select class="selectpicker form-control" name="uf_br">
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
            <div class="col-xs-2 col-xs-offset-1">
              <input type="submit" class="button btn btn-danger " value="Cadastrar">
            </div>
            <div class="col-xs-2 col-xs-offset-1">
              <input class="button btn btn-danger " value="Endereços">
            </div> 
            <div class="col-xs-2 col-xs-offset-1">
              <input class="button btn btn-danger " value="Contatos">
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
