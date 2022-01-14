<?php


//Validar si llegan los datos del formulario

if(isset($_POST)){
    require_once 'includes/conexion.php';
    
    if(!isset($_SESSION)){
        session_start();
    }

    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db, $_POST["nombre"]) : false ;
    $apellidos = isset($_POST["apellidos"]) ? mysqli_real_escape_string($db,$_POST["apellidos"]) : false;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($db, trim($_POST["email"])) : false;
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($db,$_POST["password"]) : false;
    //NOMBRE
    $nombre_valido = false;
    //APELLIDO PATERNO
    $apellidoP_valido = false;
    //EMAIL
    $email_valido = false;
    //PASSWORD
    $password_valido = false;
    $guardar_usuario = false;
    $password_segura = '';

    //Arreglo de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos

    
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_valido = true;
    }else{
        $errores['nombre'] = "El nombre no es correcto";
    }

    
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidoP_valido = true;
    }else{
        $errores['apellidos'] = "Los apellidos no son correctos";
    }

    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_valido = true;
    }else{
        $errores['email'] = "El email no es correcto";
    }

    
    if(!empty($password)){
        $password_valido = true;
        //CIFRAR LA CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    }else{
        $errores['password'] = "La contraseña esta vacia";
    }

    if(count($errores) == 0){
        //INSERTAR AL USUARIO
        $guardar_usuario = true;

        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);
        
        // var_dump($db);
        // die();

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = 'Fallo al registrar';
        }

    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');
?>