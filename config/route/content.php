<?php
/**
 * Content routes
 */
$app->router->add("content/pages", function () use ($app) {
    $pages = $app->query->getContentOfType("page");
    $data = [
        "title" => "Pages",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("content/pages", ["region" => "main", "pages" => $pages], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("content/pages/{page}", function () use ($app) {
    $path = $app->request->getRouteParts()[2];
    $page = $app->query->getContentByPath($path, "page");
    $data = [
        "title" => $page->title,
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("content/page", ["region" => "main", "page" => $page], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("content/blog", function () use ($app) {
    $posts = $app->query->getContentOfType("post");
    $data = [
        "title" => "Blog",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("content/blog", ["region" => "main", "posts" => $posts], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("content/blog/{post}", function () use ($app) {
    $slug = $app->request->getRouteParts()[2];
    $post = $app->query->getContentBySlug($slug, "post");
    $data = [
        "title" => $post->title,
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("content/blogpost", ["region" => "main", "post" => $post], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("content/blocks", function () use ($app) {
    $blocks = $app->query->getContentOfType("block");
    $data = [
        "title" => "Blocks",
    ];
    $flash = $blocks[0];
    $sidebar = $blocks[1];
    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("take1/flash", ["region" => "flash", "flash" => $flash], "flash");
    $app->view->add("take1/sidebar", ["region" => "main", "sidebar" => $sidebar], "sidebar");
    $app->view->add("content/blocks", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});
