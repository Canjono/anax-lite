<!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>

    <!-- Get bootstrap stylesheet -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= $app->style ?>" rel="stylesheet">

</head>
<body role="document">
    <div class="header-wrap">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= $app->url->create('') ?>">Michael Hedlund</a>
                </div>
                <?= $app->navbar->getHTML(); ?>
            </div>
        </nav>
    </div>

    <?php if ($this->regionHasContent("flash")) : ?>
    <div class="flash-wrap">
        <?php $this->renderRegion("flash") ?>
    </div>
    <?php endif; ?>

    <?php if ($this->regionHasContent("main")) : ?>
    <div class="main-wrap">
        <?php $this->renderRegion("main") ?>
    </div>
    <?php endif; ?>

    <div class="footer-wrap">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p>Skapad av Michael Hedlund (michael.hedlund88@gmail.com)</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JQuery file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Javascript file for bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
