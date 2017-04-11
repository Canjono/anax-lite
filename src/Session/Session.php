<?php

namespace Canjono\Session;

class Session
{
    /**
     * @var string $name Name of session
     */
    private $name;


    /**
     * Constructor
     * @param string $name (optional) The name of the session
     * @return void
     */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
    }


    /**
     * Starts the session if not exists
     * @return void
     */
    public function start()
    {
        session_name($this->name);

        if (!empty(session_id())) {
            session_destroy();
        }
        session_start();
    }


    /**
     * Check if key exists in session
     * @param string $key The key to check for in session
     * @return bool true if $key exists, otherwise false
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }


    /**
     * Sets a variable in session
     * @param string $key The key in session
     * @param string $val The value to set to $key
     * @return void
     */
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }


    /**
     * Retrieve value if exists in session
     * @param $key string The key to get from session
     * @param $default (optional) The return value if not found
     * @return string The session variable if present, else $default
     */
    public function get($key, $default = false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default;
    }


    /**
     * Destroys the session and sets cookie
     * @return void
     */
    public function destroy()
    {
        session_destroy();
    }


    /**
     * Deletes variable from session if exists
     * @param $key string The key variable to unset from session
     * @return void
     */
    public function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }


    /**
     * Dumps the session
     * Good for debugging
     * @return void
     */
    public function dump()
    {
        var_dump($_SESSION);
    }


    /**
     * Get information about session
     * @return [] Containing information about session
     */
    public function getInfo()
    {
        $info = [
            "Session name" => session_name(),
            "Session ID" => session_id(),
            "Session status" => session_status(),
            "Session module name" => session_module_name(),
            "Session cache limiter" => session_cache_limiter(),
            "Session save path" => session_save_path(),
        ];
        return $info;
    }


    /**
     * Get session value and than unset it
     *
     * @param string $key Name of key
     * @return string Value of key, if not found return null
     */
    public function getOnce($key)
    {
        if ($this->has($key)) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        return null;
    }
}
