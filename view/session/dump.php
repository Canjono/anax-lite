<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Session Dump</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <pre><?= $app->session->dump() ?></pre>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= $app->url->create('session') ?>">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>
</div>
