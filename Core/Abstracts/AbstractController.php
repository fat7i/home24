<?php

namespace Core\Abstracts;

use Core\Container;


abstract class AbstractController
{
    /**
     * Container Object
     *
     * @var Container
     */
    protected $container;

    /**
     * Errors container
     *
     * @var array
     */
    protected $errors = [];

    /**
     * constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Call shared application objects dynamically
     *
     * @param string $key
     * @throws \Exception
     * @return mixed
     */
    public function __get($key)
    {
        return $this->container->get($key);
    }

    /**
     * Encode the given value to json
     *
     * @param mixed $data
     * @param int $statusCode
     * @return string
     */
    public function json($data = null, $statusCode = 200)
    {
        $this->container->get('response')->setHttpResponseCode($statusCode);

        if (is_null($data)){
            $this->container->get('response')->setHttpResponseCode(404);
            $this->errors = ['errors' => 'resource not found'];
            return json_encode($this->errors);
        }

        return (!is_bool($data))? json_encode($data) : '';
    }


}