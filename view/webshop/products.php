<?php
$add = $app->url->create("webshop/product/add");
$successMsg = $app->session->getOnce("success");
?>

<div class="container" role="main">
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
                <h1>Product</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Alla produkter</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>
                <a href="<?= $add ?>">Lägg till ny produkt</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table products">
                <thead>
                    <tr class="first">
                        <th>Produkt</th>
                        <th>Antal</th>
                        <th>Hylla</th>
                        <th>Plats</th>
                        <th>Uppdatera</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($resultset as $row) :?>
                    <tr>
                        <td><?= $app->textfilter->esc($row->name) ?></td>
                        <td><?= $app->textfilter->esc($row->amount) ?></td>
                        <td><?= $app->textfilter->esc($row->shelf) ?></td>
                        <td><?= $app->textfilter->esc($row->location) ?></td>
                        <td>
                            <a class="left" href="<?= $app->url->create('webshop/product/update/' . $row->id) ?>"
                                title="Edit">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a class="right" href="<?= $app->url->create('webshop/product/delete/' . $row->id) ?>"
                                title="Delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
