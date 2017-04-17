<?php
$update = $app->url->create("profile/update");
$changePassword = $app->url->create("profile/changePassword");
$successMsg = $app->session->getOnce("successMsg");
$errorMsg = $app->session->getOnce("errorMsg");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Profil (<?= $app->user->getUsername() ?>)</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $update ?>" method="POST">
                <input type="hidden" name="username" value="<?= $app->user->getUsername() ?>">
                <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">Förnamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fname" name="fname"
                            value="<?= $app->user->getFname() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Efternamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="lname" name="lname"
                            value="<?= $app->user->getLname() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $app->user->getEmail() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass" class="col-sm-3 control-label">Lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                </div>
                <input type="hidden" name="permission" value="<?= $app->user->getPermission() ?>">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Uppdatera</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p>
                <a href="<?= $changePassword ?>">Byt lösenord</a>
            </p>
        </div>
    </div>
    <?php if ($successMsg) : ?>
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <p class="green"><?= $successMsg ?></p>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($errorMsg) : ?>
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <p class="red"><?= $errorMsg ?></p>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-3">
            <p class="right-align">$_COOKIE</p>
        </div>
        <div class="col-md-6">
            <pre>
                <p><?= $app->cookie->dump() ?></p>
            </pre>
        </div>
    </div>
</div>
