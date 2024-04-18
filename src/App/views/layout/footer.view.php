<footer>
    <nav>
        <ul class="footer-social-links">
            <li>
                <a href="#" rel="external" target="_blank">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="#" rel="external" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="#" rel="external" target="_blank">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="mailto:pawpower@gmail.com"><i class="fa fa-envelope"></i></a>
            </li>
        </ul>
        <ul class="footer-links">
            <?php foreach ($footer as $item) : ?>
            <li>
                <a href="<?= $item["href"] ?>" class="<?= (request()->url()==$item['href']) ? "selected" : "" ?>">
                    <?= $item["name"] ?>
                </a>
            </li>
            <?php endforeach ; ?>
        </ul>
    </nav>
    <small>PawPower <?= date("Y") ?> ©</small>
</footer>
