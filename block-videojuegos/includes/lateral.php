<!-- BARRA LATERAL -->
<aside id="sidebar">

            <?php if(isset($_SESSION['usuario'])): ?>
                <div id="login" class="bloque">
                    <h3>Bienvenido, <?= $_SESSION['usuario']['nombre']. ' '.$_SESSION['usuario']['apellidos'] ?></h3>
                    <!-- Botones para controlar la sesion -->
                    <a href="entrada.php" class="boton boton-verde">Crear entrada</a>
                    <a href="categoria.php" class="boton">Crear categoria</a>
                    <a href="perfil.php" class="boton boton-naranja">Perfil</a>
                    <a href="cerrar.php" class="boton boton-rojo">Salir</a>
                </div>
            <?php endif; ?>
            
            <?php if(!isset($_SESSION['usuario'])): ?>
                    <?php if(isset($_SESSION['errores']['error_login'])): ?>
                        <div class="alerta alerta-error">
                            <?= $_SESSION['errores']['error_login'] ?>
                        </div>
                    <?php endif; ?>

                    <div id="login" class="bloque">
                        <h3>Identificate</h3>
                        <form action="login.php" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email">

                            <label for="password">Password</label>
                            <input type="password" name="password">

                            <input type="submit" value="Ingresar">
                        </form>
                    </div>

                    <div id="register" class="bloque">
                        
                        <h3>Registrate</h3>
                            
                            <?php if(isset($_SESSION['completado'])): ?>
                                <div class="alerta alerta-exito"><?= $_SESSION['completado'] ?></div>
                            <?php else: ?>
                                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'general') : ''; ?>
                            <?php endif; ?>
                        <form action="registro.php" method="post">

                            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" required>

                            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" required>

                            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>
                            <label for="email">Email</label>
                            <input type="email" name="email" required>

                            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>
                            <label for="password">Password</label>
                            <input type="password" name="password" required>

                            <input type="submit" value="Registrar" name="submit">
                        </form>
                        <?php borrarErrores(); ?>
                    </div>
            <?php endif; ?>
        </aside>