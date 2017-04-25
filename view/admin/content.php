<?php
$add = $app->url->create("admin/content/add")

?>

<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Allt innehåll</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr class="first">
                        <th>Id</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Deleted</th>
                        <th>Path</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($content as $row) :?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $app->textfilter->esc($row->title) ?></td>
                        <td><?= $app->textfilter->esc($row->published) ?></td>
                        <td><?= $app->textfilter->esc($row->created) ?></td>
                        <td><?= $app->textfilter->esc($row->updated) ?></td>
                        <td><?= $app->textfilter->esc($row->deleted) ?></td>
                        <td><?= $app->textfilter->esc($row->path) ?></td>
                        <td><?= $app->textfilter->esc($row->slug) ?></td>
                        <td>
                            <a class="left" href="<?= $app->url->create('admin/content/update/' . $row->id) ?>"
                                title="Edit">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a class="right" href="<?= $app->url->create('admin/content/delete/' . $row->id) ?>"
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
    <div class="row">
        <div class="col">
            <p>
                <a href="<?= $add ?>">Lägg till nytt innehåll</a>
            </p>
        </div>
    </div>
</div>
