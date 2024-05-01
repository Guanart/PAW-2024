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
        <form name="form_register" action="/register" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" tabindex="1" required autofocus>
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" tabindex="1" required autofocus>
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username" tabindex="1" required autofocus>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" tabindex="2" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" tabindex="3" required>
            <label for="repeat-password">Confirmar contraseña</label>
            <input type="password" id="repeatPassword" name="repeatPassword" tabindex="4" required>
            <input type="submit" value="Crear cuenta" class="submit">
            <a href="/login">¿Ya tenés cuenta? Ingresá aca</a>
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