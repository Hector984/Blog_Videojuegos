<?php

require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

// Verificamos si los datos nos llegan
if(isset($_POST)){

    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
    }

    if(isset($_SESSION['entrada'])){
        unset($_SESSION['entrada']);
    }

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,trim($_POST['titulo'])) : false;
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
    $idCategoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    $errores = array();

    if(empty($titulo)){
        $errores['titulo'] = "El titulo no es correcto";
    }

    $longitud = strlen($descripcion);
    if(empty($descripcion) || strlen($descripcion) <= 120){
        $errores['descripcion'] = "La descripcón es incorrecta, está vacía o es muy corta (120 caracteres minimo)";
    }

    if(!is_numeric((int)$idCategoria) || empty($idCategoria)){
        $errores['categoria'] = "La categoria es invalida";
    }

    // Guardamos los datos

    if(count($errores) == 0){
        $usuarioId = $_SESSION['usuario']['id'];
        $sql = "INSERT INTO entradas VALUES (null, $usuarioId, $idCategoria, '$titulo', '$descripcion', CURDATE());";
        $entrada = mysqli_query($db, $sql);

        if($entrada){
            $_SESSION['entrada'] = "La entrada se registró exitosamente";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }

}
    header('Location: entrada.php');
?>