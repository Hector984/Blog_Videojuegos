<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>    
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <?php $entrada = entrada($db, $_GET['id']); ?>
    <h1><?= $entrada['titulo'] ?></h1>

    <div style="margin-top:20px;">
        <h3>Categoria:</h3>

        <p style="margin-bottom:20px;"><?= $entrada['categoria'] ?></p>

        <h3>Descripción:</h3>
        <p><?= $entrada['descripcion'] ?></p>
    </div>

    <div id="entrada">
        <a href="editar-entrada.php?id=<?= $_GET['id'] ?>"><span>Editar entrada</span></a>
    </div>
    
</div>
<?php require_once 'includes/footer.php'; ?>