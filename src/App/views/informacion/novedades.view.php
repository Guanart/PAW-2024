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
                Últimas novedades
            </h2>
            <article class="informacion">
                <h3>Noticia importante 1</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
                <img src="" alt="noticia">
            </article>
            <article class="informacion">
                <h3>Noticia importante 2</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
                <img src="" alt="noticia">
            </article>
        </section>
        <section class="ratings">
            <h2>
                Reseñas
            </h2>
            <article class="informacion">
                <h3>Muy rico
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrellaMitad"></span>
                </h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
            </article>
            <article class="informacion">
                <h3>Delicioso
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrellaMitad"></span>
                </h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
            </article>
            <article class="informacion">
                <h3>Mal servicio
                    <span class="estrella"></span>
                    <span class="estrellaMitad"></span>
                </h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
            </article>
            <article class="informacion">
                <h3>Muy rico
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrella"></span>
                    <span class="estrellaMitad"></span>
                </h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
            </article>
        </section>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>