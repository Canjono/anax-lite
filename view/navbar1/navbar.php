<?php
$navbar = [
    "config" => [
        "navbar-class" => "navbar-collapse collapse",
        "navbar-id" => "navbar",
        "ul-class" => "nav navbar-nav"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => "",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
        ]
    ]
];

$urlHome = $app->url->create($navbar["items"]["home"]["route"]);

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
        <div id="<?= $navbar['config']['navbar-id'] ?>" class="<?= $navbar['config']['navbar-class'] ?>">
            <ul class="<?= $navbar['config']['ul-class'] ?>">
                <?php foreach ($navbar["items"] as $val) :
                    $route = $app->url->create($val["route"]);
                    $active = $val["route"] === $app->request->getRoute(); ?>
                <li class="<?= $active ? 'active' : '' ?>"><a href="<?= $route ?>"><?= $val['text'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
