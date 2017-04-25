<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1><?= $post->title ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $app->textfilter->doFilter($post->data, $post->filter) ?>
        </div>
    </div>
</div>
