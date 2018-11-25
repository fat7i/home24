<?php

namespace Core;


class Session
{
    /**
     * Container Object
     *
     * @var Container $container
     */
    private $container;


    /**
     * constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Session start
     */
    public function start()
    {
        if(!session_id()) {
            session_start();
        }
    }

    /**
     * Set New Value to Session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get Value from session by the given key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key , $default = null)
    {
        return array_get($_SESSION, $key, $default);
    }

    /**
     * Determine if the session has the given key
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove the given key from session
     *
     * @param string $key
     * @return void
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Get value from session by the given key then remove it
     *
     * @param string $key
     * @return mixed
     */
    public function pull($key)
    {
        $value = $this->get($key);

        $this->remove($key);

        return $value;
    }

    /**
     * Get all session data
     *
     * @return array
     */
    public function all()
    {
        return $_SESSION;
    }

    /**
     * Destroy Session
     *
     * @return void
     */
    public function destroy()
    {
        session_destroy();

        unset($_SESSION);
    }
}