<?php

namespace Core;

use Core\Exceptions\MiddlewareNotImplementMiddlewareInterface;


class Route
{

    /**
     * Next flag
     *
     * @const string
     */
    const NEXT = '__NEXT__';

    /**
     * Container Object
     *
     * @var Container
     */
    private $container;

    /**
     * Routes container
     *
     * @var array
     */
    private $routes = [];


    /**
     * constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Add new route
     *
     * @param string $url
     * @param string $action
     * @param string $requestMethod
     * @param  array $middleware
     * @return void
     */
    public function add(string $url, string $action, string $requestMethod = 'GET', array $middleware = [])
    {
        $route = [
            'url'        => $url,
            'action'     => $this->getAction($action),
            'method'     =>  strtoupper($requestMethod),
            'schema'     => $this->generateSchema($url),
            'middleware' => $middleware,
        ];


        $this->routes[] = $route;
    }

    /**
     * @param string $action
     * @return string
     */
    private function getAction(string $action)
    {
        return strpos($action, '@') !== false ? $action : $action .'@index';
    }

    /**
     * Generate pattern Schema
     * @param string $url
     * @return string
     */
    private function generateSchema(string $url)
    {
        $pattern = '~^';
        $pattern .= str_replace(['{id}', '{str}'], ['(\d+)', '[a-zA-Z0-9-]'], $url);
        $pattern .= '$~';

        return $pattern ;
    }

    /**
     * Get proper route, then call it and get string of the output
     *
     * @throws MiddlewareNotImplementMiddlewareInterface
     * @throws \Exception
     * @return string
     */
    public function handle()
    {

        foreach ($this->routes as $route) {
            if ($this->isMatching($route['schema'], $route['method'])) {
                $output = '';
                if ($route['middleware']) {
                    foreach ($route['middleware'] as $middleware){
                        $middlewareClass = 'App\\Middleware\\'. $middleware;

                        if (!in_array('App\\Middleware\\MiddlewareInterface', class_implements($middlewareClass))) {
                            throw new MiddlewareNotImplementMiddlewareInterface(sprintf('%s must implement %s', $middleware, 'App\\Middleware\\MiddlewareInterface'));
                        }

                        $middlewareObject = new $middlewareClass;
                        $output = $middlewareObject->handle($this->container, static::NEXT);

                        if ($output === static::NEXT) {
                            $output = '';
                        }else{
                            break;
                        }
                    }
                } // END: middleware


                if ($output == '') {

                    list($controller, $action) = explode('@', $route['action']);

                    $arguments = $this->getArguments($route['schema']);

                    $controller = 'App\\Controllers\\'. $controller;
                    $controllerObject = new $controller($this->container);

                    if ((new \ReflectionClass($controllerObject))->hasMethod($action) && (new \ReflectionMethod($controllerObject, $action))->isPublic()) {

                        $output = (string) call_user_func_array([$controllerObject, $action], $arguments);

                    } else {
                        $output = $this->notFound();
                    }
                }
                return $output;

            }
        }

        return $output = $this->notFound();
    }

    /**
     * @param string $pattern
     * @param string $requestMethod
     * @return bool
     */
    private function isMatching(string $pattern, string $requestMethod)
    {
        return ( preg_match($pattern, $this->container->get('request')->url())  &&  $requestMethod == $this->container->get('request')->method() );
    }

    /**
     * Get arguments from url
     * @param string $pattern
     * @return mixed
     */
    private function getArguments(string $pattern)
    {
        preg_match($pattern, $this->container->get('request')->url(), $matches);
        array_shift($matches);
        return $matches;
    }

    /**
     * Not found output
     *
     * @return string
     */
    private function notFound()
    {
        $controller = 'App\\Controllers\\ErrorController';
        $controllerObject = new $controller($this->container);

        return (string) call_user_func([$controllerObject, 'notFound']);
    }
}