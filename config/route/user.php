<?php
/**
 * User handler routes
 */
$app->router->add("login", function () use ($app) {
    if ($app->user->isLoggedIn()) {
        // Redirect to home page if already logged in
        header("Location: {$app->url->create('')}");
    } else {
        $data = [
            "title" => "Login",
        ];

        $app->view->add("take1/layout", $data, "layout");
        $app->view->add("user/login", ["region" => "main"], "main", 0);

        $body = $app->view->renderBuffered("layout");
        $app->response->setBody($body)->send();
    }
});

$app->router->add("login/validate", function () use ($app) {
    $user = isset($_POST["username"]) ? htmlentities($_POST["username"]) : null;
    $pass = isset($_POST["password"]) ? htmlentities($_POST["password"]) : null;

    if ($user != null && $pass != null) {
        $errorMsg = null;
        if ($app->query->exists($user)) {
            // Get username with correct uppercases and lowercases
            $username = $app->query->getUsername($user);
            // Get hashed password from db
            $hashedPass = $app->query->getHash($user);
            if (password_verify($username . $pass, $hashedPass)) {
                // Login if password is verified
                $app->session->set("user", $username);
                header("Location: {$app->url->create('')}");
            } else {
                $errorMsg = "Lösenordet är felaktigt";
            }
        } else {
            $errorMsg = "Det finns ingen användare med det namnet";
        }
    }
    if ($errorMsg) {
        // Redirect to login page with error message
        $app->session->set("errorMsg", $errorMsg);
        header("Location: {$app->url->create('login')}");
    }
});

$app->router->add("logout", function () use ($app) {
    $app->session->delete("user");
    header("Location: {$app->url->create('login')}");
});

$app->router->add("register", function () use ($app) {
    $data = [
        "title" => "Register",
    ];

    $app->view->add("take1/layout", $data, "layout");
    $app->view->add("user/register", ["region" => "main"], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)->send();
});

$app->router->add("register/validate", function () use ($app) {
    // Handle incoming POST variables
    $user = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
    $pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
    $rePass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

    $errorMsg = null;
    if ($user != null && $pass != null && $rePass != null) {
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
            $permission = 1;
            $date = date("Y-m-d H:i:s");
            $cryptPass = password_hash($user . $pass, PASSWORD_DEFAULT);
            $params = [$user, $cryptPass, $fname, $lname, $email, $permission, $date];
            $app->query->addUser($params);
            // Redirect to login page with success message
            $app->session->set("successMsg", "Du har registrerat en ny användare");
            header("Location: {$app->url->create('login')}");
        }
    } else {
        // All obligatory fields wasn't filled
        $errorMsg = "Alla obligatoriska fälten är inte ifyllda!";
    }
    if ($errorMsg) {
        // Redirect to register page with error message
        $app->session->set("errorMsg", $errorMsg);
        header("Location: {$app->url->create('register')}");
    }
});

$app->router->add("profile", function () use ($app) {
    if (!$app->user->isLoggedIn()) {
        // Redirect to login page if not logged in
        header("Location: {$app->url->create('login')}");
    } else {
        // $user = new \Canjono\User\User($app->session->get("user"), $app->db);
        $data = [
            "title" => "Profile"
        ];

        $app->view->add("take1/layout", $data, "layout");
        $app->view->add("user/profile", ["region" => "main"], "main", 0);

        $body = $app->view->renderBuffered("layout");
        $app->response->setBody($body)->send();
    }
});

$app->router->add("profile/update", function () use ($app) {
    if (!$app->user->isLoggedIn()) {
        // Redirect to login page if not logged in
        header("Location: {$app->url->create('login')}");
    } else {
        // Handle incoming POST variables
        $username = isset($_POST["username"]) ? htmlentities($_POST["username"]) : null;
        $pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;
        $fname = isset($_POST["fname"]) ? htmlentities($_POST["fname"]) : null;
        $lname = isset($_POST["lname"]) ? htmlentities($_POST["lname"]) : null;
        $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : null;
        $permission = isset($_POST["permission"]) ? htmlentities($_POST["permission"]) : null;

        // Get hashed password from db
        $hashedPass = $app->query->getHash($username);
        if (password_verify($username . $pass, $hashedPass)) {
            // Password was verified
            $params = [$fname, $lname, $email, $permission];
            $app->user->update($params);
            $app->session->set("successMsg", "Dina uppgifter har uppdaterats");
        } else {
            // Set session message about incorrect password
            $app->session->set("errorMsg", "Lösenordet är felaktigt");
        }
        // Redirect to profile page
        header("Location: {$app->url->create('profile')}");
    }
});

$app->router->add("profile/changePassword", function () use ($app) {
    if (!$app->user->isLoggedIn()) {
        // Redirect to login page if not logged in
        header("Location: {$app->url->create('login')}");
    } else {
        $data = [
            "title" => "Change password"
        ];

        $app->view->add("take1/layout", $data, "layout");
        $app->view->add("user/change_password", ["region" => "main"], "main", 0);

        $body = $app->view->renderBuffered("layout");
        $app->response->setBody($body)->send();
    }
});

$app->router->add("profile/changePassword/validate", function () use ($app) {
    if (!$app->user->isLoggedIn()) {
        // Redirect to login page if not logged in
        header("Location: {$app->url->create('login')}");
    } else {
        $errorMsg = null;
        // Handle incoming POST variables
        $oldPass = isset($_POST["oldPass"]) ? htmlentities($_POST["oldPass"]) : null;
        $newPass = isset($_POST["newPass"]) ? htmlentities($_POST["newPass"]) : null;
        $rePass = isset($_POST["rePass"]) ? htmlentities($_POST["rePass"]) : null;

        if ($newPass != $rePass) {
            // New passwords doesn't match
            $errorMsg = "De nya lösenorden matchar inte varandra";
        } else {
            $username = $app->user->getUsername();
            $hashedPass = $app->query->getHash($username);
            if (password_verify($username . $oldPass, $hashedPass)) {
                // Old password is verified
                $cryptPass = password_hash($username . $newPass, PASSWORD_DEFAULT);
                $app->user->changePassword($cryptPass);
                $app->session->set("successMsg", "Ditt lösenord har uppdaterats");
                header("Location: {$app->url->create('profile')}");
            } else {
                // Old password is wrong
                $errorMsg = "Du skrev in fel lösenord";
            }
        }
        if ($errorMsg) {
            // Set error message and redirect to changepassword page
            $app->session->set("errorMsg", $errorMsg);
            header("Location: {$app->url->create('profile/changePassword')}");
        }
    }
});
