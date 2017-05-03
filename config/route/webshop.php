<?php
/**
 * Admin routes
 */
$app->router->add("webshop/**", function () use ($app) {
    if (!$app->user->isAdmin()) {
        $app->redirect("login");
    }
});

$app->router->add("webshop", function () use ($app) {
    $data = [
        "title" => "Webshop",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("webshop/webshop", ["region" => "main",], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("webshop/products", function () use ($app) {
    $inventory = $app->queryWebshop->getProducts();
    $data = [
        "title" => "Products",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("webshop/products", ["region" => "main", "resultset" => $inventory], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("webshop/product/update/{id}", function ($id) use ($app) {
    $product = $app->queryWebshop->getProduct($id);
    $categories = $app->queryWebshop->getCategories();
    $shelves = $app->queryWebshop->getShelves();
    $data = [
        "title" => "Update product",
    ];
    $data2 = [
        "region" => "main",
        "content" => $product,
        "categories" => $categories,
        "shelves" => $shelves
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("webshop/update_product", $data2, "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("webshop/product/doUpdate", function () use ($app) {
    $params = $app->request->getPost([
        "id",
        "name",
        "description",
        "price",
        "platform",
        "image",
        "shelf",
        "amount",
        "category"
    ]);

    $app->queryWebshop->updateProduct(array_values($params));
    $link = $app->url->create("webshop/product/update/{$params['id']}");
    $app->session->set("success", "Produkten har uppdaterats");
    header("Location: {$link}");
});

$app->router->add("webshop/product/add", function () use ($app) {
    $shelves = $app->queryWebshop->getShelves();
    $data = [
        "title" => "Add new product",
    ];

    $data2 = [
        "region" => "main",
        "shelves" => $shelves
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("webshop/add_product", $data2, "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("webshop/product/doAdd", function () use ($app) {
    $params = $app->request->getPost([
        "name",
        "amount",
        "shelf"
    ]);
    $id = $app->queryWebshop->addProduct(array_values($params));
    $link = $app->url->create("webshop/product/update/{$id}");
    $app->session->set("success", "Produkten har lagts till");
    header("Location: {$link}");
});

$app->router->add("webshop/product/delete/{id}", function ($id) use ($app) {
    $product = $app->queryWebshop->getProduct($id);
    $data = [
        "title" => "Delete product",
    ];
    $data2 = [
        "region" => "main",
        "content" => $product
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("webshop/delete_product", $data2, "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("webshop/product/doDelete", function () use ($app) {
    $id = $app->request->getPost("productId");

    $app->queryWebshop->deleteProduct($id);
    $app->session->set("success", "Produkten har tagits bort");
    header("Location: {$app->url->create('webshop/products')}");
});
