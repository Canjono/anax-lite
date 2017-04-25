<div class="container">
    <div class="row">
        <div class="col">
            <?= $app->textfilter->doFilter($flash->data, $flash->filter) ?>
        </div>
    </div>
</div>
