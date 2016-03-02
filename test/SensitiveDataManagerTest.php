<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;

class SensitiveDataManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_publishes_events_and_sensitive_date_to_subscribed_processors()
    {
        $domainMessage = DomainMessage::recordNow(1, 1, new Metadata([]), new \stdClass());
        $sensitiveData = new SensitiveData(['foo' => 'bar']);

        $processor1 = $this->prophesize(SensitiveDataEventListenerInterface::class);
        $processor1
            ->handle($domainMessage, $sensitiveData)
            ->shouldBeCalled();

        $processor2 = $this->prophesize(SensitiveDataEventListenerInterface::class);
        $processor2
            ->handle($domainMessage, $sensitiveData)
            ->shouldBeCalled();

        $manager = new SensitiveDataManager([$processor1->reveal(), $processor2->reveal()]);
        $manager->setSensitiveData($sensitiveData);
        $manager->handle($domainMessage);
    }
}
