<?php

namespace Armd\Mapping\Services;

use Armd\Mapping\Abstract\Convert;
use Symfony\Component\Yaml\Yaml;

class YamlService extends Convert
{
    public function toArray($yamlFile): array
    {
        return $this->parseYamlToArray($yamlFile);
    }

    private function parseYamlToArray($yamlFile)
    {
        return Yaml::parse($yamlFile);
    }
}
