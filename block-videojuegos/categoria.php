<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>    
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <h1>Crear categoria</h1>
    <p>Al crear una nueva categoria permites que otros usuarios registren entradas. A continuación se
        enlistan las categorias actuales.
    </p>

    <?php $categorias = todasCategorias($db); ?>
    <label for="categorias" style="margin-top:10px;">Categorias actuales:</label>
    <select name="categorias" id="dog-names" style="margin-top:10px;">
        <?php if(!empty($categorias)): ?>
            <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                <option value="<?= $categoria['nombre'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endwhile; ?>
        <?php endif; ?>
    </select>

    <h3 style="margin-top:20px;">Registrar categoría</h3>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : ''; ?>
    <?php echo isset($_SESSION['categoria']) ? exito($_SESSION['categoria']) : ''; ?>
    <form action="registrar-categoria.php" method="post">
        <label for="categoria">Nombre de la categoria:</label>
        <input type="text" name="categoria">

        <input type="submit" value="Registrar">
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
                