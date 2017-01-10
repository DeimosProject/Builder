<?php

namespace Deimos\Builder;

class Builder
{

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param $name
     *
     * @return string
     */
    protected function methodName($name)
    {
        return 'build' . ucfirst($name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    protected function hasInstance($name)
    {
        return isset($this->instances[$name]);
    }

    /**
     * @param $method
     *
     * @return mixed
     */
    private function init($method)
    {
        if (method_exists($this, $method))
        {
            return $this->$method();
        }

        return $method();
    }

    /**
     * init method
     *
     * @param string          $name
     * @param string|callable $method
     *
     * @return mixed
     */
    private function objectBuild($name, $method)
    {
        if (!$this->hasInstance($name))
        {
            $this->instances[$name] = $this->init($method);
        }

        return $this->instances[$name];
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    protected function instance($name)
    {
        $methodName = $this->methodName($name);

        return $this->objectBuild($name, $methodName);
    }

    /**
     * @param callable $callable
     *
     * @return string
     */
    private function hash(callable $callable)
    {
        $reflection = new \ReflectionFunction($callable);

        return crc32($reflection);
    }

    /**
     * @param callable $callable
     * @param string   $udId
     *
     * @return mixed
     */
    protected function once(callable $callable, $udId = null)
    {
        if (!$udId)
        {
            $udId = $this->hash($callable);
        }

        return $this->objectBuild($udId, $callable);
    }

}