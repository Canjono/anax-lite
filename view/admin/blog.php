<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Alla inlägg i databasen</h1>
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
                <?php foreach ($posts as $post) :?>
                    <tr>
                        <td><?= $post->id ?></td>
                        <td>
                            <a href="?route=<?= $post->path ?>"><?= $post->title ?></a>
                        </td>
                        <td><?= $app->textfilter->esc($post->published) ?></td>
                        <td><?= $app->textfilter->esc($post->created) ?></td>
                        <td><?= $app->textfilter->esc($post->updated) ?></td>
                        <td><?= $app->textfilter->esc($post->deleted) ?></td>
                        <td><?= $app->textfilter->esc($post->path) ?></td>
                        <td><?= $app->textfilter->esc($post->slug) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
