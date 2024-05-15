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
        <?php
            $pedidos = json_decode(file_get_contents(__DIR__ . '/../../pedidos.json'), true);
            $productos = json_decode(file_get_contents(__DIR__ . '/../../productos.json'), true);
            echo "<h3>Pedidos en curso</h3>";
            echo "<h4>Lo que pediste: </h4>";
        ?>
        <ul>
            <?php 
                $productos_pedido = $pedidos[0]["productos"];
                foreach ($productos_pedido as $producto) : 
            ?>
            <li>
                <?= $producto["nombre"] ?>
            </li>
            <?php endforeach ; ?>
        </ul>
        <div class="turnero"> 
            
        </div>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>