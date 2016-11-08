<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

use Broadway\Domain\DomainMessage;

abstract class SensitiveDataProcessor implements SensitiveDataEventListenerInterface
{
    public function handle(DomainMessage $domainMessage, SensitiveData $data = null)
    {
        $event  = $domainMessage->getPayload();
        $method = $this->getHandleMethod($event);

        if (! method_exists($this, $method)) {
            return;
        }

        $this->$method($event, $domainMessage, $data);
    }

    private function getHandleMethod($event)
    {
        $classParts = explode('\\', get_class($event));

        return 'handle' . end($classParts);
    }
}
