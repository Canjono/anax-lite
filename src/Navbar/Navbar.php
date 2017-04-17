<?php

namespace Canjono\Navbar;

/**
 * Navbar to generate HTML for a navbar from a  configuration array.
 */
class Navbar implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;

    /**
     * @var [] $urlCreator Callable for creating urls.
     * @var string $currentRoute The current route
     * @var [] $sessionGet Callable for getting values from $_SESSION
     */
    private $urlCreator;
    private $currentRoute;

    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        // Variables
        $navbarId = $this->config["config"]["navbar-id"];
        $navbarClass = $this->config["config"]["navbar-class"];
        $ulClass = $this->config["config"]["ul-class"];

        // Make navbar
        $html = "<div id='{$navbarId}' class='{$navbarClass}'>"
            . "<ul class='{$ulClass}'>";

        foreach ($this->config["items"] as $val) {
            // Don't add 'login' route if already logged in
            // Don't add 'user' route if not logged in
            // Don't add 'admin' if user isn't an admin
            if ($this->shouldBeSkipped($val["route"])) {
                continue;
            }
            if ($val['dropdown']) {
                // Dropdown
                $html .= $this->getDropdownHTML($val);
            } else {
                // No drop dropdown
                $route = call_user_func($this->urlCreator, $val["route"]);
                $active = $val["route"] === $this->currentRoute ? "active" : "";
                $html .= "<li class='{$active}'><a href='{$route}'>{$val['text']}</a></li>";
            }
        }

        $html .= "</ul></div>";
        return $html;
    }

    /**
     * Check if navbar link should be skipped or not
     *
     * @param string $route The route to check
     * @return bool If link should be skipped then true, otherwise false
     */
    public function shouldBeSkipped($route)
    {
        return ($route == "login" && $this->user->isLoggedIn()) ||
            ($route == "user" && !$this->user->isLoggedIn()) ||
            ($route == "admin" && !$this->user->isAdmin());
    }

    /**
     * Get HTML of dropdown menu
     *
     * @param array $val Items to put in dropdown menu
     * @return string HTML string of dropdown menu
     */
    private function getDropdownHTML($val)
    {
        $text = $val['text'] == "User" ? $this->user->getUsername() : $val['text'];
        $html = "<li class='dropdown'>"
            . "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' "
            . "aria-haspopup='true' aria-expanded='false'>{$text}</a>"
            . "<ul class='dropdown-menu'>";
        foreach ($val["dropdown"] as $subVal) {
            $route = call_user_func($this->urlCreator, $subVal["route"]);
            // If user isn't admin don't add 'admin' route
            if ($subVal["route"] == "admin" && !$this->user->isAdmin()) {
                continue;
            }
            $html .= "<li><a href='{$route}'>{$subVal['text']}</a></li>";
        }
        $html .= "</ul>";
        return $html;
    }


    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    public function setUrlCreator($urlCreate)
    {
        $this->urlCreator = $urlCreate;
    }

    /**
     * Set the current route
     *
     * @param string $route The current route
     *
     * @return void
     */
    public function setCurrentRoute($route)
    {
        $this->currentRoute = $route;
    }

    /**
     * Set the callable to use for checking if user is logged in
     *
     * @param callable $sessionGet To get value in $_SESSION
     * @return void
     */
    public function setSessionGet($sessionGet)
    {
        $this->sessionGet = $sessionGet;
    }

    /**
     * Inject User object for methods about user
     *
     * @param object $user With method about user
     * @return $this for chaining
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
