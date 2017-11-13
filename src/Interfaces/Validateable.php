<?php

namespace AllDigitalRewards\FIS\Interfaces;

interface Validateable
{
    public function isValid(): bool;

    public function getValidationErrors(): array;
}
