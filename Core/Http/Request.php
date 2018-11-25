<?php

namespace Core\Http;

use Core\Container;


class Request
{
    /**
     * Container Object
     *
     * @var Container
     */
    private $container;

    /**
     * @var
     */
    private $url;

    /**
     * @var
     */
    private $baseUrl;


    /**
     * constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Prepare url
     *
     * @return void
     */
    public function prepareUrl()
    {
        $script = dirname($_SERVER['SCRIPT_NAME']);
        $requestUri = $_SERVER['REQUEST_URI'];

        if (strpos($requestUri, '?') !== false) {
            list($requestUri, $queryString) = explode('?' , $requestUri);
        }

        $this->url = rtrim(preg_replace('#^'.$script.'#', '', $requestUri), '/');

        if(!$this->url) {
            $this->url = '/';
        }

        $this->baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $script . '/';
    }

    /**
     * @return mixed
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param string $path
     * @return string
     */
    public function link(string $path)
    {
        return $this->baseUrl . trim($path, '/');
    }

    /**
     * Get Value from _GET by the given key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = array_get($_GET, $key, $default);
        if (is_array($value)) {
            $value = array_filter($value);
        } else {
            $value = trim($value);
        }
        return $value;
    }

    /**
     * Get Value from JSON POST by the given key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function post($key, $default = null)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $value = array_get($data, $key, $default);
        if (is_array($value)) {
            $value = array_filter($value);
        } else {
            $value = trim($value);
        }
        return $value;
    }

    /**
     * Get Bearer token from header authorization
     * @return mixed|null
     */
    public static function getTokenFromHeader()
    {
        $token = null;
        $headers = apache_request_headers();
        if(isset($headers['Authorization'])){
            $matches = array();
            preg_match('/Bearer (.*)/', $headers['Authorization'], $matches);
            if(isset($matches[1])){
                $token = $matches[1];
            }
        }

        return $token;
    }
}