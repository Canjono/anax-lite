<?php

namespace Canjono\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    /**
     * Redirect to another page
     *
     * @param $url string Url to redirect to
     * @return void
     */
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
    }
}
