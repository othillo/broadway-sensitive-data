<?php

namespace othillo\BroadwaySensitiveData\EventHandling;

use Broadway\Domain\DomainMessage;

interface SensitiveDataEventListenerInterface
{
    public function handle(DomainMessage $domainMessage, SensitiveData $data = null);
}
