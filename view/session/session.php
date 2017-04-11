<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Test the session - choose route</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Current value: <?= $app->session->get("number") ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Button links">
                <a href="<?= $app->url->create('session/increment') ?>">
                    <button class="btn btn-primary">Increment</button>
                </a>
                <a href="<?= $app->url->create('session/decrement') ?>">
                    <button class="btn btn-primary">Decrement</button>
                </a>
                <a href="<?= $app->url->create('session/status') ?>">
                    <button class="btn btn-primary">Status</button>
                </a>
                <a href="<?= $app->url->create('session/dump') ?>">
                    <button class="btn btn-primary">Dump</button>
                </a>
                <a href="<?= $app->url->create('session/destroy') ?>">
                    <button class="btn btn-primary">Destroy</button>
                </a>
            </div>
        </div>
    </div>
</div>
