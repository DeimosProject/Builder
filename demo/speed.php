<?php

include_once __DIR__ . '/../vendor/autoload.php';

interface S
{
    public function rand();
}

class S1 extends \Deimos\Builder\Builder implements S
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

class S2 extends \Deimos\Builder\Builder implements S
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

}

$s1 = new S1();
$s2 = new S2();

function mt(S $s)
{
    $range = range(1, 10);

    $mt = microtime(true);

    foreach ($range as $value1)
    {
        foreach ($range as $value2)
        {
            foreach ($range as $value3)
            {
                $s->rand();
            }
        }
    }

    return microtime(true) - $mt;
}

// benchmark
var_dump(mt($s1));
var_dump(mt($s2));