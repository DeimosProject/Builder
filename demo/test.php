<?php

include_once __DIR__ . '/../vendor/autoload.php';

class Builder extends \Deimos\Builder\Builder
{

    /**
     * method Random
     *
     * @return int
     */
    public function rand()
    {
        return $this->once(function ()
        {
            return mt_rand();
        });
    }

}

$builder = new Builder();

var_dump($builder->rand(), $builder->rand());