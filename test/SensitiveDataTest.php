<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

class SensitiveDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_exposes_its_properties()
    {
        $data          = ['foo' => 'bar'];
        $sensitiveData = new SensitiveData($data);

        $this->assertEquals($data, $sensitiveData->getData());
    }
}
