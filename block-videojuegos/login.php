<?php
require_once 'includes/conexion.php';

if(isset($_POST)){

    if(isset($_SESSION['errores']['error_login'])){
        unset($_SESSION['errores']['error_login']);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta para comprobar las credenciales del usuario
    $sql = "SELECT *FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);

        //Comprobar la contraseña
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            $_SESSION['usuario'] = $usuario;
        }else{
            $_SESSION['errores']['error_login'] = "Fallo al iniciar sesión";
        }
    }else{
        $_SESSION['errores']['error_login'] = "El usuario no existe";
    }

}

header('Location: index.php');

?>