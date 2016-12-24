<?php

namespace Deimos\Builder;

class Builder
{

    protected function instance($name)
    {
        $methodName = 'build' . ucfirst($name);

        return $this->{$methodName}();
    }

}