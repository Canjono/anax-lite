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
            $route = call_user_func($this->urlCreator, $val["route"]);
            $active = $val["route"] === $this->currentRoute ? "active" : "";
            $html .= "<li class='{$active}'><a href='{$route}'>{$val['text']}</a></li>";
        }

        $html .= "</ul></div>";
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
}
