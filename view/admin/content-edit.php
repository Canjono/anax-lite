<?php
$update = $app->url->create("admin/content/doUpdate");
$admin = $app->url->create("admin/content");
$successMsg = $app->session->getOnce("successMsg");
$errorMsg = $app->session->getOnce("errorMsg");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Uppdatera</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-1 col-sm-6">
            <p>
                <a href="<?= $admin ?>">
                    <button class="btn btn-primary">Tillbaka</button>
                </a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $update ?>" method="POST">
                <div class="form-group">
                    <label for="contentTitle" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="contentTitle" name="contentTitle"
                            value="<?= $app->textfilter->esc($content->title) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentPath" class="col-sm-3 control-label">Path</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="contentPath" name="contentPath"
                            value="<?= $app->textfilter->esc($content->path) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentSlug" class="col-sm-3 control-label">Slug</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="contentSlug" name="contentSlug"
                            value="<?= $app->textfilter->esc($content->slug) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentData" class="col-sm-3 control-label">Data</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="contentData"
                            name="contentData"><?= $app->textfilter->esc($content->data) ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentType" class="col-sm-3 control-label">Type</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="contentType" name="contentType"
                            value="<?= $app->textfilter->esc($content->type) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentFilter" class="col-sm-3 control-label">Filter</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="contentFilter" name="contentFilter"
                            placeholder="e.g. nl2br,bbcode" value="<?= $app->textfilter->esc($content->filter) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contentPublished" class="col-sm-3 control-label">Publish</label>
                    <div class="col-sm-6">
                        <input type="datetime" class="form-control" id="contentPublished" name="contentPublished"
                            placeholder="e.g. 2017-04-24 00:00:00" value="<?= $app->textfilter->esc($content->published) ?>">
                    </div>
                </div>
                <input type="hidden" name="contentId" value="<?= $content->id ?>">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Uppdatera</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">
            <p class="green"><?= $successMsg ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">
            <p class="red"><?= $errorMsg ?></p>
        </div>
    </div>
</div>
