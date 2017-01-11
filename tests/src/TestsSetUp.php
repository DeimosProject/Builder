<?php

namespace DeimosTest;

class TestsSetUp extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Builder
     */
    protected $builder;

    public function setUp()
    {
        $this->builder = new Builder();
    }

}
