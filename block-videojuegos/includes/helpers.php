<?php

function mostrarError($errores, $campo){
    $alert = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alert = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }

    return $alert;
}

function exito($success){
    $alert = '';
    if(strcmp($success, "") !== 0){
        $alert = "<div class='alerta'>".$success."</div>";
    }

    return $alert;
}

function borrarErrores($error = ""){
    if(strcmp($error, "") === 0)
        unset($_SESSION['errores']);
    else
        unset($_SESSION['errores'][$error]);
}

function borrarMensaje(){
    unset($_SESSION['categoria']);
}

function conseguirCategorias($db, $categoria = ""){

    $result = array();

    if(strcmp($categoria, "") === 0){
        $sql = "SELECT * FROM categorias ORDER BY id ASC LIMIT 8;";
        $categorias = mysqli_query($db, $sql);
        
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $result = $categorias;
        }
    }else{
        $sql = "SELECT * FROM categorias WHERE nombre = '$categoria';";
        $categorias = mysqli_query($db, $sql);
        
        if($categorias && mysqli_num_rows($categorias) == 1){
            $result = $categorias;
        }
    }
    

    return $result;
}

function conseguirEntradasCategoria($db, $id){

    $result = array();

    $sql = "SELECT e.*, c.nombre AS categoria, c.id AS idC FROM entradas As e ";
    $sql .= "INNER JOIN categorias AS c ";
    $sql .= "ON e.categoria_id = c.Id ";
    $sql .= "WHERE c.id = $id;";
    $categorias = mysqli_query($db, $sql);
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }

    return $result;
}

function categoria($db, $id){

    $result = array();

    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($db, $sql);
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = mysqli_fetch_assoc($categorias);
    }

    return $result;
}


function todasCategorias($db){

    $result = array();

    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($db, $sql);
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }

    return $result;
}

function entrada($db, $id){
    $result = array();

    $sql = "SELECT e.*, u.nombre AS usuario, u.apellidos AS apellidos, c.nombre AS categoria FROM entradas As e ";
    $sql .= "INNER JOIN categorias AS c ";
    $sql .= "ON e.categoria_id = c.Id ";
    $sql .= "INNER JOIN usuarios AS u ";
    $sql .= "ON e.usuario_id = u.Id ";
    $sql .= "WHERE e.id = $id;";
    $categorias = mysqli_query($db, $sql);
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = mysqli_fetch_assoc($categorias);
    }

    return $result;
}

function conseguirEntradas($db , $todas = false){

    if($todas){
        $sql = "SELECT e.*, c.nombre AS categoria, c.id AS idC FROM entradas As e ";
        $sql .= "INNER JOIN categorias AS c ";
        $sql .= "ON e.categoria_id = c.Id ";
        $sql .= "ORDER BY e.Id DESC;";
    }else{
        $sql = "SELECT e.*, c.nombre AS categoria, c.id AS idC FROM entradas As e ";
        $sql .= "INNER JOIN categorias AS c ";
        $sql .= "ON e.categoria_id = c.Id ";
        $sql .= "ORDER BY e.Id DESC LIMIT 4;";
    }
    

    $entradas = mysqli_query($db, $sql);

    $result = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }

    return $result;
}

?>