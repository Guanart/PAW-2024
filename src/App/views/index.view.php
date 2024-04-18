<?php require "layout/head.view.php"; ?>
<body>
    <header>
        <h1>
            <a href="./">
                <picture>
                    <source srcset="./images/Logo(Light).svg" media="(min-width: 600px)">
                    <img alt="pawpower" src="./images/Logo(Light).svg">
                </picture>
            </a>
        </h1>
        <?php require 'layout/nav.view.php'; ?>
    </header>
    <main>
        <section class="principal">
            <h2>
                Bienvenido a PawPower!
            </h2>
            <article class="overflow_hidden">
                <picture>
                    <source srcset="./images/combo1.jpeg" media="(min-width: 600px)">
                    <img alt="pawpower" src="./images/combo1.jpeg">
                </picture>
                <h3>nuevo combo 1</h3>
                <p>Lorem Ipsum</p>
            </article>
            <article class="overflow_hidden">
                <picture>
                    <source srcset="./images/combo2.jpeg" media="(min-width: 600px)">
                    <img alt="pawpower" src="./images/combo2.jpeg">
                </picture>
                <h3>nuevo combo 2</h3>
                <p>Lorem Ipsum</p>
            </article>
            <a href="./pedido/hacer_pedido.html" class="button">HACE TU PEDIDO YA</a>
        </section>
        <section>
            <h2>
                Más comprados
            </h2>
            <article>
                <picture>
                    <source srcset="../images/foto-hamburguesa-5-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/foto-hamburguesa-5-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="../images/foto-hamburguesa-5-S.png" media="(max-width: 480px)">
                    <img src="../images/foto-hamburguesa-5-L.png" >
                </picture>
                <h3>Combo/plato</h3>
                <p>Lorem Ipsum</p>
            </article>
            <article>
                <picture>
                    <source srcset="./images/foto-hamburguesa-2-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-2-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-2-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-2-L.png" >
                </picture>
                <h3>Combo/plato</h3>
                <p>Lorem Ipsum</p>
            </article>
            <article>
                <picture>
                    <source srcset="./images/foto-hamburguesa-3-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-3-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-3-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-3-L.png" >
                </picture>
                <h3>Combo/plato</h3>
                <p>Lorem Ipsum</p>
            </article>
            <a href="/menu">Ver más</a>
        </section>
        <section>
            <h2>Novedades</h2>
            <article class="overflow_hidden informacion">
                <h3>Noticia importante 1</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
                <img src="" alt="noticia">
            </article>
            <article class="overflow_hidden informacion">
                <h3>Noticia importante 1</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
                <img src="" alt="noticia">
            </article>
            <article class="overflow_hidden informacion">
                <h3>Noticia importante 1</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati exercitationem quas, reprehenderit dicta velit ratione esse consequatur deleniti voluptatem, itaque harum reiciendis culpa iure illo aspernatur architecto rerum eveniet recusandae.</p>
                <img src="" alt="noticia">
            </article>
            <a href="./informacion/novedades.html">Ver más</a>
        </section>
    </main>
    
    <?php require 'layout/footer.view.php' ?>
</body>

</html>