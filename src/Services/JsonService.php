<?php

namespace Armd\Mapping\Services;

use Armd\Mapping\Abstract\Convert;

class JsonService extends Convert
{
    public function toArray($json): array
    {
        return (array) json_decode($json);
    }
}
