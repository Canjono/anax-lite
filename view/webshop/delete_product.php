<?php
$delete = $app->url->create("webshop/product/doDelete");
$products = $app->url->create("webshop/products");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Ta bort</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-1 col-sm-6">
            <p>
                <a href="<?= $products ?>">
                    <button class="btn btn-primary">Tillbaka</button>
                </a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $delete ?>" method="POST">
                <div class="form-group">
                    <label for="productName" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="productName" name="productName"
                            value="<?= $app->textfilter->esc($content->name) ?>" readonly>
                    </div>
                </div>
                <input type="hidden" name="productId" value="<?= $content->id ?>">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Ta bort</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>