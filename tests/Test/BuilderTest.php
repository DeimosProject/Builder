<?php

namespace Test;

use DeimosTest\TestsSetUp;

class BuilderTest extends TestsSetUp
{

    public function testCaching()
    {

        $rand = $this->builder->rand();

        $this->assertEquals(
            $rand,
            $this->builder->rand()
        );

        $str1 = 'В вечернем свете волны отчаянно бились';
        $str2 = 'All their equipment and instruments are';

        $substr = $this->builder->subStr($str1, 0, 2);

        $this->assertEquals(
            mb_substr($str1, 0, 2),
            $substr
        );

        $substr = $this->builder->subStr($str2, 0, 2);

        $this->assertNotEquals(
            mb_substr($str2, 0, 2),
            $substr
        );

    }

    public function testInstance()
    {
        $this->assertEquals(
            $this->builder->test(),
            $this->builder->test(),
            '', 0.0, 10, true
        );
    }

}
