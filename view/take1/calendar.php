<?php

$timestamp = $app->calendar->getTimestamp();
$previousRoute = $app->url->create("calendar/previous?t={$timestamp}");
$nextRoute = $app->url->create("calendar/next?t={$timestamp}");
$month = $app->calendar->getMonthName();
$imgLink = $app->url->asset("img/{$app->calendar->getMonthImg($month)}");
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Månadskalender</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="calendar">
                <div class="calendar-image">
                    <img class="img-calendar" src="<?= $imgLink ?>">
                </div>
                <div class="calendar-dates">
                    <a href="<?= $previousRoute ?>">
                        <button type="button" class="btn btn-default left" aria-label="Chevron Left">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        </button>
                    </a>
                    <a href="<?= $nextRoute ?>">
                        <button type="button" class="btn btn-default right" aria-label="Chevron Right">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        </button>
                    </a>
                    <h2 class="month"><?= $month ?></h2>
                    <?= $app->calendar->getMonthAsTable() ?>
                </div>
            </div>
        </div>
    </div>
</div>
