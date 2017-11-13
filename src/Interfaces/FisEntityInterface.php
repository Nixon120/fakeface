<?php
namespace AllDigitalRewards\FIS\Interfaces;

interface FisEntityInterface
{
    public function getValidator();

    public function toArray():array;

    public function hydrate(iterable $options);
}
