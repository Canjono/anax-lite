<?php
/**
 * Session routes
 */
$app->router->add("session", function () use ($app) {
    $data = [
        "title" => "Session",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("session/session", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("session/increment", function () use ($app) {
    $newValue = $app->session->get("number")
        ? $app->session->get("number") + 1
        : 1;

    $app->session->set("number", $newValue);

    header("Location: {$app->url->create('session')}");
});

$app->router->add("session/decrement", function () use ($app) {
    $newValue = $app->session->get("number")
        ? $app->session->get("number") - 1
        : -1;

    $app->session->set("number", $newValue);

    header("Location: {$app->url->create('session')}");
});

$app->router->add("session/status", function () use ($app) {
    $data = $app->session->getInfo();

    $app->response->sendJson($data);
});

$app->router->add("session/dump", function () use ($app) {
    $data = [
        "title" => "Session dump",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("session/dump", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("session/destroy", function () use ($app) {
    $app->session->destroy();

    header("Location: {$app->url->create('session/dump')}");
});
