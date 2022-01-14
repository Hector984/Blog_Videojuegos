<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>    
<?php require_once 'includes/lateral.php'; ?>

<!-- Contenedor -->
<div class="" id="principal">
    <h1 style="margin-bottom:20px;">Información del usuario</h1>

    <?php if(isset($_SESSION['actualizar'])): ?>
        <div class="alerta alerta-exito"><?= $_SESSION['actualizar'] ?></div>
    <?php else: ?>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'general') : ''; ?>
    <?php endif; ?>

    <form action="actualizar-perfil.php" method="post">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>">

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>">

        <input type="submit" value="Actualizar">
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>