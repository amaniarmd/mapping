<?php

namespace Armd\Mapping\Services;

use Symfony\Component\Yaml\Yaml;

class YamlService
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
