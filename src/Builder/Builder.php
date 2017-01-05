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
            $this->instances[$name] = call_user_func($method);
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
     * @return mixed
     */
    protected function once(callable $callable)
    {
        $hash = \spl_object_hash((object)$callable);

        return $this->objectBuild($hash, $callable);
    }

}