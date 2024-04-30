<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Registro</title>
    <meta name="description" content="Página de registro de usuarios">
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
        <form name="form_register" action="register.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" tabindex="1" required autofocus>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" tabindex="2" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" tabindex="3" required>
            <label for="repeat-password">Confirmar contraseña</label>
            <input type="password" id="repeat-password" name="repeat-password" tabindex="4" required>
            <input type="submit" value="Crear cuenta" class="submit">
            <a href="/login">¿Ya tenés cuenta? Ingresá aca</a>
        </form>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>