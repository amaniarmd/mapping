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
    public function mapApi($configFile, $inputAPI): array
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

    public function mapFile($configFile, $inputFile, $inputType): array
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

    /**
     * @throws Exception
     */
    private function typeException($message)
    {
        throw new Exception($message, ErrorEnum::wrongTypeCode);
    }

    private function createMappedArray($inputEntry, $inputObject, $configEntry): array
    {
        $responseArray = $this->arrayFactory($inputObject, $inputEntry);
        $configArray = $this->arrayFactory(new YamlService(), $configEntry);

        $mapService = new MapService();
        return $mapService->Map($responseArray, $configArray);
    }

    private function arrayFactory($instance, $entry)
    {
        return $instance->toArray($entry);
    }
}
