<nav>
    <ul>
        <?php foreach ($this->nav as $item) : ?>
        <li>
            <a href="<?= $item["href"] ?>" 
            class="<?= (request()->url()==$item['href']) ? "selected" : "" ?>">
                <?= $item["name"] ?>
            </a>
        </li>
        <?php endforeach ; ?>
    </ul>
</nav>