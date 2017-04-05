<?php
$laptop = $app->url->asset("img/laptop.png");
$system = $app->url->create("status");
$guessNumber = $app->url->create("../../kmom01/guess");
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Om den här sidan</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <p>Den här hemsidan är en del av kursen Objektorienterade webbteknologier på Blekinge Högskola.
            Kursen fokuserar på objektorienterad programmering med PHP tillsammans med databasen MySQL,
            och hanterar objektorienterade programmeringstekniker i PHP med fokus mot webbprogrammering
            och webbutveckling av webbapplikationer och webbplatser.
            </p>
            <p>För att skapa hemsidan använder jag mikro-ramverket Anax Lite. All kod för den finns på mitt
               <a href="https://github.com/Canjono/anax-lite" alt="GitHub-repo">repo på GitHub</a>.
            </p>
            <p>För att spela "Gissa numret" kan du klicka <a href="<?= $guessNumber ?>">här</a>.</p>
            <p>För att att få information om diverse detaljer om det här systemet klicka
                <a href="<?= $system ?>">här</a>.
            </p>
        </div>
        <div class="col-lg-6">
            <img class="img-responsive center-block img-laptop" src="<?= $laptop ?>" alt="laptop">
        </div>
    </div>
</div>