<?php
$users = $app->url->create("admin/users");
$content = $app->url->create("admin/content");
$webshop = $app->url->create("webshop");
?>
<div class="container pages">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Admin</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= $users ?>">
                <div class="jumbotron">
                    <h2>Redigera användare</h2>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="<?= $content ?>">
                <div class="jumbotron">
                    <h2>Redigera innehåll</h2>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="<?= $webshop ?>">
                <div class="jumbotron">
                    <h2>Webshoppen</h2>
                </div>
            </a>
        </div>
    </div>
</div>
