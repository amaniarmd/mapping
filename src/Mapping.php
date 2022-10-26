<?php

namespace Armd\Mapping;

use Exception;
use Armd\Mapping\Services\JsonService;
use Armd\Mapping\Services\MapService;
use Armd\Mapping\Services\YamlService;
use Armd\Mapping\Services\XmlService;
use Armd\Mapping\Enumerations\ContentTypeEnum;
use Armd\Mapping\Enumerations\ErrorEnum;
use Armd\Mapping\Enumerations\FileTypeEnum;

class Mapping
{
    public function mapApi($configFile, $inputAPI)
    {
        $contentType = $inputAPI->header('Content-Type');
       
        if ($contentType == ContentTypeEnum::json) {
            $inputObject = new JsonService();
        } else if ($contentType == ContentTypeEnum::xml) {
            $inputObject = new XmlService();
        } else {
            $this->typeException(ErrorEnum::contentTypeError);
        }

        return $this->createMappedArray($inputAPI->body(), $inputObject, $configFile);
    }

    public function mapFile($configFile, $inputFile, $inputType)
    {
        if ($inputType == FileTypeEnum::json) {
            $inputObject = new JsonService();
        } else if ($inputType == FileTypeEnum::xml) {
            $inputObject = new XmlService();
        } else {
            $this->typeException(ErrorEnum::fileTypeError);
        }

        return $this->createMappedArray($inputFile, $inputObject, $configFile);
    }

    private function typeException($message)
    {
        throw new Exception($message, ErrorEnum::wrongTypeCode);
    }

    private function createMappedArray($inputEntry, $inputObject, $configEntry)
    {
        $responseArray = $this->arrayFactory($inputObject, $inputEntry);
        $configArray = $this->arrayFactory(new YamlService(), $configEntry);

        $mapService = new MapService();
        $mappedArray = $mapService->Map($responseArray, $configArray);

        return $mappedArray;
    }

    private function arrayFactory($instance, $entry)
    {
        return $instance->toArray($entry);
    }
}
