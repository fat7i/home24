<?php

namespace Core\Abstracts;

use Core\Container;


abstract class AbstractModel
{
    /**
     * Container Object
     *
     * @var Container
     */
    protected $container;

    /**
     * Table name
     *
     * @var string
     */
    protected $table;

    /**
     * Soft delete flag
     *
     * @var bool
     */
    protected $softDelete = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->container = Container::getInstance();
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
     * Get all Model Records
     *
     * @return array
     */
    public function all()
    {
        return $this->orderBy('id', 'DESC')->fetchAll($this->table);
    }

    /**
     * Get Record By Id
     *
     * @param int $id
     * @return array | null
     */
    public function get($id)
    {
        return $this->where('id = ?' , $id)->fetch($this->table);
    }

    /**
     * Determine if the given value of the key exists in table
     *
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function exists($value, $key = 'id')
    {
        $query = $this->select($key);
        if (!$this->softDelete) {
            $query->where($key . '=?', $value);
        } else {
            $query->where($key . '=? AND deleted_at IS NULL', $value);
        }

        return (bool) $query->fetch($this->table);
    }

    /**
     * Delete Record By Id
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        if ($this->exists($id)) {
            if (!$this->softDelete) {
                $this->where('id = ?', $id)->delete($this->table);
            } else {
                //->data('user_id', '')
                $this->data('deleted_at', date('Y-m-d G:i:s'))
                    ->where('id=?', $id)
                    ->update($this->table);
            }
            return true;
        } else {
            return null;
        }
    }

    /**
     * Call Database methods dynamically
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->container->get('db'), $method], $args);
    }
}