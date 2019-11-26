<?php

namespace Core;

class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Get a value from the session by key
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Set a value to a key in the session
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Check if a value exists in the session
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a value from the session by key
     *
     * @param $key
     */
    public function delete($key)
    {
        if (!isset($_SESSION[$key])) return;
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session and removes all session values
     */
    public function destroy()
    {
        session_destroy();
    }
}