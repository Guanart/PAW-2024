<?php require __DIR__ . "/../layout/head.view.php"; ?>

<body>
    <header>
        <h1>
            <a href="../">
                <picture>
                    <source srcset="../images/Logo(Light).svg" media="(min-width: 600px)">
                    <img alt="pawpower" src="../images/Logo(Light).svg">
                </picture>
            </a>
        </h1>
        <?php
        require __DIR__ . '/../layout/nav.view.php';
        ?>
    </header>
    <main>
        <h2>Pedidos</h2>
        <a href="/hacer_pedido">Hace un pedido!</a>
        <?php if ($pedidos_usuario) : ?>
            <?php foreach ($pedidos_usuario as $pedido) : ?>
                <article id=<?= $pedido["id_pedido"]; ?>>
                    <h4>Pedido #<?= $pedido["id_pedido"]; ?></h4>
                    <ul>
                        <?php foreach ($pedido["productos"] as $producto) : ?>
                            <li><?= $producto["nombre"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class='seguimientoPedido'></div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No tenés pedidos nuevos.</p>
        <?php endif; ?>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>