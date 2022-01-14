<?php
require_once 'includes/conexion.php';

if(isset($_POST)){

    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
    }

    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db, $_POST["nombre"]) : false ;
    $apellidos = isset($_POST["apellidos"]) ? mysqli_real_escape_string($db,$_POST["apellidos"]) : false;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($db, trim($_POST["email"])) : false;
    $idUsuario = $_SESSION['usuario']['id'];

    // Comprobar que lleguen completos los datos
    if(empty($nombre) && is_numeric($nombre) && preg_match("/[0-9]/", $nombre)){
        $errores['nombre'] = "El nombre no es correcto";
    }
    
    if(empty($apellidos) && is_numeric($apellidos) && preg_match("/[0-9]/", $apellidos)){
        $errores['apellidos'] = "Los apellidos no son correctos";
    }
    
    if(empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "El email no es correcto";
    }

    // Verificamos si el email ya existe
    $query = "SELECT id, email FROM usuarios WHERE email = '$email'";
    // $query2 = "SELECT id, email FROM usuarios WHERE id = '$idUsuario'";
    $verify = mysqli_query($db, $query);
    $usuarioDB = mysqli_fetch_assoc($verify);
    

    if(strcmp($usuarioDB['email'], $_SESSION['usuario']['email']) !== 0 && mysqli_num_rows($verify) == 1){
        $errores['usuarioExiste'] = "El email ya existe";
    }
    
    if(count($errores) == 0 && strcmp($usuarioDB['email'], $_SESSION['usuario']['email']) === 0){
        //Consulta para actualizar el usuario
        $sql = "UPDATE usuarios SET nombre='$nombre', apellidos ='$apellidos', email = '$email' WHERE id = $idUsuario;";
        
        $actualizar = mysqli_query($db, $sql);

        // var_dump($db);
        // die();

        if($actualizar){
            $_SESSION['actualizar'] = "Se ha actualizado la información del usuario";
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
        }else{
            $_SESSION['errores']['general'] = 'Fallo al actualizar';
        }

    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: perfil.php');

?>