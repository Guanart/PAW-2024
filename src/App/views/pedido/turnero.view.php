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
            // $pedidos = json_decode(file_get_contents(__DIR__ . '/../../pedidos.json'), true);
            echo "<h3>Pedidos en curso</h3>";
            // Debería estar logeado
            // Debería obtener el id del usuario (cuando usemos cookies o sesiones), y con eso buscar si tiene un pedido.

            // $id_usuario = "123"; // Hardcodeado :)
            // $pedido_usuario = null;
            // foreach ($pedidos as $pedido) {
            //     // Debería agregar a una lista TODOS los pedidos sin completar, aca busca solo un pedido de un usuario
            //     if ($pedido["id_usuario"] === $id_usuario) {
            //         $pedido_usuario = $pedido;
            //     }
            // }
            // Imprimir el pedido encontrado
            if ($pedidos_usuario) {
                foreach ($variable as $key => $value) {
                    # code...
                }                
                $productos = $pedido_usuario["productos"];
                echo "<ul>";
                foreach ($productos as $producto) {
                    echo "<li>";
                    echo $producto["nombre"];
                    echo "</li>";
                }
                echo "</ul>";
                echo "<div class='seguimientoPedido'></div>";
            } else {
                echo "No tenes pedidos nuevos";
            }
        ?>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>