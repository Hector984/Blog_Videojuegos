<?php

require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
// verificamos que lleguen los datos

if(isset($_POST)){

    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
    }

    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : "";

    // Verificar que la categoria no este vacia
    if(strcmp($categoria, "") === 0){
        $_SESSION['errores']['categoria'] = "La categoria no puede ser vacia";

        header("Location:categoria.php");
    }else if(mysqli_num_rows(conseguirCategorias($db, $categoria)) > 1){
        $_SESSION['errores']['categoria'] = "La categoria ya existe";
    
        header("Location:categoria.php");
    }

    // Registramos la nueva categoria
    $sql = "INSERT INTO categorias VALUES (null, '$categoria');";
    $categoriaNueva = mysqli_query($db, $sql);

    if($categoriaNueva){
        $_SESSION['categoria'] = "Categoria registrada";
    }
    
    // var_dump(conseguirCategorias($db));

    // die();

    
}

header("Location:categoria.php");
?>