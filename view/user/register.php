<?php
$validate = $app->url->create("register/validate");
$errorMsg = $app->session->getOnce("errorMsg");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Registrera ny användare</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="form-horizontal" action="<?= $validate ?>" method="POST">
                <div class="form-group">
                    <label for="new_name" class="col-sm-3 control-label">Användarnamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="new_name" name="new_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_pass" class="col-sm-3 control-label">Lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="new_pass" name="new_pass" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="re_pass" class="col-sm-3 control-label">Upprepa lösenord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="re_pass" name="re_pass" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">Förnamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Valfri">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Efternamn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Valfri">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Valfri">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Registrera</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($errorMsg) : ?>
                <p class="red"><?= $errorMsg ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
