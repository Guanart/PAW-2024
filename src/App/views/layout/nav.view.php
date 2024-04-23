<nav>
    <ul>
        <?php 
        use Paw\Core\Request;
        $request = new Request;
        foreach ($nav as $item) : ?>
        <li>
            <a href="<?= $item["href"] ?>" 
            class="<?= ($request->url()==$item['href']) ? "selected" : "" ?>">
                <?= $item["name"] ?>
            </a>
        </li>
        <?php endforeach ; ?>
    </ul>
</nav>