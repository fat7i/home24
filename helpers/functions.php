<?php

if (!function_exists('app')) {
    /**
     * Get Application instance from Container
     *
     * @return \Core\Application
     */
    function app()
    {
        return \Core\Container::getInstance()->singleton('app');
    }
}

if (! function_exists('array_get')) {
    /**
     * Get the value from the given array for the given key if found
     * otherwise get the default value
     *
     * @param array $array
     * @param string|int $key
     * @param mixed $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}


if (! function_exists('get_user_id_from_token')) {

    /**
     * Get user id from header authorization token
     *
     * @return int id
     */
    function get_user_id_from_token()
    {
        $jwt_token = \Core\Http\Request::getTokenFromHeader();
        $container = \Core\Container::getInstance();
        $session_id = $container->get('session')->get('session_id');
        $token_array = (array) $container->get('jwt')::decode($jwt_token, $session_id, array('HS256'));

        return $token_array['id'];
    }
}

if (! function_exists('config')) {
    /**
     * Get the config value for the given key
     *
     * @param string|int $key
     * @param mixed $default
     * @return mixed
     */
    function config($key, $default = null)
    {
        $output = $default;

        $cmd = '$output = $_ENV[\''. str_replace('.', '\'][\'', $key). '\'];';

        eval($cmd);

        return $output;
    }
}