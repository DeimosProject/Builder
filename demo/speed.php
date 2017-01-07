<?php

include_once __DIR__ . '/../vendor/autoload.php';

interface RandomInterface
{
    public function rand();
}

class Random1 extends \Deimos\Builder\Builder implements RandomInterface
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

class Random2 extends \Deimos\Builder\Builder implements RandomInterface
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

$random1 = new Random1();
$random2 = new Random2();

function run(RandomInterface $sObject)
{
    $range = range(1, 10);

    $microTime = microtime(true);

    foreach ($range as $value1)
    {
        foreach (range($value1, 10) as $value2)
        {
            foreach (range($value2, 10) as &$value3)
            {
                $value3 = $sObject->rand();
            }
        }
    }

    return microtime(true) - $microTime;
}

// benchmark
var_dump(run($random1));
var_dump(run($random2));