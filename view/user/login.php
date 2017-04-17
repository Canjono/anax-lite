<?php
$validate = $app->url->create("login/validate");
$register = $app->url->create("register");
$errorMsg = $app->session->getOnce("errorMsg");
$successMsg = $app->session->getOnce("successMsg");
$cookieName = $app->cookie->get("lastUser", "");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Logga in</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form class="form-signin" action="<?= $validate ?>" method="post">
                <h2 class="form-signin-heading">Skriv dina uppgifter</h2>
                <input type="text" placeholder="Username" name="username"
                    value="<?= $cookieName ?>" class="form-control" required autofocus>
                <input type="password" placeholder="Password" name="password" class="form-control" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <p>
                <a href="<?= $register ?>">Registrera dig</a>
            </p>
        </div>
    </div>
    <?php if ($successMsg) : ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <p class="green"><?= $successMsg ?></p>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($errorMsg) : ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <p class="red"><?= $errorMsg ?></p>
        </div>
    </div>
    <?php endif; ?>
</div>
