<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Login</title>
    <meta name="description" content="Página para dar de alta un plato">
    <link rel="stylesheet" href="/css/style.css">
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
        <form name="alta_plato" action="/alta_plato" method="POST">
            <label for="nombre">Nombre del plato</label>
            <input type="text" id="nombre" name="nombre" tabindex="1" required autocomplete="on" autofocus>
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" tabindex="2" required autocomplete="on">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" tabindex="3" required autocomplete="on">
            <input type="submit" value="Subir" class="submit">
        </form>
        <?php if ($post) : ?>
            <h3><?= $mensaje ?></h3>
        <?php endif ?>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>