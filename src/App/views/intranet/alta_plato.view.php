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
        <form name="alta_plato" action="/alta_plato" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre del plato</label>
            <input type="text" id="nombre" name="nombre" tabindex="1" required autocomplete="on" autofocus>
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" tabindex="2" required autocomplete="on">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" min="0" max="999999" tabindex="3" required autocomplete="on">
            <input class="inputfile" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required data-multiple-caption="{count} files selected" multiple>
            <label class="submit" for="imagen">Subir Imagen</label>
            <input type="submit" value="Subir" class="submit">
        </form>
        <?php if ($post) : ?>
            <h3><?= $mensaje ?></h3>
        <?php endif ?>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
    <script>
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function(input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener('change', function(e) {
                var fileName = '';
                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                else
                    fileName = e.target.value.split('\\').pop();
                if (fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
        });
    </script>
</body>

</html>