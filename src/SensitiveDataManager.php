<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

use Broadway\Domain\DomainMessage;
use Broadway\EventHandling\EventListener;

class SensitiveDataManager implements EventListener
{
    private $sensitiveData;
    private $sensitiveDataProcessors = [];

    /**
     * @param SensitiveDataEventListenerInterface[] $sensitiveDataProcessors
     */
    public function __construct(array $sensitiveDataProcessors = array())
    {
        foreach ($sensitiveDataProcessors as $sensitiveDataProcessor) {
            $this->subscribe($sensitiveDataProcessor);
        }
    }

    private function subscribe(SensitiveDataEventListenerInterface $sensitiveDataProcessor)
    {
        $this->sensitiveDataProcessors[] = $sensitiveDataProcessor;
    }

    public function handle(DomainMessage $domainMessage)
    {
        foreach ($this->sensitiveDataProcessors as $processor) {
            $processor->handle($domainMessage, $this->sensitiveData);
        }
    }

    public function setSensitiveData(SensitiveData $data)
    {
        $this->sensitiveData = $data;
    }
}
