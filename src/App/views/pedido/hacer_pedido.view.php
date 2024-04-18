<?php require __DIR__ . "/../layout/head.view.php" ?>
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
        <?php require __DIR__ . "/../layout/nav.view.php"; ?>
    </header>

    <main class="hacer_pedido">
        <h2 class="hacer_pedido">HACE TU PEDIDO, YA!</h2>
        <section class="hacer_pedido">
            <p>¿Cómo lo querés hacer?</p>
            <a class="selected" href="./elegir_local.html">Para llevar</a>
            <a href="./ingresar_direccion.html">Delivery</a>
            <a href="./seleccion_mesa_qr.html">Pedido desde la mesa</a>
        </section>
    </main>

    <?php require __DIR__ . "/../layout/footer.view.php" ?>
</body>

</html>