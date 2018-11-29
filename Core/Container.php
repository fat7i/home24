<?php

namespace Core;

use Closure;
use Core\Exceptions\ClassNotFoundInContainer;

class Container
{
    /**
     * Container
     *
     * @var array
     */
    private $container = [];

    /**
     * Container instance
     *
     * @var
     */
    private static $instance;


    /**
     * Get Application instance
     *
     * @return Application
     */
    public static function getInstance()
    {
        if(is_null(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * Create a singleton class
     *
     * @param string $alias
     * @return mixed
     */
    public function singleton(string $alias)
    {
        $coreClasses = $this->coreClassesAliases();
        $object = $coreClasses[$alias];
        return $object::getInstance($this);
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
        if(!$this->isRegistered($key)) {
            if($this->isCoreClassAlias($key)) {
                $this->register($key, $this->createCoreClassObject($key));
            }else{
                throw new ClassNotFoundInContainer( $key . ' not found in core classes aliases');
            }
        }
        return $this->container[$key];
    }

    /**
     * Determine if the given key is registered
     *
     * @param string $key
     * @return bool
     */
    private function isRegistered(string $key)
    {
        return isset($this->container[$key]);
    }

    /**
     * Determine if the given key is a core class alias
     *
     * @param string $key
     * @return bool
     */
    private function isCoreClassAlias(string $key)
    {
        $coreClasses = $this->coreClassesAliases();
        return isset($coreClasses[$key]);
    }

    /**
     * Create new core class object
     *
     * @param string $alias
     * @return mixed
     */
    private function createCoreClassObject(string $alias)
    {
        $coreClasses = $this->coreClassesAliases();
        $object = $coreClasses[$alias];
        return new $object($this);
    }

    /**
     * Register the given key and value through the application
     *
     * @param string $key
     * @param $value
     */
    public function register(string $key, $value)
    {
        if ($value instanceof Closure) {
            $value = call_user_func($value, $this);
        }
        $this->container[$key] = $value;
    }

    /**
     * Get all core class aliases
     *
     * @return array
     */
    private function coreClassesAliases()
    {
        return [
            'app'      =>      'Core\\Application',
            'session'      =>  'Core\\Session',
            'route'        =>  'Core\\Route',
            'request'      =>  'Core\\Http\\Request',
            'response'     =>  'Core\\Http\\Response',
            'db'           =>  'Core\\Database\\Database',
            'pagination'   =>  'Core\\Pagination',
            'validator'    =>  'Core\\Validation',
            'jwt'          =>  '\\Firebase\\JWT\\JWT',
        ];
    }
}