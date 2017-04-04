<?php
$urlHome = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");

?>
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
            <a class="navbar-brand" href="<?= $urlHome ?>">Michael Hedlund</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= $urlHome ?>">Hem</a></li>
                <li><a href="<?= $urlReport ?>">Redovisning</a></li>
                <li><a href="<?= $urlAbout ?>">Om</a></li>
            </ul>
        </div>
    </div>
</nav>