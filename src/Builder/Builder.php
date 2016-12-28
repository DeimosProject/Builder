<?php

namespace Deimos\Builder;

class Builder
{

    /**
     * @var array
     */
    protected $instances = [];

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
     * @param $name
     *
     * @return mixed
     */
    protected function instance($name)
    {
        if (!$this->hasInstance($name))
        {
            $methodName = 'build' . ucfirst($name);

            $this->instances[$name] = $this->{$methodName}();
        }

        return $this->instances[$name];
    }

}