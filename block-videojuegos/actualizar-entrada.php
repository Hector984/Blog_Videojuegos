<?php

require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

// Verificamos si los datos nos llegan
if(isset($_POST)){

    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
    }

    if($_POST['Borrar']){

    }else{
        $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,trim($_POST['titulo'])) : false;
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        $errores = array();

        if(empty($titulo)){
            $errores['titulo'] = "El titulo no es correcto (no puede estar vacio)";
        }

        $longitud = strlen($descripcion);
        if(empty($descripcion) || strlen($descripcion) <= 120){
            $errores['descripcion'] = "La descripcón es incorrecta, está vacía o es muy corta (120 caracteres minimo)";
        }

        if(empty($categoria)){
            $errores['categoria'] = "La categoria es invalida (esta vacia)";
        }

        // Guardamos los datos

        if(count($errores) == 0){
            $usuarioId = $_SESSION['usuario']['id'];
            $sqlCategoria = "SELECT * FROM categorias WHERE nombre = '$categoria';";
            $getCategoria = mysqli_query($db, $sqlCategoria);
            $dataCategoria = mysqli_fetch_assoc($getCategoria);
            $idCategoria = $dataCategoria['id'];

            $sql = "UPDATE entradas SET categoria_id = $idCategoria, nombre='$titulo', descripcion ='$descripcion', email = '$email' WHERE id = $idUsuario;";
            $entrada = mysqli_query($db, $sql);

            if($entrada){
                $_SESSION['entrada'] = "La entrada se actualizó exitosamente";
            }
        }else{
            $_SESSION['errores'] = $errores;
        }
    }

}
    header('Location: entrada.php');
?>