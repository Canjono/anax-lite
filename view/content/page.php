<div class="container pages">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1><?= $page->title ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $app->textfilter->doFilter($page->data, $page->filter) ?>
        </div>
    </div>
</div>