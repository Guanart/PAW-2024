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
        <form name="login" action="/login" method="POST">
            <label for="mail">Correo electrónico</label>
            <input type="email" id="mail" name="email" tabindex="1" required autocomplete="on" autofocus>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" tabindex="2" required autocomplete="on">
            <a href="/forgot_password">¿Has olvidado tu contraseña?</a>
            <input type="submit" value="Ingresar" class="submit">
            <a href="/register">¿No estas registrado? Crea tu cuenta</a>
        </form>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>