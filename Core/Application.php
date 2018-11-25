<?php

namespace Core;

use Core\Exceptions\ClassNotFoundInContainer;

/**
 * Class Application
 * @package Core
 */
final class Application
{
    /**
     * Application Container
     *
     * @var Container
     */
    private $container;

    /**
     * Application instance
     *
     * @var
     */
    private static $instance;

    /**
     * Constructor
     *
     * @param Container $container
     */
    private function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get Application instance
     *
     * @param Container $container
     * @return Application
     */
    public static function getInstance(Container $container)
    {
        if(is_null(static::$instance)) {
            static::$instance = new self($container);
        }
        return static::$instance;
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run()
    {
        //session start
        $this->container->get('session')->start();

        //prepare requested url
        $this->container->get('request')->prepareUrl();

        //get proper route
        $output = $this->container->get('route')->handle();

        //set output
        $this->container->get('response')->setContent($output);

        //send output
        $this->container->get('response')->send();
    }

    /**
     * Get Registered value by given key
     *
     * @param string $key
     * @return mixed
     * @throws ClassNotFoundInContainer
     */
    public function get(string $key)
    {
        return $this->container->get($key);
    }

}