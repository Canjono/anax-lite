<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Alla sidor</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Klicka på en länk för att visa den formaterade sidan:</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="pages-list">
                <?php foreach ($pages as $page) :?>
                <li>
                    <a href="<?= $app->url->create('content/pages/' . $page->path) ?>">
                        <?= $page->title ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
