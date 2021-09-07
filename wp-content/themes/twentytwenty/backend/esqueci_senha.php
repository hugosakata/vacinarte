<?php
 
if (isset($_GET['sair']))
    setcookie("logado");

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
        // $sql = "
        //     select nm_usu, 
        //     ifnull(bl_sit_usu, 0) as ativo, 
        //     count(tx_log_usu) as existe from LOG_USU 
        //     where tx_log_usu = '{$username}' and pw_usu = '{$password}'";
        $sql = $wpdb->prepare($login , $username, $password );
        $user = $wpdb->get_row($sql);
        if($user->ativo == 1 && $user->existe == 1){
            $msg_err="Bem-vindo " . $user->nm_usu;
            // $location = home_url("/teste/");
            // $pages = get_pages();
            // foreach ( $pages as $page ) {
            //     $msg_err .= get_page_link( $page->ID ) . ",\n";
            // }
            // //exit( wp_redirect( "http://vacinarte-admin.com.br/teste/" ) );

            //seta cookie de logado de meia hora - 0.5 * 3600
            setcookie("logado", 1, (time() + (0.5 * 3600)));



            echo "<script language='javascript' type='text/javascript'>
            window.location.href='{$home}/home/';</script>";
        } else {
            $msg_err="Algo deu errado!\n\nVerifique os dados informados e tente novamente!";
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