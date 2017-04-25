<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Alla block i databasen</h1>
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
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($blocks as $block) :?>
                    <tr>
                        <td><?= $block->id ?></td>
                        <td>
                            <a href="?route=<?= $block->path ?>"><?= $block->title ?></a>
                        </td>
                        <td><?= $block->published ?></td>
                        <td><?= $block->created ?></td>
                        <td><?= $block->updated ?></td>
                        <td><?= $block->deleted ?></td>
                        <td><?= $block->path ?></td>
                        <td><?= $block->slug ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
