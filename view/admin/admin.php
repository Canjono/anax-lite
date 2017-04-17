<?php
$hits2 = $app->functions->mergeQueryString(['hits' => 2]);
$hits4 = $app->functions->mergeQueryString(['hits' => 4]);
$hits8 = $app->functions->mergeQueryString(['hits' => 8]);
$search = $app->url->create("admin/search");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Admin</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="" method="GET">
                <div class="form-group">
                    <label for="search" class="col-sm-1 control-label">Sök</label>
                    <div class="col-sm-6">
                        <input type="search" class="form-control" id="search" name="search" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>
                <a href="<?= $hits2 ?>">2</a>
                <a href="<?= $hits4 ?>">4</a>
                <a href="<?= $hits8 ?>">8</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="all-users">
                <?= $users ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php for ($i = 1; $i <= $max; $i++) : ?>
                <a href="<?= $app->functions->mergeQueryString(['page' => $i]) ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>
                <a href="admin/add">Lägg till ny användare</a>
            </p>
        </div>
    </div>
</div>
