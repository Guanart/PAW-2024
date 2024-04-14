<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Contactos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <meta name="description" content="Vías de  contacto con Burger Heaven">
    <link rel="stylesheet" href="../css/style.css">
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
        <h2>
            Contactanos!
        </h2>
        <?php if ($procesado) : ?>
            <h3> Su peticion fue procesada con exito</h3>
        <?php endif ?>
        <form id="formulario" method="POST">
            <label for="nombres">Nombres: </label>
            <input type="text" id="nombres" placeholder="Nombres" required>
            <label for="apellidos">Apellidos: </label>
            <input type="text" id="apellidos" placeholder="Apellidos" required>
            <label for="email">Correo electrónico: </label>
            <input type="text" id="email" placeholder="Correo electrónico" required>
            <label for="asunto">Asunto: </label>
            <input type="text" id="asunto" placeholder="Asunto" required>
            <label for="mensaje">Detalles de la consulta:</label>
            <textarea id="mensaje" placeholder="Detalle su consulta o problema" rows="6"></textarea>
            <input type="submit" value="Enviar" class="submit">
        </form>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>