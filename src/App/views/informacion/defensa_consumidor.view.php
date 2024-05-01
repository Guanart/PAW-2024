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
        <section class="informacion">
            <h2>
                Defensa del consumidor
            </h2>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit
                dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo
                aspernatur architecto rerum eveniet recusandae.
            </p>
        </section>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>