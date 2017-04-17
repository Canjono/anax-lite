<?php
$update = $app->url->create("admin/doUpdate");
$admin = $app->url->create("admin");
$successMsg = $app->session->getOnce("successMsg");
$errorMsg = $app->session->getOnce("errorMsg");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Uppdatera användare</h1>
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
                <input type="hidden" name="oldUsername" value="<?= $user->getUsername() ?>">
                <div class="form-group">
                    <label for="newUsername" class="col-sm-3 control-label">Användarnamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="newUsername" name="newUsername"
                            value="<?= $user->getUsername() ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">Förnamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fname" name="fname"
                            value="<?= $user->getFname() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Efternamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="lname" name="lname"
                            value="<?= $user->getLname() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $user->getEmail() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="permission" class="col-sm-3 control-label">Nivå</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" id="permission" name="permission"
                            min="1" max="2" value="<?= $user->getPermission() ?: 1?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="newPass" class="col-sm-3 control-label">Lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="newPass" name="newPass">
                    </div>
                </div>
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
