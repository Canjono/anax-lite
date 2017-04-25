<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked">
        <?= $app->textfilter->doFilter($sidebar->data, $sidebar->filter) ?>
    </ul>
</div>
