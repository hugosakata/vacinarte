<?php /* Template Name: CustomPageT1 */

global $wpdb;

get_header(); ?>

<?php
 
// Define variables and initialize with empty values
$username = $password = $msg_err = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
 if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = str_replace("'", "", trim($_POST["username"]));
    $password = str_replace("'", "", trim($_POST["password"]));

    if(empty($username)){
        $username_err = "Campo usuário vazio!";
    } elseif(empty($password)) {
        $password_err = "Campo senha vazio!";
    } else {
        $sql = "SELECT id FROM users WHERE username={$username} and password={$password}";
        $user = $wpdb->get_row($sql);
        if($user->ativo == 1 && $user->existe == 1){
            $msg_err="Bem-vindo " . $user->nome;
        } else {
            $msg_err="Não achou!";
        }
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    
    <div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		    <?php get_template_part( 'template-parts/page/content', 'page' );?>
    
    <center><div class="wrapper">


    <?php
    global $wpdb;

    $user_count = $wpdb->get_row( "SELECT ifnull(teste1, 0) as ativo, count(teste1) as existe FROM TESTE where teste1=2 and teste3=2" );
    echo "<p>ativo: {$user_count->ativo} existe {$user_count->existe}</p>";

    ?>

        <span class="help-block"><?php echo $msg_err; ?></span>

        <h2>Sign Up</h2>
        <p>Digite usuário e senha para começar</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p> -->
        </form>
    </div></center>
    
    </main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
    
</body>
</html>
<?php
get_footer();
?>