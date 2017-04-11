<?php
/**
 * Session routes
 */
$app->router->add("calendar", function () use ($app) {
    if ($app->session->get("newmonth")) {
        $app->calendar->setNewMonth($app->session->getOnce("newmonth"));
    }
    $data = [
        "title" => "Calendar",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("take1/calendar", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("calendar/previous", function () use ($app) {
    $oldTimestamp = intval($_GET["t"], 10);
    $newTimestamp = $app->calendar->getPreviousMonth($oldTimestamp);
    $app->session->set("newmonth", $newTimestamp);

    header("Location: {$app->url->create('calendar')}");
});

$app->router->add("calendar/next", function () use ($app) {
    $oldTimestamp = intval($_GET["t"], 10);
    $newTimestamp = $app->calendar->getNextMonth($oldTimestamp);
    $app->session->set("newmonth", $newTimestamp);

    header("Location: {$app->url->create('calendar')}");
});
