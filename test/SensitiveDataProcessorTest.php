<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;

class SensitiveDataProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_passes_the_event_and_domain_message_and_sensitive_data()
    {
        $testProcessor = new TestProcessor();
        $testEvent     = new TestEvent();

        $this->assertFalse($testProcessor->isCalled());

        $testProcessor->handle($this->createDomainMessage($testEvent), new SensitiveData(['foo' => 'bar']));

        $this->assertTrue($testProcessor->isCalled());
    }

    private function createDomainMessage($event)
    {
        return DomainMessage::recordNow(1, 1, new Metadata([]), $event);
    }
}

class TestProcessor extends SensitiveDataProcessor
{
    private $isCalled = false;

    public function applyTestEvent($event, DomainMessage $domainMessage, SensitiveData $sensitiveData)
    {
        $this->isCalled = true;
    }

    public function isCalled()
    {
        return $this->isCalled;
    }
}

class TestEvent
{
}
