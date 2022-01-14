<?php require_once 'includes/cabecera.php'; ?>
    
<?php require_once 'includes/lateral.php'; ?>

    <!-- CAJA PRINCIPAL -->
        <div id="principal">
        <?php $categoria = categoria($db, $_GET['id']); ?>
            <h1>Entradas de <?= $categoria['nombre'] ?></h1>
            <?php $entradas = conseguirEntradasCategoria($db, $_GET['id']); ?>
                <?php if(!empty($entradas)): ?>
                    <?php while($entrada = mysqli_fetch_assoc($entradas)): ?>
                        <article class="entrada">
                            <a href="entradaID.php?id=<?= $entrada['id'] ?>"><h2 ><?= $entrada['titulo'] ?></h2></a>
                            <span><?= $entrada['categoria']. " | ".$entrada['fecha'] ?></span>
                            <p>
                            <?= substr($entrada['descripcion'], 0, 180)."..." ?>
                            </p>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
        </div>
    
<?php require_once 'includes/footer.php'; ?>