<?php
$update = $app->url->create("webshop/product/doUpdate");
$successMsg = $app->session->getOnce("success");
$products = $app->url->create("webshop/products");
$imgName = $content->image ?: "default.jpg";
$img = $app->url->asset("img/webshop/" . $imgName);
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
                <h1>Uppdatera produkt</h1>
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
        <div class="col-sm-9 col-sm-offset-3">
            <img class="game-image" src="<?= $img ?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $update ?>" method="POST">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Namn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $app->textfilter->esc($content->name) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Beskrivning</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="description"
                            name="description"><?= $app->textfilter->esc($content->description) ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Pris</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="price" name="price"
                            value="<?= $app->textfilter->esc($content->price) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="platform" class="col-sm-3 control-label">Plattform</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="platform" name="platform"
                            value="<?= $app->textfilter->esc($content->platform) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Bild</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="image"
                            name="image" value="<?= $app->textfilter->esc($content->image) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="shelf" class="col-sm-3 control-label">Hylla</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="shelf" id="shelf">
                            <?php foreach ($shelves as $shelf) : ?>
                            <option value="<?= $shelf->shelf ?>"
                                <?= $content->shelf === $shelf->shelf ? "selected" : "" ?>>
                                <?= $shelf->shelf ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Antal</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="amount" name="amount"
                            value="<?= $app->textfilter->esc($content->amount) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Kategori</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="category" id="category">
                            <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->category ?>"
                                <?= $content->category === $category->category ? "selected" : "" ?>>
                                <?= $category->category ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $content->id ?>">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Uppdatera</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
