<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>    
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Registrar nueva entrada</h1>

    <?php if(isset($_SESSION['errores'])): ?>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo') : ""; ?>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : ""; ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['entrada'])): ?>
        <?php echo isset($_SESSION['entrada']) ? exito($_SESSION['entrada']) : ""; ?>
    <?php endif; ?>

    <?php $categorias = todasCategorias($db); ?>
    <form action="registrar-entrada.php" method="post" style="margin-top:15px;">
        <label for="titulo">Titulo de la entrada:</label>
        <input type="text" name="titulo">

        <label for="categoria">Categoria</label>
        <select name="categoria" id="">
            <?php if(!empty($categorias)): ?>
                <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" rows="10" cols="50" style="width: 722.05px;" placeholder="Escribre aquí..."></textarea>

        <input type="submit" value="Registrar">
    </form>
    <?php if(isset($_SESSION['errores'])): ?>
        <?php borrarErrores(); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['entrada'])): ?>
        <?php unset($_SESSION['entrada']); ?>
    <?php endif; ?>
</div>
<?php require_once 'includes/footer.php'; ?>

