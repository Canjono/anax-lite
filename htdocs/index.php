<?php
/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app
$app = new \Canjono\App\App();
$app->request = new \Anax\Request\Request();
$app->response = new \Anax\Response\Response();
$app->url =     new \Anax\Url\Url();
$app->router =  new \Anax\Route\RouterInjectable();
$app->view = new \Anax\View\ViewContainer();
$app->navbar = new \Canjono\Navbar\Navbar();
$app->session = new \Canjono\Session\Session();
$app->calendar = new \Canjono\Calendar\Calendar();
$app->db = new \Canjono\Database\DatabaseConfigure();
$app->query = new \Canjono\Query\Query();
$app->queryWebshop = new \Canjono\QueryWebshop\QueryWebshop();
$app->cookie = new \Canjono\Cookie\Cookie();
$app->user = new \Canjono\User\User();
$app->functions = new \Canjono\Functions\Functions();
$app->textfilter = new \Canjono\Textfilter\Textfilter();

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");

// Init the object of the request class.
$app->request->init();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Add route to stylesheet
$app->style = $app->url->asset("css/style.css");

// Inject url creator and current route to navbar
$app->navbar->setUrlCreator([$app->url, "create"]);
$app->navbar->setCurrentRoute($app->request->getRoute());
$app->navbar->setSessionGet([$app->session, "get"]);
$app->navbar->setUser($app->user);

// Update navbar configuration with values from config file.
$app->navbar->configure("navbar.php");

// Start session
$app->session->start();

// Update database configuration with values from config file
$app->db->configure("database.php");
$app->db->setDefaultsFromConfiguration();
$app->db->connect();

// Inject Database object to Query
$app->query->setDatabase($app->db);

// Inject Database object to QueryWebshop
$app->queryWebshop->setDatabase($app->db);

// Init the user object if logged in
if ($app->session->get("user")) {
    $app->user->setDatabase($app->db);
    $app->user->setUser($app->session->get("user"));
}

// Update lastUser value in $_COOKIE if logged in
if ($app->user->isLoggedIn()) {
    $app->cookie->set("lastUser", $app->user->getUsername());
}

// Inject Url object to Functions
$app->functions->setUrl($app->url);
$app->functions->setUser($app->user);

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
// $app->router->handle($app->request->getRoute(), $app->request->getMethod());
$app->router->handle($app->request->getRoute());
