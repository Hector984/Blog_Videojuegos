<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>    
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <?php $entrada = entrada($db, $_GET['id']); ?>
    <h1>Edición de la entrada [<?= $entrada['titulo'] ?>]</h1>
    <h5 style="margin-top:20px;">Creada por: <?= $entrada['usuario'].' '.$entrada['apellidos'] ?></h5>
    <p style="margin-top:20px;">
        Aquí puedes editar los datos de la entrada en caso de que quieras añadir o actualizar los datos.
    </p>

    <form action="actualizar-entrada.php" method="post" style="margin-top:20px;">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo') : ""; ?>
        
        <label for="titulo">Titulo de la entrada:</label>
        <input type="text" value="<?= $entrada['titulo'] ?>">

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : ""; ?>
        <label for="categoria">Categoria actual:</label>
        <input type="text" value="<?= $entrada['categoria'] ?>">

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : ""; ?>
        <label for="descripcion" style="margin-top:10px;">Descripción:</label>
        <textarea name="descripcion" rows="10" cols="50" style="width: 722.05px;margin-top:10px;">
            <?= $entrada['descripcion'] ?>
        </textarea>

        <!-- <input type="submit" value="Editar">
        <input type="submit" value="Borrar"> -->
        <div id="entrada">
            <input type="submit" value="Editar">
            <input type="submit" value="Borrar" style="background-color:#ff0000;">
        </div>
    </form>
    <?php if(isset($_SESSION['errores'])): ?>
        <?php borrarErrores('categoria'); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['categoria'])): ?>
        <?php borrarMensaje(); ?>
    <?php endif; ?>
</div>

<!-- footer -->
<?php require_once 'includes/footer.php'; ?>