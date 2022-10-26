<?php

namespace Armd\Mapping\Abstract;

abstract class Convert{
    abstract public function toArray($input): array;
}