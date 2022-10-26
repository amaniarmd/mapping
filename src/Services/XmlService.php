<?php

namespace Armd\Mapping\Services;

use Armd\Mapping\Abstract\Convert;

class XmlService extends Convert
{
    public function toArray($xmlFile): array
    {
        return (array) $this->parseXmlToArray($xmlFile);
    }

    private function parseXmlToArray($xmlFile)
    {
        $xml = simplexml_load_string($xmlFile, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        return $array;
    }
}
