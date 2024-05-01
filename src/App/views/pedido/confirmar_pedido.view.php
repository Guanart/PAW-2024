<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Confirmar pedido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <meta name="description" content="Pagina de confirmacion del pedido">
    <link rel="stylesheet" href="css/style.css">
</head>

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
        <?php if ($mostrarPost) : ?>
            <h3><?= $mensaje ?></h3>
        <?php endif ?>
        <section>
            <h2>Confirme su pedido</h2>
            <article class="confirmar_pedido">
                <h3>Hamburguesa 1</h3>
                <p>Descripción 1</p>
                <p>Cantidad: 2</p>
            </article>
            <article class="confirmar_pedido">
                <h3>Hamburguesa 2</h3>
                <p>Descripción 2</p>
                <p>Cantidad: 1</p>
            </article>
            <article class="confirmar_pedido">
                <h3>Hamburguesa 3</h3>
                <p>Descripción 3</p>
                <p>Cantidad: 3</p>
            </article>
        </section>
        <form name="form_confirmar_pedido" action="/confirmar_pedido" method="post">
                <?php foreach ($formularioDatos as $nombre => $valor): ?>
                    <input type="hidden" name="<?php echo $nombre; ?>" value="<?php echo $valor; ?>">
                <?php endforeach; ?>
            <fieldset>
                <label for="input_nombre">A nombre de:</label>
                <input id="input_nombre" name="input_nombre" type="text" placeholder="Ej: Francisco Guerra">
                <label for="input_info_adicional">Información adicional:</label>
                <input id="input_info_adicional" name="input_info_adicional" type="text">
            </fieldset>
            <input type="submit" value="Confirmar" class="submit">
        </form>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>