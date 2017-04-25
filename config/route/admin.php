<?php
/**
 * Admin routes
 */
$app->router->add("admin/**", function () use ($app) {
    if (!$app->user->isAdmin()) {
        $app->redirect("login");
    }
});

$app->router->add("admin", function () use ($app) {
    $data = [
        "title" => "Admin",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/admin", ["region" => "main",], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/users", function () use ($app) {
    // Get search string
    $search = isset($_GET["search"]) ? htmlentities($_GET["search"]) : null;
    if ($search) {
        $search = "%{$search}%";
    }

    // Get number of hits per page
    $hits = isset($_GET["hits"]) ? htmlentities($_GET["hits"]) : 4;
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
        die("Not valid for hits.");
    }

    // Get max number of pages
    if ($search) {
        $max = $app->query->search($search);
    } else {
        $sql = "SELECT COUNT(user) AS max FROM anaxlite_users;";
        $max = $app->db->executeFetchAll($sql);
    }
    $max = ceil($max[0]->max / $hits);

    // Get current page
    $page = isset($_GET["page"]) ? htmlentities($_GET["page"]) : 1;
    if (!($page > 0 && $page <= $max)) {
        $page = 1;
    }

    $offset = $hits * ($page - 1);

    // Only these values are valid
    $columns = ["user", "fname", "lname", "email", "permission"];
    $orders = ["asc", "desc"];

    // Get settings from GET or use defaults
    $orderBy = isset($_GET["orderby"]) ? htmlentities($_GET["orderby"]) : "user";
    $order = isset($_GET["order"]) ? htmlentities($_GET["order"]) : "asc";

    // Incoming matches valid value sets
    if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
        die("Not valid input for sorting");
    }

    // Get all users from db
    $allUsers = $app->query->getAllUsers($orderBy, $order, $hits, $offset, $search);
    // Get an admins table and a users table
    $usersTable = $app->functions->getUsersTables($allUsers);

    $data = [
        "title" => "Admin",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/users", ["region" => "main","users" => $usersTable, "max" => $max], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/users/delete", function () use ($app) {
    // Get $_GET variable
    $user = isset($_GET["user"]) ? htmlentities($_GET["user"]) : null;
    if ($user != null && $app->user->getUsername() != $user) {
        // Remove user from database
        $app->query->removeUser($user);
        header("Location: {$app->url->create('admin/users')}");
    }
});

$app->router->add("admin/users/update", function () use ($app) {
    // Get $_GET variable
    $username = isset($_GET["user"]) ? htmlentities($_GET["user"]) : null;
    $user = new \Canjono\User\User();
    $user->setDatabase($app->db);
    $user->setUser($username);

    $data = [
        "title" => "Update user",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/update", ["region" => "main", "user" => $user], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/users/doUpdate", function () use ($app) {
    // Handle incoming POST variables
    $oldUsername = isset($_POST["oldUsername"]) ? htmlentities($_POST["oldUsername"]) : "";
    $newUsername = isset($_POST["newUsername"]) ? htmlentities($_POST["newUsername"]) : "";
    $fname = isset($_POST["fname"]) ? htmlentities($_POST["fname"]) : "";
    $lname = isset($_POST["lname"]) ? htmlentities($_POST["lname"]) : "";
    $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : "";
    $permission = isset($_POST["permission"]) ? htmlentities($_POST["permission"]) : 1;
    $newPass = (isset($_POST["newPass"]) && !empty($_POST["newPass"]))
        ? htmlentities($_POST["newPass"])
        : null;

    // Create user object
    $user = new \Canjono\User\User();
    $user->setDatabase($app->db);
    $user->setUser($oldUsername);

    if ($oldUsername != $newUsername && $app->query->exists($newUsername)) {
        // New username is already taken
        $app->session->set("errorMsg", "Användarnamnet är upptaget");
    } else {
        if ($oldUsername != $newUsername) {
            // Change username
            $user->changeUsername($newUsername);
            $oldUsername = $newUsername;
        }
        // Update data
        $params = [$fname, $lname, $email, $permission];
        $user->update($params);
        if ($newPass) {
            // Change password
            $cryptPass = password_hash($oldUsername . $newPass, PASSWORD_DEFAULT);
            $user->changePassword($cryptPass);
        }
        $app->session->set("successMsg", "Användarens uppgifter har uppdaterats");
    }
    $updateRoute = $app->url->create("admin/users/update?user={$oldUsername}");
    header("Location: {$updateRoute}");
});

$app->router->add("admin/users/add", function () use ($app) {
    $data = [
        "title" => "Add user",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/add", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/users/add/validate", function () use ($app) {
    // Handle incoming POST variables
    $user = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
    $pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
    $rePass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
    $permission = isset($_POST["permission"]) ? htmlentities($_POST["permission"]) : null;

    $errorMsg = null;
    if ($user != null && $pass != null && $rePass != null && $permission != null) {
        if ($app->query->exists($user)) {
            // User already exists
            $errorMsg = "Det finns redan en användare med det namnet";
        } elseif ($pass != $rePass) {
            // Passwords don't match
            $errorMsg = "Lösenorden matchar inte varandra";
        } else {
            // Fields were filled correctly
            $fname = isset($_POST["fname"]) ? htmlentities($_POST["fname"]) : null;
            $lname = isset($_POST["lname"]) ? htmlentities($_POST["lname"]) : null;
            $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : null;
            $date = date("Y-m-d H:i:s");
            $cryptPass = password_hash($user . $pass, PASSWORD_DEFAULT);
            $params = [$user, $cryptPass, $fname, $lname, $email, $permission, $date];
            $app->query->addUser($params);
            // Redirect to login page with success message
            $app->session->set("successMsg", "Du har registrerat en ny användare");
            header("Location: {$app->url->create('admin/users/add')}");
        }
    } else {
        // All obligatory fields wasn't filled
        $errorMsg = "Alla obligatoriska fälten är inte ifyllda!";
    }
    if ($errorMsg) {
        // Redirect to register page with error message
        $app->session->set("errorMsg", $errorMsg);
        header("Location: {$app->url->create('admin/users/add')}");
    }
});

$app->router->add("admin/content", function () use ($app) {
    $content = $app->query->getAllContent();
    $data = [
        "title" => "Content",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/content", ["region" => "main", "content" => $content], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/content/update/{id}", function () use ($app) {
    $id = $app->request->getRouteParts()[3];
    if (!is_numeric($id)) {
        die("That's not a valid url");
        exit;
    }
    $content = $app->query->getContentById($id);
    $data = [
        "title" => "Edit content",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/content-edit", ["region" => "main", "content" => $content], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/content/doUpdate", function () use ($app) {
    $params = $app->request->getPost([
        "contentTitle",
        "contentPath",
        "contentSlug",
        "contentData",
        "contentType",
        "contentFilter",
        "contentPublished",
        "contentId"
    ]);

    $updateLink = $app->url->create("admin/content/update/{$params['contentId']}");

    if (!$params["contentPath"]) {
        $params["contentPath"] = null;
    } else {
        $fetchedContent = $app->query->getContentByPath($params["contentPath"]);
        if ($fetchedContent && $fetchedContent->id != $params["contentId"]) {
            $app->session->set("errorMsg", "Path '{$params['contentPath']}' already exists");
            header("Location: {$updateLink}");
            exit;
        }
    }
    if (!$params["contentSlug"]) {
        $params["contentSlug"] = $app->textfilter->slugify($params["contentTitle"]);
    }

    $fetchedContent = $app->query->getContentBySlug($params["contentSlug"]);
    if ($fetchedContent && $fetchedContent->id != $params["contentId"]) {
        $app->session->set("errorMsg", "Slug '{$params['contentSlug']}' already exists");
        header("Location: {$updateLink}");
        exit;
    }

    if (!$params["contentPublished"]) {
        $params["contentPublished"] = date("Y-m-d H:i:s");
    }
    $app->query->updateContent(array_values($params));
    $app->session->set("successMsg", "Content updated");
    header("Location: {$updateLink}");
});

$app->router->add("admin/content/delete/{id}", function () use ($app) {
    $id = $app->request->getRouteParts()[3];
    if (!is_numeric($id)) {
        die("That's not a valid url");
        exit;
    }
    $content = $app->query->getContentById($id);
    $data = [
        "title" => "Delete content",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/content-delete", ["region" => "main", "content" => $content], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/content/doDelete", function () use ($app) {
    $id = $app->request->getPost("contentId");
    $app->query->deleteContent($id);
    header("Location: {$app->url->create('admin/content')}");
});

$app->router->add("admin/content/add", function () use ($app) {
    $data = [
        "title" => "Add content",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("admin/content-add", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("admin/content/doAdd", function () use ($app) {
    $title = $app->request->getPost("contentTitle");
    $app->query->addContent($title);
    $id = $app->db->lastInsertId();
    $updateLink = $app->url->create("admin/content/update/$id");
    header("Location: {$updateLink}");
});
