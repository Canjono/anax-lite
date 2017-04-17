<?php
$validate = $app->url->create("profile/changePassword/validate");
$errorMsg = $app->session->getOnce("errorMsg");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Byt lösenord</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $validate ?>" method="POST">
                <input type="hidden" name="username" value="<?= $app->user->getUsername() ?>">
                <div class="form-group">
                    <label for="oldPass" class="col-sm-3 control-label">Nuvarande lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="oldPass" name="oldPass" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="newPass" class="col-sm-3 control-label">Nytt lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="newPass" name="newPass" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rePass" class="col-sm-3 control-label">Upprepa nytt lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="rePass" name="rePass" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Byt lösenord</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if ($errorMsg) : ?>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <p class="red"><?= $errorMsg ?></p>
        </div>
    </div>
    <?php endif; ?>
</div>
