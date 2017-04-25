<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Bloggen</h1>
            </div>
        </div>
    </div>
    <?php foreach ($posts as $post) : ?>
    <div class="row">
        <div class="col">
            <header>
                <h2><a href="<?= $app->url->create('content/blog/' . $post->slug) ?>"><?= $post->title ?></a></h2>
                <p><i>Published: <time datetime="<?= $post->published ?>"
                    pubdate="<?= $post->published ?>"><?= $post->published ?></time></i>
                </p>
                <?= $post->data ?>
            </header>
        </div>
    </div>
    <?php endforeach; ?>
</div>
