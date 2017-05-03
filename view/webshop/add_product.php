<?php
$add = $app->url->create("webshop/product/doAdd");
$successMsg = $app->session->getOnce("success");
$products = $app->url->create("webshop/products");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if ($successMsg) : ?>
            <div class="alert alert-success alert-dismissable"  role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $successMsg ?>
            </div>
            <?php endif; ?>
            <div class="page-header">
                <h1>Lägg till ny produkt</h1>
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
            <form class="form-horizontal" action="<?= $add ?>" method="POST">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Namn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Antal</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="amount" name="amount"
                            min="1" max="1000" value="1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="shelf" class="col-sm-3 control-label">Hylla</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="shelf" id="shelf">
                            <?php foreach ($shelves as $shelf) : ?>
                            <option value="<?= $shelf->shelf ?>">
                                <?= $shelf->shelf ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Lägg till</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
