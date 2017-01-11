<?php

namespace DeimosTest;

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
        }, __METHOD__);
    }

    /**
     * @param string $str
     * @param string $start
     * @param int    $lenght
     *
     * @return mixed
     */
    public function subStr($str, $start, $lenght = -1)
    {
        return $this->once(function () use ($str, $start, $lenght)
        {
            return mb_substr($str, $start, $lenght);
        });
    }

    protected function buildTest()
    {
        return new static();
    }

    public function test()
    {
        return $this->instance('test');
    }

}
