<?php
$inventory = $app->url->create("webshop/products");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Webshop</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul>
                <li><a href="<?= $inventory ?>">Lagret</a></li>
            </ul>
        </div>
    </div>
</div>
